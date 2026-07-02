<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class HomeController extends Controller
{
    // Mengatur data dan tampilan untuk halaman utama
    public function index()
    {
        // Mengambil seluruh data produk dari tabel 'products'
        // dan mengelompokkannya berdasarkan kolom 'category'
        $products = Product::all()->groupBy('category');
        
        // Menampilkan view resources/views/welcome.blade.php
        // dan mengirimkan variabel $products ke view tersebut
        return view('welcome', compact('products'));
    }
}
