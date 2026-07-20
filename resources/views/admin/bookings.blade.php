@extends('layouts.admin')

@section('title', 'Riwayat Pesanan - Admin')
@section('page_title', 'Riwayat Pesanan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Semua Pesanan</h3>
    </div>

    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>ID / Ref</th>
                    <th>Pelanggan</th>
                    <th>Alat & Kuantitas</th>
                    <th>Durasi Sewa</th>
                    <th>Total Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $b)
                    <tr>
                        <td style="font-family:monospace; font-weight:600; font-size:0.85rem; color:var(--text-muted);">
                            #{{ str_pad($b->id, 5, '0', STR_PAD_LEFT) }}<br>
                            <span style="font-size:0.7rem;">{{ $b->created_at->format('d M Y') }}</span>
                        </td>
                        <td style="font-weight:600;">{{ $b->user->name ?? 'Guest' }}</td>
                        <td>
                            <div style="font-weight:600; color:var(--text-main);">{{ $b->product->name ?? 'Alat Dihapus' }}</div>
                            <div style="font-size:0.75rem; color:var(--text-muted);">Kuantitas: {{ $b->quantity }} pcs</div>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($b->tanggal_mulai)->format('d M y') }} - 
                            {{ \Carbon\Carbon::parse($b->tanggal_selesai)->format('d M y') }}
                        </td>
                        <td style="font-family:monospace; font-weight:600;">Rp {{ number_format($b->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @if($b->status_pesanan == 'Menunggu Pembayaran')
                                <span class="badge badge-warning">Menunggu</span>
                            @elseif($b->status_pesanan == 'Dibayar')
                                <span class="badge" style="background:rgba(0,86,255,0.1); color:var(--primary)">Dibayar</span>
                            @elseif($b->status_pesanan == 'Selesai')
                                <span class="badge badge-success">Selesai</span>
                            @else
                                <span class="badge badge-danger">{{ $b->status_pesanan }}</span>
                            @endif
                        </td>
                        <td>
                            @if($b->status_pesanan == 'Dibayar' || $b->status_pesanan == 'Sedang Disewa')
                                <form action="{{ route('admin.bookings.complete', $b->id) }}" method="POST" onsubmit="return confirm('Tandai pesanan ini Selesai? Stok produk akan otomatis bertambah.');">
                                    @csrf
                                    <button type="submit" class="btn btn-success" style="padding:6px 12px; font-size:0.75rem;">
                                        <span class="material-symbols-outlined" style="font-size:1rem;">check_circle</span>
                                        Selesai & Restok
                                    </button>
                                </form>
                            @else
                                <span style="font-size:0.8rem; color:var(--text-muted);">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:30px; color:var(--text-muted);">Tidak ada riwayat pemesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
