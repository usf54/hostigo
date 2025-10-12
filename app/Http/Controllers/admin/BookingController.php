<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['guest', 'property'])->get();
        return Inertia::render('Admin/Bookings/Index', [
            'bookings' => $bookings
        ]);
    }

    public function show($id)
    {
        $booking = Booking::with(['guest', 'property'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::with(['guest', 'property'])->findOrFail($id);

        return Inertia::render('Admin/Bookings/Edit', [
            'booking' => $booking,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking status updated successfully!');
    }

    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking deleted successfully!');
    }
}
