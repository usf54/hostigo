<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class GuestController extends Controller
{
    // Guest bookings
    public function myBookings()
    {
        // Fetch bookings of the logged-in guest
        $bookings = Booking::with('property.images') // eager load property and images
                    ->where('user_id', Auth::id())
                    ->orderBy('check_in', 'desc')
                    ->get();

        return view('guest.profile', compact('bookings'));
    }

    public function viewBooking($id)
    {
        $booking = Booking::with('property.images')->findOrFail($id);
        return view('guest.bookings.show', compact('booking'));
    }
}
