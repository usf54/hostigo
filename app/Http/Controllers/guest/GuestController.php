<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Booking;

class GuestController extends Controller
{
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
