<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

// Root langsung ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

use App\Http\Controllers\BookingController;

// Auth Routes (Logged In)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman Katalog (User biasa dan Admin bisa lihat)
    Route::get('/katalog', [HomeController::class, 'index'])->name('katalog');

    // Proses Booking & Pembayaran
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/payment', [BookingController::class, 'payment'])->name('booking.payment');
    Route::post('/booking/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
});

// Admin Routes
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/bookings', [\App\Http\Controllers\AdminController::class, 'bookings'])->name('admin.bookings');
    Route::post('/bookings/{id}/complete', [\App\Http\Controllers\AdminController::class, 'completeBooking'])->name('admin.bookings.complete');

    // Prefix admin untuk equipment
    Route::resource('equipment', EquipmentController::class);
});

// Route untuk Asisten AI
Route::post('/ai-ask', [\App\Http\Controllers\AiController::class, 'ask'])->name('ai.ask');
