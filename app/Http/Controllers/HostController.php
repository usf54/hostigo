<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HostController extends Controller
{
    public function myBookings(){
        return view('host.bookings.incoming-bookings');
    }
    public function viewBooking(){
        return view('host.bookings.view-booking');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('host.my-properties');
    }
    
    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        return view('host.add-property');
        
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
    public function show()
    {
        return view('host.show-property');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('host.edit-property');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
