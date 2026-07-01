<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;

// Mengarahkan halaman utama (/) langsung ke halaman katalog
Route::get('/', [HomeController::class, 'index']);