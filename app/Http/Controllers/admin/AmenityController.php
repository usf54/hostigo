<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Amenity;

class AmenityController extends Controller
{
    public function index()
    {
        $amenities = Amenity::all();
        return Inertia::render('Admin/Amenities/Index', [
            'amenities' => $amenities
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Amenities/Create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:100|unique:amenities,name',
        ]);

        Amenity::create([
            'name' => $request->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('amenities.index')
                        ->with('success', 'Amenity created successfully!');
    }


    public function edit($id)
    {
        $amenity = Amenity::findOrFail($id);
        return Inertia::render('Admin/Amenities/Edit', [
            'amenity' => $amenity
        ]);
    }
    
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $amenity = Amenity::findOrFail($id);
        
        $amenity->update(['name' => $request->name]);

        return redirect()->route('amenities.index')->with('success', 'Amenity updated successfully!');
    }
    
    public function destroy($id)
    {
        $amenity = Amenity::findOrFail($id);
        $amenity->delete();
        return redirect()->route('amenities.index')->with('success', 'Deleted!');
    }
}
