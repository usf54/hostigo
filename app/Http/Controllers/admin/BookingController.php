<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['guest', 'property'])->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('admin.bookings.create');
    }

    public function show($id)
    {
        $booking = Booking::with(['guest', 'property'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::with(['guest', 'property'])->findOrFail($id);
        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after_or_equal:check_in',
            'status'    => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update([
            'check_in'  => $request->check_in,
            'check_out' => $request->check_out,
            'status'    => $request->status,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
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
