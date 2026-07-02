<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Berfungsi untuk mengisi data awal (dummy data) khusus untuk tabel 'products'.
// Menghindari input data secara manual dan mempercepat proses testing.
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Kamera (2)
            ['name' => 'Sony a6400', 'category' => 'Kamera', 'price' => 150000, 'image' => 'img/sony a6400.jpg', 'stock' => 1],
            ['name' => 'Canon 700d', 'category' => 'Kamera', 'price' => 100000, 'image' => 'img/canon 700d.jpg', 'stock' => 1],
            
            // Lensa (4)
            ['name' => 'Lensa kit sony 16-50mm', 'category' => 'Lensa', 'price' => 30000, 'image' => 'img/Sony E 16-50mm f3.5-5.6 OSS PZ Lens.jpg', 'stock' => 1],
            ['name' => 'Lensa canon 50mm f1.8', 'category' => 'Lensa', 'price' => 25000, 'image' => 'img/Canon-EF-50mm-f18-STM-Lens-1.jpg', 'stock' => 1],
            ['name' => 'viltrox air 35mm e-mount', 'category' => 'Lensa', 'price' => 30000, 'image' => 'img/viltrox air 35mm f1.8 e mount.jpg', 'stock' => 1],
            ['name' => 'lensa kit canon 18-55mm', 'category' => 'Lensa', 'price' => 30000, 'image' => 'img/Canon-EF-S-18-55mm-f35-56-IS-STM-Lens-1.jpg', 'stock' => 1],
            
            // Aksesoris (7)
            ['name' => 'baterai sony a6400(np-fw50)', 'category' => 'Aksesoris', 'price' => 20000, 'image' => 'img/np-FW50.jpg', 'stock' => 2],
            ['name' => 'baterai canon 700d(lp-e8)', 'category' => 'Aksesoris', 'price' => 15000, 'image' => 'img/KINGMA lp e8.jpg', 'stock' => 2],
            ['name' => 'Dji rs4 mini', 'category' => 'Aksesoris', 'price' => 150000, 'image' => 'img/dji rs 4 mini.jpg', 'stock' => 1],
            ['name' => 'tripod takara rover66', 'category' => 'Aksesoris', 'price' => 100000, 'image' => 'img/TakaraRover66.jpg', 'stock' => 1],
            ['name' => 'nd vilter 46mm', 'category' => 'Aksesoris', 'price' => 20000, 'image' => 'img/nd vilter.jpg', 'stock' => 1],
            ['name' => 'cpl vilter 46mm', 'category' => 'Aksesoris', 'price' => 20000, 'image' => 'img/cpl filter.jpg', 'stock' => 1],
            ['name' => 'black mist filter 46mm', 'category' => 'Aksesoris', 'price' => 20000, 'image' => 'img/blackmist.jpg', 'stock' => 1],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
