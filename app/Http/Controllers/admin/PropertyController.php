<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Property;
use App\Models\Amenity;
use App\Models\User;
use Inertia\Inertia;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with(['images', 'amenities', 'host'])->get();
        return Inertia::render('Admin/Properties/Index', [
            'properties' => $properties
        ]);
    }

    public function create()
    {
        $amenities = Amenity::all();
        $hosts = User::where('role', 'host')->get(); // only hosts
        return Inertia::render('Admin/Properties/Create', [
            'amenities' => $amenities,
            'hosts' => $hosts,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'address' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'nullable|string|max:100',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'max_guests' => 'nullable|integer|min:1',
            'amenities' => 'array',
            'amenities.*' => 'exists:amenities,id',
            'images.*' => 'image|max:2048',
        ]);

        $property = Property::create($validated);

        if ($request->has('amenities')) {
            $property->amenities()->sync($request->amenities);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('property_images', 'public');
                $property->images()->create(['image_url' => $path]);
            }
        }

        return redirect()->route('properties.index')->with('success', 'Property created successfully!');
    }

    public function edit($id)
    {
        $property = Property::with(['images', 'amenities', 'host'])->findOrFail($id);
        $amenities = Amenity::all();
        $hosts = User::where('role', 'host')->get();
        return Inertia::render('Admin/Properties/Edit', [
            'property' => $property,
            'amenities' => $amenities,
            'hosts' => $hosts,
        ]);
    }

    public function update(Request $request, $id)
    {
        $property = Property::with('images', 'amenities')->findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'address' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'nullable|string|max:100',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'max_guests' => 'nullable|integer|min:1',
            'amenities' => 'array',
            'amenities.*' => 'exists:amenities,id',
            'images.*' => 'image|max:2048',
        ]);

        $property->update($validated);

        $property->amenities()->sync($request->amenities ?? []);

        // Remove images
        $removeImages = $request->remove_images ?? [];
        foreach ($property->images()->whereIn('id', $removeImages)->get() as $img) {
            Storage::disk('public')->delete($img->image_url);
            $img->delete();
        }

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('property_images', 'public');
                $property->images()->create(['image_url' => $path]);
            }
        }

        return redirect()->route('properties.index')->with('success', 'Property updated successfully!');
    }

    public function destroy($id)
    {
        $property = Property::with('images', 'amenities')->findOrFail($id);

        foreach ($property->images as $img) {
            Storage::disk('public')->delete($img->image_url);
            $img->delete();
        }

        $property->amenities()->detach();
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Property deleted successfully!');
    }
}
