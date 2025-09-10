<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingApprovedMail;
use App\Mail\BookingDeclinedMail;
use App\Mail\HostBookingActionMail;
use App\Models\User;
use App\Models\Amenity;
use App\Models\Property;
use App\Models\Booking;
use App\Models\PropertyImage;

class HostController extends Controller
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


    /**
     * List all properties for logged-in host
     */
    public function index()
    {
        $properties = Property::with(['images', 'amenities'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('host.my-properties', compact('properties'));
    }

    /**
     * Show add form
     */
    public function create()
    {
        $amenities = Amenity::all();
        return view('host.add-property', compact('amenities'));
    }

    /**
     * Store new property
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'max_guests' => 'required|integer|min:1',
            'amenities' => 'array',
            'amenities.*' => 'exists:amenities,id',
            'images.*' => 'image|max:2048'
        ]);

        $validated['user_id'] = Auth::id();

        // Create property
        $property = Property::create($validated);

        // Attach amenities
        if ($request->has('amenities')) {
            $property->amenities()->sync($request->input('amenities'));
        }

        // Upload images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_url' => $path,
                ]);
            }
        }

        return redirect()->route('property.index')->with('success', 'Property created successfully!');
    }

    /**
     * Show property details
     */
    public function show($id)
    {
        $property = Property::with(['images', 'amenities', 'bookings'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('host.show-property', compact('property'));
    }

    public function showHostProfile($id)
    {
        // Fetch the host
        $host = User::with('properties')->findOrFail($id);

        // Return a view and pass the host
        return view('host.show-profile', compact('host'));
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $property = Property::with('amenities', 'images')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $amenities = Amenity::all();

        return view('host.edit-property', compact('property', 'amenities'));
    }

    /**
     * Update property
     */
    public function update(Request $request, $id)
    {
        $property = Property::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'max_guests' => 'required|integer|min:1',
            'amenities' => 'array',
            'amenities.*' => 'exists:amenities,id',
            'images.*' => 'image|max:2048'
        ]);

        $property->update($validated);

        // Sync amenities
        $property->amenities()->sync($request->input('amenities', []));

        // Keep only images that exist in the request
        $keepImages = $request->input('existing_images', []);
        $property->images()->whereNotIn('id', $keepImages)->each(function($img) {
            Storage::disk('public')->delete($img->image_url);
            $img->delete();
        });

        // Handle new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_url' => $path,
                ]);
            }
        }

        return redirect()->route('property.index')->with('success', 'Property updated successfully!');
    }

    /**
     * Delete property
     */
    public function destroy($id)
    {
        $property = Property::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Delete related images from storage
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->image_url);
            $image->delete();
        }

        // Detach amenities
        $property->amenities()->detach();

        // Delete property
        $property->delete();

        return redirect()->route('property.index')->with('success', 'Property deleted successfully!');
    }


}
