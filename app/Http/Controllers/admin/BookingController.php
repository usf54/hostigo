<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['guest', 'property'])->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $booking = Booking::with(['guest', 'property'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $booking = Booking::with(['guest', 'property'])->findOrFail($id);
        return view('admin.bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id); 
        $booking->delete(); 

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking deleted successfully!');
    }
}
