<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Amenity;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with(['images', 'amenities', 'host'])->get();
        return view('admin.properties.index', compact('properties'));
    }

    public function show($id)
    {
        $property = Property::with(['images', 'amenities', 'host'])->findOrFail($id);
        return view('admin.properties.show', compact('property'));
    }

    public function edit($id)
    {
        $property = Property::with(['images', 'amenities', 'host'])->findOrFail($id);
        $amenities = Amenity::all();
        return view('admin.properties.edit', compact('property', 'amenities'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::with('images', 'amenities')->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'address' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'nullable|string|max:100',
            'max_guests' => 'nullable|integer|min:1',
            'amenities' => 'array',
            'amenities.*' => 'exists:amenities,id',
            'images.*' => 'image|max:2048',
        ]);

        $property->update($validated);

        // Sync amenities
        $property->amenities()->sync($request->input('amenities', []));

        // Remove images marked for deletion
        $removeImages = $request->input('remove_images', []);
        if ($removeImages) {
            foreach ($property->images()->whereIn('id', $removeImages)->get() as $img) {
                Storage::disk('public')->delete($img->image_url ?? $img->path);
                $img->delete();
            }
        }

        // Upload new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('property_images', 'public');
                $property->images()->create([
                    'image_url' => $path,
                ]);
            }
        }

        return redirect()->route('properties.show', $property->id)
            ->with('success', 'Property updated successfully.');
    }

    public function destroy($id)
    {
        $property = Property::with('images', 'amenities')->findOrFail($id);

        // Delete images from storage
        foreach ($property->images as $img) {
            Storage::disk('public')->delete($img->image_url ?? $img->path);
            $img->delete();
        }

        // Detach amenities
        $property->amenities()->detach();

        // Delete property
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Property deleted successfully.');
    }
}
