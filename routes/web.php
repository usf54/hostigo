<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PropertyController as PublicPropertyController;


// Email verification notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Verification link callback
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend verification email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/', [PublicController::class, 'welcome'])->name('welcome');
Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/contact', function () {
    return view('pages.contact');
});
Route::middleware(['auth', 'verified'])->group(function()  {
    Route::get('/explore', [PublicController::class, 'index']);
    Route::get('/properties-filter', [PublicPropertyController::class, 'index'])->name('public.properties');
    Route::get('/explore/details/{id}', [PublicController::class, 'show'])->name('public.property.details');
    Route::get('/hosts/{host}', [HostController::class, 'showHostProfile'])->name('host.profile.show');
});


Route::middleware(['auth', 'is_host', 'verified'])->group(function () {
    // HOST ROUTES
    Route::get('/my-properties', [HostController::class, 'index'])->name('property.index');
    Route::get('/property/create', [HostController::class, 'create'])->name('property.create');
    Route::post('/property', [HostController::class, 'store'])->name('property.store');
    Route::get('/property/{id}', [HostController::class, 'show'])->name('property.show');
    Route::get('/property/{id}/edit', [HostController::class, 'edit'])->name('property.edit');
    Route::put('/property/{id}', [HostController::class, 'update'])->name('property.update');
    Route::delete('/property/{id}', [HostController::class, 'destroy'])->name('property.destroy');
    
    // Host booking management
    Route::get('/host/bookings', [HostController::class, 'incomingBookings'])->name('host.bookings.index');
    Route::get('/host/booking/{id}', [HostController::class, 'viewBooking'])->name('host.bookings.show');
    Route::patch('/host/bookings/{booking}/approve', [HostController::class, 'approve'])->name('host.bookings.approve');
    Route::patch('/host/bookings/{booking}/decline', [HostController::class, 'decline'])->name('host.bookings.decline');
    
    Route::get('/profile/show', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/host/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin routes
Route::middleware(['auth', 'is_admin', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users Management
    Route::get('/users', [UserController::class,'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Properties Management
    Route::get('/properties', [PropertyController::class,'index'])->name('properties.index');
    Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');
    Route::get('/properties/{id}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{id}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');

    
    // Bookings Management
    Route::get('/bookings', [BookingController::class,'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');

    
    // Payments
    Route::get('/payments', [PaymentController::class,'index'])->name('payments.index');
    
    // Reports
    Route::get('/reports', [ReportController::class,'index'])->name('reports.index');
    
    // Settings
    Route::get('/settings', [SettingController::class,'index'])->name('settings.index');
    
});

// GUEST ROUTES
Route::middleware(['auth', 'is_guest', 'verified'])->group(function () {
    // Profile routes
    Route::get('/guest/profile', [ProfileController::class, 'index'])->name('guest.profile.index');
    Route::get('/guest/profile/edit', [ProfileController::class, 'edit'])->name('guest.profile.edit');
    Route::patch('/guest/profile', [ProfileController::class, 'update'])->name('guest.profile.update');
    Route::delete('/guest/profile', [ProfileController::class, 'destroy'])->name('guest.profile.destroy');
    Route::post('/guest/profile/photo', [GuestController::class, 'updatePhoto'])->name('guest.profile.updatePhoto');
    
    // Bookings made by guest
    Route::post('/properties/{property}', [GuestController::class, 'store'])->name('bookings.store');
    Route::get('/guest/bookings', [GuestController::class, 'myBookings'])->name('guest.bookings.index');
    Route::get('/guest/bookings/{booking}', [GuestController::class, 'viewBooking'])->name('guest.bookings.show');
    Route::patch('/bookings/{booking}/cancel', [GuestController::class, 'cancel'])->name('guest.bookings.cancel');
});
