<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Booking;

class GuestController extends Controller
{
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

    // Guest specific booking details 
    public function viewBooking($id)
    {
        $booking = Booking::with(['property.images', 'guest', 'payment'])->findOrFail($id);
        return view('guest.bookings.show', compact('booking'));
    }
}
