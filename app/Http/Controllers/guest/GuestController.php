<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Booking;
use App\Models\Property;
use App\Mail\BookingConfirmationMail;
use App\Mail\NewBookingNotificationMail;
use Illuminate\Support\Facades\Mail;

class GuestController extends Controller
{
    // Store a new booking
    public function store(Request $request, Property $property)
    {
        // Validate input
        $validated = $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        // Check guest capacity
        if ($validated['guests'] > $property->max_guests) {
            return back()->withErrors([
                'guests' => "This property allows a maximum of {$property->max_guests} guests."
            ])->withInput();
        }

        // Check if dates are already booked for this property
        $isAlreadyBooked = Booking::where('property_id', $property->id)
            ->where('status', '!=', 'cancelled') // Only consider active bookings
            ->where(function ($query) use ($validated) {
                $query->whereBetween('check_in', [$validated['check_in'], $validated['check_out']])
                    ->orWhereBetween('check_out', [$validated['check_in'], $validated['check_out']])
                    ->orWhere(function ($query) use ($validated) {
                        $query->where('check_in', '<=', $validated['check_in'])
                                ->where('check_out', '>=', $validated['check_out']);
                    });
            })
            ->exists();

        if ($isAlreadyBooked) {
            return back()->withErrors(['check_in' => 'The property is not available for the selected dates.'])
                        ->withInput();
        }

        // Calculate number of nights
        $checkIn = new \DateTime($validated['check_in']);
        $checkOut = new \DateTime($validated['check_out']);
        $nights = $checkOut->diff($checkIn)->days;

        // Calculate total price
        $totalPrice = $nights * $property->price_per_night;

        // Create booking safely
        try {
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'property_id' => $property->id,
                'check_in' => $validated['check_in'],
                'check_out' => $validated['check_out'],
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);
        } catch (\Exception $e) {
            \Log::error('Booking creation failed: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while processing your booking. Please try again.');
        }
        
        Mail::to($booking->guest->email)->send(new BookingConfirmationMail($booking));
        Mail::to($booking->property->host->email)->send(new NewBookingNotificationMail($booking));

        return redirect()->route('guest.bookings.index')->with('success', 'Booking created successfully!');
    }


    public function updatePhoto(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        // Delete old picture if exists
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        // Save new picture
        $path = $request->file('image')->store('profile', 'public');
        $user->image = $path;
        $user->save();

        return redirect()->route('guest.profile.index')->with('success', 'Profile picture updated successfully.');
    }
    
    public function cancel(Booking $booking)
    {
        // Make sure the logged-in user owns this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Allow cancellation only if status is pending
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be cancelled.');
        }

        try {
            $booking->update(['status' => 'cancelled']);
        } catch (\Exception $e) {
            \Log::error('Booking cancellation failed: ' . $e->getMessage());
            return back()->with('error', 'Could not cancel booking. Please try again.');
        }

        return redirect()->route('guest.bookings.index')
            ->with('success', 'Booking cancelled successfully.');
    }

    // Guest bookings
    public function myBookings(Request $request)
    {
        $query = Booking::with('property.images')
                        ->where('user_id', Auth::id())
                        ->orderBy('check_in', 'desc');

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // City filter
        if ($request->filled('city')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('city', $request->city);
            });
        }

        // Date filter
        if ($request->filled('date')) {
            $query->whereDate('check_in', $request->date);
        }

        $bookings = $query->get();

        // Unique cities for the city filter dropdown
        $cities = Booking::where('user_id', Auth::id())
                    ->with('property')
                    ->get()
                    ->pluck('property.city')
                    ->filter()
                    ->unique();

        return view('guest.bookings.index', compact('bookings', 'cities'));
    }


    public function viewBooking($id)
    {
        $booking = Booking::with(['property.images', 'guest'])->findOrFail($id);
        return view('guest.bookings.show', compact('booking'));
    }
}
