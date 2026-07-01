<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        // Mengambil semua data alat dari database
        $equipments = Equipment::all();

        // Mengirim data tersebut ke file tampilan bernama 'welcome'
        return view('welcome', compact('equipments'));
    }
}