<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // HOST ROUTES
    Route::get('/my-properties', [HostController::class, 'index'])->name('property.index');
    Route::get('/property/create', [HostController::class, 'create'])->name('property.create');
    Route::get('/property/edit', [HostController::class, 'edit'])->name('property.edit');
    Route::get('/property/show', [HostController::class, 'show'])->name('property.show');
    
    // HOST BOOKING ROUTES
    Route::get('/my-bookings', [HostController::class, 'myBookings'])->name('booking.index');
    Route::get('/view-booking', [HostController::class, 'viewBooking'])->name('booking.show');

    Route::get('/profile/show', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
