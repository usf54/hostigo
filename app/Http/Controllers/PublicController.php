<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PublicController extends Controller
{
    // Home page
    public function home() {
        $properties = Property::with(['images', 'amenities', 'host'])->get();
        
        $casablancaProperties = Property::with(['images', 'amenities','host'])->where('city','casablanca')->get();
        $rabatProperties = Property::with(['images', 'amenities','host'])->where('city','rabat')->get();
        $marrakechProperties = Property::with(['images', 'amenities','host'])->where('city','marrakech')->get();

        return view('welcome', compact('properties', 'casablancaProperties', 'rabatProperties', 'marrakechProperties'));
    }
    
    // Explore page
    public function explore()  {
        $properties = Property::with(['images', 'amenities','host'])->get();
        
        return view('pages.explore', compact('properties'));
    }
    
    // Property details page
    public function showProperty($id)  {
        $property = Property::with(['images', 'amenities','host'])->findOrFail($id);
        // Get booked date ranges (only confirmed/pending bookings)
        $bookedDates = $property->bookings()
                ->where('status', '!=', 'cancelled')
                ->get(['check_in', 'check_out']);
        return view('property.property-details', compact('property','bookedDates'));
    }

    public function filter(Request $request)
    {
        $query = Property::with('images');

        // Location filter
        if ($request->location) {
            $query->where('city', 'like', "%{$request->location}%")
                    ->orWhere('country', 'like', "%{$request->location}%");
        }

        if ($request->filled('max_guests')) {
            $query->where('max_guests', '>=', $request->max_guests);
        }


        // Price filter
        if ($request->price_range) {
            if ($request->price_range == '$80 - $150') {
                $query->whereBetween('price_per_night', [80, 150]);
            } elseif ($request->price_range == '$150 - $250') {
                $query->whereBetween('price_per_night', [150, 250]);
            } elseif ($request->price_range == '$250+') {
                $query->where('price_per_night', '>=', 250);
            }
        }

        $properties = $query->get();

        return view('pages.explore', compact('properties'));
    }
}
