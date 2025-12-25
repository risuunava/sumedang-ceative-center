<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sop', [HomeController::class, 'sop'])->name('sop');
Route::get('/room/{slug}', [HomeController::class, 'roomDetail'])->name('room.detail');
Route::post('/check-availability', [HomeController::class, 'checkAvailability'])->name('check.availability');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    
    // Booking routes
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/room/{slug}/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::post('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
});

// Admin routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{booking}/status', [AdminController::class, 'updateBookingStatus'])->name('bookings.update-status');
    Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');
    Route::get('/rooms/{room}/edit', [AdminController::class, 'editRoom'])->name('rooms.edit');
    Route::match(['put', 'patch'], '/rooms/{room}', [AdminController::class, 'updateRoom'])->name('rooms.update');
    Route::get('/export-bookings', [AdminController::class, 'exportBookings'])->name('export.bookings');
});