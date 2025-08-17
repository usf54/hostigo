<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // Guest bookings
    public function myBookings()
    {
        return view('guest.bookings.index');
    }

    public function viewBooking($id)
    {
        return view('guest.bookings.show', compact('id'));
    }

}
