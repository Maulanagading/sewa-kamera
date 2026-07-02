<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;

// Menangani permintaan GET pada root URL ('/')
// Mengarahkan permintaan ke fungsi 'index' di dalam HomeController
Route::get('/', [HomeController::class, 'index']);