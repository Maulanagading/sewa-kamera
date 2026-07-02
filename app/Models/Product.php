<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Merepresentasikan tabel 'products' di dalam database.
class Product extends Model
{
    use HasFactory;

    // Mendefinisikan kolom-kolom yang diizinkan untuk diisi secara massal (mass assignment).
    // Melindungi tabel dari injeksi data pada kolom yang tidak diizinkan.
    protected $fillable = [
        'name',
        'category',
        'price',
        'image',
        'stock',
    ];
}
