<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmationMail;
use App\Mail\NewBookingNotificationMail;
use App\Mail\GuestCancelledBookingMail;

class BookingController extends Controller
{
    // Guest Store a new booking
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

        /**
             * Check if the property is already booked for the requested dates.
             *
             * Conditions:
             * 1. Only consider bookings that are NOT cancelled.
             * 2. Overlaps if:
             *    - Existing check-in falls within requested dates
             *    - OR existing check-out falls within requested dates
             *    - OR existing booking fully encloses the requested date range
             *
             * Returns:
             * bool $isAlreadyBooked  True if dates conflict, false if available
         */
        $isAlreadyBooked = Booking::where('property_id', $property->id)
            ->where('status', '!=', 'cancelled') // Only consider active bookings
            ->where(
                function ($query) use ($validated) 
                {
                    $query->whereBetween('check_in', [$validated['check_in'], $validated['check_out']])
                        ->orWhereBetween('check_out', [$validated['check_in'], $validated['check_out']])
                        ->orWhere(function ($query) use ($validated) {
                            $query->where('check_in', '<=', $validated['check_in'])
                                    ->where('check_out', '>=', $validated['check_out']);
                        });
                }
            )
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

            // Create pending payment record
            \App\Models\Payment::create([
                'booking_id' => $booking->id,
                'amount' => $totalPrice,
                'payment_method' => 'stripe',
                'status' => 'pending',
            ]);

        } catch (\Exception $e) {
            \Log::error('Booking creation failed: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while processing your booking. Please try again.');
        }
        
        Mail::to($booking->guest->email)->queue(new BookingConfirmationMail($booking));
        Mail::to($booking->property->host->email)->queue(new NewBookingNotificationMail($booking));

        // Redirect to booking show page instead of index - UPDATE THIS LINE
        return redirect()->route('guest.bookings.show', $booking)->with('success', 'Booking created successfully! Please complete the payment to confirm your booking.');
    }

    // Guest cancel booking 
    public function cancel(Booking $booking)
    {
        // Make sure the logged-in user owns this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Allow cancellation only if status is pending AND not paid
        if ($booking->status !== 'pending' || $booking->isPaid()) {
            return back()->with('error', 'Only pending unpaid bookings can be cancelled.');
        }

        try {
            $booking->update(['status' => 'cancelled']);
            $booking->load('guest', 'property.host');
            // Notify host
            Mail::to($booking->property->host->email)->queue(new GuestCancelledBookingMail($booking));
        } catch (\Exception $e) {
            \Log::error('Booking cancellation failed: ' . $e->getMessage());
            return back()->with('error', 'Could not cancel booking. Please try again.');
        }
        
        return redirect()->route('guest.bookings.index')
            ->with('success', 'Booking cancelled successfully.');
    }

}
