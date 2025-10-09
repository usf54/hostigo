<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Filter Controller
use App\Http\Controllers\FilterController;
use App\Http\Controllers\PublicController;

// Admin Controllers
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\ReviewController;

// Host Controllers
use App\Http\Controllers\Host\BookingController as HostBookingController;
use App\Http\Controllers\Host\PropertyController as HostPropertyController;
use App\Http\Controllers\Host\HostController;
use App\Http\Controllers\Host\ProfileHostController;


// Guest Controllers
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Guest\ProfileGuestController;
use App\Http\Controllers\Guest\BookingController as GuestBookingController;
use App\Http\Controllers\Guest\StripeController;

// Inertia
use Inertia\Inertia;

// ==================================  EMAIL VERIFICATION ROUTES ================================== //
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


// ==================================  Public ROUTES for unauth  ================================== //
// Home page
Route::get('/', [PublicController::class, 'home'])->name('welcome');

// About page
Route::get('/about', function () {
    return view('pages.about');
});

// Contact page
Route::get('/contact', function () {
    return view('pages.contact');
});


// ==================================  Public Guest ROUTES  ================================== //
Route::middleware(['auth', 'verified'])->group(function()  {
    Route::get('/explore', [PublicController::class, 'explore']);
    Route::get('/explore/details/{id}', [PublicController::class, 'showProperty'])->name('public.property.details');
    Route::get('/properties-filter', [PublicController::class, 'filter'])->name('public.properties');
    Route::get('/hosts/{host}', [HostController::class, 'showHostProfile'])->name('host.profile.show');
});


// ==================================  ADMIN ROUTES  ================================== //
Route::middleware(['auth', 'is_admin', 'verified'])->group(function () {
    // Admin Amenities Management
    Route::get('/amenities', [AmenityController::class, 'index'])->name('amenities.index');
    Route::get('/amenities/{id}', [AmenityController::class, 'show'])->name('amenities.show');
    Route::get('/amenities/{id}/edit', [AmenityController::class, 'edit'])->name('amenities.edit');
    Route::put('/amenities/{id}', [AmenityController::class, 'update'])->name('amenities.update');
    Route::delete('/amenities/{id}', [AmenityController::class, 'destroy'])->name('amenities.destroy');
    
    
    // Admin Bookings Management
    Route::get('/bookings', [BookingController::class,'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    
    // Admin Dashboard
    Route::get('/dashboard',function () {
        return inertia('Dashboard');
    })->name('dashboard');
    
    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::put('/payments/{id}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    // Admin Properties Management
    Route::get('/properties', [PropertyController::class,'index'])->name('properties.index');
    Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');
    Route::get('/properties/{id}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{id}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');

    // Admin Reports
    Route::get('/reports', [ReportController::class,'index'])->name('reports.index');
    
    // Settings
    Route::get('/settings', [SettingController::class,'index'])->name('settings.index');
    
    // Reviews Management
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');
    Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');    

    // Users Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');    
});


// ==================================  HOST ROUTES  ================================== //
Route::middleware(['auth', 'is_host', 'verified'])->group(function () {
    
    // Host BookingController
    Route::get('/host/bookings', [HostBookingController::class, 'incomingBookings'])->name('host.bookings.index');
    Route::get('/host/booking/{id}', [HostBookingController::class, 'viewBooking'])->name('host.bookings.show');
    Route::patch('/host/bookings/{booking}/approve', [HostBookingController::class, 'approve'])->name('host.bookings.approve');
    Route::patch('/host/bookings/{booking}/decline', [HostBookingController::class, 'decline'])->name('host.bookings.decline');
    
    // HOST ROUTES
    Route::get('/my-properties', [HostPropertyController::class, 'index'])->name('property.index');
    Route::get('/property/create', [HostPropertyController::class, 'create'])->name('property.create');
    Route::post('/property', [HostPropertyController::class, 'store'])->name('property.store');
    Route::get('/property/{id}', [HostPropertyController::class, 'show'])->name('property.show');
    Route::get('/property/{id}/edit', [HostPropertyController::class, 'edit'])->name('property.edit');
    Route::put('/property/{id}', [HostPropertyController::class, 'update'])->name('property.update');
    Route::delete('/property/{id}', [HostPropertyController::class, 'destroy'])->name('property.destroy');
    
    
    // Host Profile routes
    Route::get('/host/profile', [ProfileHostController::class, 'index'])->name('host.profile.index');
    Route::get('/host/profile/edit', [ProfileHostController::class, 'edit'])->name('host.profile.edit');
    Route::post('/host/profile/photo', [ProfileHostController::class, 'updatePhoto'])->name('host.profile.updatePhoto');
    Route::patch('/host/profile', [ProfileHostController::class, 'update'])->name('host.profile.update');
    Route::delete('/host/profile', [ProfileHostController::class, 'destroy'])->name('host.profile.destroy');
});


// ==================================  GUEST ROUTES  ================================== //
Route::middleware(['auth', 'is_guest', 'verified'])->group(function () {
    // Guest BookingController
    Route::post('/properties/{property}', [GuestBookingController::class, 'store'])->name('bookings.store');
    Route::patch('/bookings/{booking}/cancel', [GuestBookingController::class, 'cancel'])->name('guest.bookings.cancel');
    
    // Guest GuestController
    Route::get('/guest/bookings', [GuestController::class, 'myBookings'])->name('guest.bookings.index');
    Route::get('/guest/bookings/{booking}', [GuestController::class, 'viewBooking'])->name('guest.bookings.show');

    // Guest Payment routes 
    Route::get('/booking/{booking}/checkout', [StripeController::class, 'checkout'])->name('checkout');
    Route::get('/payment/success', [StripeController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/cancel', [StripeController::class, 'paymentCancel'])->name('payment.cancel');
    
       // Guest Profile routes
    Route::get('/guest/profile', [ProfileGuestController::class, 'index'])->name('guest.profile.index');
    Route::get('/guest/profile/edit', [ProfileGuestController::class, 'edit'])->name('guest.profile.edit');
    Route::post('/guest/profile/photo', [ProfileGuestController::class, 'updatePhoto'])->name('guest.profile.updatePhoto');
    Route::patch('/guest/profile', [ProfileGuestController::class, 'update'])->name('guest.profile.update');
    Route::delete('/guest/profile', [ProfileGuestController::class, 'destroy'])->name('guest.profile.destroy');
});
require __DIR__.'/auth.php';
