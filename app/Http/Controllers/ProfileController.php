<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Property;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $properties = Property::with(['images', 'amenities'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        if ($user->role === 'host') {
            return view('profile.index', compact('user','properties'));
        } elseif ($user->role === 'guest') {
            return view('guest.profile', compact('user'));
        }

        abort(403); // If the role is not recognized
    }

    public function edit(Request $request): View
    {
        $user = $request->user();

        if ($user->role === 'host') {
            return view('profile.edit', compact('user'));
        } elseif ($user->role === 'guest') {
            return view('profile.edit', compact('user'));
        }

        abort(403);
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
