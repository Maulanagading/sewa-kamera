<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::latest()->get();
        return view('equipment.index', compact('equipments'));
    }

    public function create()
    {
        return view('equipment.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori' => 'required|string|max:255', // Removed unique rule since there can be multiple items per category, or if it must be unique, keep it. Wait, migration said unique().
            'harga_sewa_perhari' => 'nullable|integer|min:0',
            'status_ketersediaan' => 'required|in:tersedia,disewa,diperbaik',
            'deskripsi_alat' => 'nullable|string',
        ]);

        // Catatan: Di migration, kategori diset unique(). Ini mungkin keliru jika kategori berisi "DSLR", "Mirrorless", dll karena tidak bisa ada 2 DSLR.
        // Jika migration tidak diubah, kita harus biarkan ini sesuai database.

        Equipment::create($validated);

        return redirect()->route('equipment.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    public function edit(Equipment $equipment)
    {
        return view('equipment.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga_sewa_perhari' => 'nullable|integer|min:0',
            'status_ketersediaan' => 'required|in:tersedia,disewa,diperbaik',
            'deskripsi_alat' => 'nullable|string',
        ]);

        $equipment->update($validated);

        return redirect()->route('equipment.index')->with('success', 'Data alat berhasil diperbarui!');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return redirect()->route('equipment.index')->with('success', 'Alat berhasil dihapus!');
    }
}