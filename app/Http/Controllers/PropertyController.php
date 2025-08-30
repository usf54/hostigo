<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index(Request $request)
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
