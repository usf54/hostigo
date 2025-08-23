<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HostController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Guest\GuestController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/property-details', function () {
    return view('property.property-details');
});
Route::get('/explore', function () {
    return view('pages.explore');
});
Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/contact', function () {
    return view('pages.contact');
});


Route::middleware(['auth', 'is_host'])->group(function () {
    // HOST ROUTES
    Route::get('/my-properties', [HostController::class, 'index'])->name('property.index');
    Route::get('/property/create', [HostController::class, 'create'])->name('property.create');
    Route::post('/property', [HostController::class, 'store'])->name('property.store');
    Route::get('/property/{id}', [HostController::class, 'show'])->name('property.show');
    Route::get('/property/{id}/edit', [HostController::class, 'edit'])->name('property.edit');
    Route::put('/property/{id}', [HostController::class, 'update'])->name('property.update');
    Route::delete('/property/{id}', [HostController::class, 'destroy'])->name('property.destroy');
    
    // HOST BOOKING ROUTES
    Route::get('/my-bookings', [HostController::class, 'myBookings'])->name('booking.index');
    Route::get('/view-booking', [HostController::class, 'viewBooking'])->name('booking.show');

    Route::get('/profile/show', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin routes
Route::middleware(['auth', 'is_admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users Management
    Route::resource('users', UserController::class);

    // Properties Management
    Route::resource('properties', PropertyController::class);

    // Bookings Management
    Route::resource('bookings', BookingController::class);

    // Payments
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
});

// GUEST ROUTES
Route::middleware(['auth', 'is_guest'])->group(function () {
    // Profile routes
    Route::get('/guest/profile', [ProfileController::class, 'index'])->name('guest.profile.index');
    Route::get('/guest/profile/edit', [ProfileController::class, 'edit'])->name('guest.profile.edit');
    Route::patch('/guest/profile', [ProfileController::class, 'update'])->name('guest.profile.update');
    Route::delete('/guest/profile', [ProfileController::class, 'destroy'])->name('guest.profile.destroy');

    // Bookings made by guest
    Route::get('/guest/bookings', [GuestController::class, 'myBookings'])->name('guest.bookings.index');
    Route::get('/guest/bookings/{booking}', [GuestController::class, 'viewBooking'])->name('guest.bookings.show');

    
});
