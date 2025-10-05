<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller; 
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Property;

class ProfileGuestController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $properties = Property::with(['images', 'amenities'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $bookings = \App\Models\Booking::with('property.images')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('guest.profile.index', compact('user', 'bookings'));
    }

    public function edit(Request $request): View
    {
        $user = $request->user();
        return view('guest.profile.edit', compact('user'));
    }

    // Update profile picture
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        // Delete old picture if exists
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        // Save new picture
        $path = $request->file('image')->store('profile', 'public');
        $user->image = $path;
        $user->save();

        return redirect()->route('guest.profile.index')->with('success', 'Profile picture updated successfully.');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('guest.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}