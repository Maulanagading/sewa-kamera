<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat');
            $table->string('kategori')->unique();
            $table->integer('harga_sewa_perhari')->nullable();
            $table->enum('status_ketersediaan', ['tersedia', 'disewa', 'diperbaik'])->default('tersedia');
            $table->text('deskripsi_alat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
