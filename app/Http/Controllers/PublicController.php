<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PublicController extends Controller
{
    public function welcome() {
        $properties = Property::with(['images', 'amenities','host'])->get();

        $casablancaProperties = Property::with(['images', 'amenities','host'])->where('city','casablanca')->get();
        $rabatProperties = Property::with(['images', 'amenities','host'])->where('city','rabat')->get();
        $marrakechProperties = Property::with(['images', 'amenities','host'])->where('city','marrakech')->get();

        return view('welcome', compact('properties', 'casablancaProperties', 'rabatProperties', 'marrakechProperties'));
    }

    public function index()  {
        $properties = Property::with(['images', 'amenities','host'])->get();

        return view('pages.explore', compact('properties'));
    }
    
    public function show($id)  {
        $property = Property::with(['images', 'amenities','host'])->findOrFail($id);

        return view('property.property-details', compact('property'));
    }
}
