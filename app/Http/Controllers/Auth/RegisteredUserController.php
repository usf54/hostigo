<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\WelcomeMail;
use App\Events\NewUserRegistered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image','max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:guest,host'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profile','public');
        }

        $user = User::create([
            'image' => $path,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        Mail::to($user->email)->queue(new WelcomeMail($user));

        event(new Registered($user));
        
        // Dispatch the new event to notify admins
        event(new NewUserRegistered($user));

        Auth::login($user);
        if ($request->role == 'host') {
            return redirect(route('host.profile.index', absolute: false));
        } elseif($request->role == 'guest') {
            return redirect(route('guest.profile.index', absolute: false));
        }
    }
}
