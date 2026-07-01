<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        Equipment::create([
            'nama_alat' => 'Sony a6400 (Body Only)',
            'kategori' => 'Bodi',
            'harga_sewa_perhari' => 150000,
            'status_ketersediaan' => 'tersedia',
            'deskripsi_alat' => 'Kamera mirrorless APS-C dengan autofokus cepat, cocok untuk foto dan video.'
        ]);

        Equipment::create([
            'nama_alat' => 'Lensa Viltrox 23mm f1.4 AF Sony E-Mount',
            'kategori' => 'Lensa',
            'harga_sewa_perhari' => 75000,
            'status_ketersediaan' => 'tersedia',
            'deskripsi_alat' => 'Lensa prime autofokus dengan bukaan besar f1.4, sangat bagus untuk bokeh dan kondisi minim cahaya.'
        ]);

        Equipment::create([
            'nama_alat' => 'DJI RS4 Mini Stabilizer',
            'kategori' => 'Stabilizer',
            'harga_sewa_perhari' => 100000,
            'status_ketersediaan' => 'tersedia',
            'deskripsi_alat' => 'Gimbal stabilizer ringkas untuk kamera mirrorless, menjaga rekaman video tetap stabil.'
        ]);

        Equipment::create([
            'nama_alat' => 'Flash Godox V860III Sony',
            'kategori' => 'Lighting',
            'harga_sewa_perhari' => 50000,
            'status_ketersediaan' => 'tersedia',
            'deskripsi_alat' => 'Flash eksternal profesional dengan baterai Li-ion yang tahan lama dan mendukung TTL.'
        ]);
    }
}