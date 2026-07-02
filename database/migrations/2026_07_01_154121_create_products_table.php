<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Blueprint untuk membuat struktur tabel 'products' di database.
// Dijalankan menggunakan perintah `php artisan migrate`.
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mendefinisikan kolom-kolom untuk tabel 'products'.
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key (ID otomatis)
            $table->string('name'); // Kolom nama produk (string)
            $table->string('category'); // Kolom kategori (string)
            $table->integer('price'); // Kolom harga (integer)
            $table->string('image'); // Kolom path/URL gambar (string)
            $table->integer('stock')->default(1); // Kolom stok dengan nilai bawaan 1
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
