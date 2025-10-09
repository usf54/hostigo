<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['booking', 'booking.property', 'user'])->get();
        // For now, just render the React page
        return Inertia::render('Admin/Reviews/Index', [
            'reviews' => $reviews
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Reviews/Create');
    }

    public function store(Request $request)
    {
        // validation & save logic
        // Amenity::create($request->all());
        return redirect()->route('admin.reviews.index')->with('success', 'Review created successfully!');
    }

    public function edit($id)
    {
        // $amenity = Amenity::findOrFail($id);
        return Inertia::render('Admin/Reviews/Edit', [
            // 'amenity' => $amenity
        ]);
    }

    public function update(Request $request, $id)
    {
        // update logic here
        return redirect()->route('admin.reviews.index')->with('success', 'Updated!');
    }

    public function destroy($id)
    {
        // delete logic
        return redirect()->route('admin.reviews.index')->with('success', 'Deleted!');
    }
}
