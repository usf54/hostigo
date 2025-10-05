<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingApprovedMail;
use App\Mail\BookingDeclinedMail;
use App\Mail\HostBookingActionMail;

class BookingController extends Controller
{
    // Show bookings for all properties owned by this host
    public function incomingBookings(Request $request)
    {
        $status = $request->input('status');
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $bookings = Booking::whereHas('property', function ($query) {
                $query->where('user_id', Auth::id()); // properties owned by host
            })
            ->when($status && $status !== 'All', fn($q) => $q->where('status', strtolower($status)))
            ->when($fromDate, fn($q) => $q->whereDate('check_in', '>=', $fromDate))
            ->when($toDate, fn($q) => $q->whereDate('check_out', '<=', $toDate))
            ->with(['guest', 'property'])
            ->orderBy('check_in', 'asc')
            ->get();

        return view('host.bookings.incoming-bookings', compact('bookings'));
    }
 
    // Booking details
    public function viewBooking($id)
    {
        $userId = Auth::id();

        // Fetch the booking, ensure it's owned by this host
        $booking = Booking::with('property')
            ->where('id', $id)
            ->whereHas('property', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->firstOrFail();

        return view('host.bookings.view-booking', compact('booking'));
    }

    // Approve a booking
    public function approve(Booking $booking)
    {
        if ($booking->property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $booking->update(['status' => 'confirmed']);
        // Eager load relationships for the email
        $booking->load('guest', 'property.host');

        // Notify guest
        Mail::to($booking->guest->email)->send(new BookingApprovedMail($booking));

        // Notify host
        Mail::to($booking->property->host->email)->send(new HostBookingActionMail($booking, 'approved'));

        return back()->with('success', 'Booking approved successfully.');
    }

    // Decline a booking
    public function decline(Booking $booking)
    {
        if ($booking->property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $booking->update(['status' => 'cancelled']);
        // Eager load relationships for email
        $booking->load('guest', 'property.host');

        // Notify guest
        Mail::to($booking->guest->email)->send(new BookingDeclinedMail($booking));

        // Notify host
        Mail::to($booking->property->host->email)->send(new HostBookingActionMail($booking, 'declined'));
        
        return back()->with('success', 'Booking declined.');
    }
}
