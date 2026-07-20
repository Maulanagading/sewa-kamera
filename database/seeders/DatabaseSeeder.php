<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Seeder utama yang bertugas memanggil seeder-seeder lainnya.
// Dijalankan pertama kali saat menggunakan perintah `php artisan db:seed`.
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil ProductSeeder untuk memasukkan data dummy produk ke database.
        $this->call([
            ProductSeeder::class,
        ]);

        \App\Models\User::create([
            'name' => 'Admin Gading',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1123'),
            'role' => 'admin',
        ]);
    }
}
