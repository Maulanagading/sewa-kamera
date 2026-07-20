@extends('layouts.admin')

@section('title', 'Manajemen Alat - Admin')
@section('page_title', 'Manajemen Alat')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Alat / Katalog</h3>
        <a href="{{ route('equipment.create') }}" class="btn btn-primary">
            <span class="material-symbols-outlined" style="font-size:1.2rem;">add</span> Tambah Alat Baru
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>Nama Alat</th>
                    <th>Kategori</th>
                    <th>Harga / Hari</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipments as $item)
                <tr>
                    <td style="font-weight: 600; color:var(--text-main);">{{ $item->nama_alat }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td style="font-family: monospace; font-size: 0.95rem; font-weight:600;">Rp {{ number_format($item->harga_sewa_perhari, 0, ',', '.') }}</td>
                    <td>
                        @if($item->status_ketersediaan == 'Tersedia')
                            <span class="badge badge-success">Tersedia</span>
                        @elseif($item->status_ketersediaan == 'Disewa')
                            <span class="badge badge-warning">Disewa</span>
                        @else
                            <span class="badge badge-danger">{{ $item->status_ketersediaan }}</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex; gap:10px;">
                            <a href="{{ route('equipment.edit', $item->id) }}" class="btn" style="padding: 6px 12px; font-size: 0.8rem; background:var(--line); color:var(--text-main);">Edit</a>
                            <form action="{{ route('equipment.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 0.8rem;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 30px;">Belum ada data alat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
