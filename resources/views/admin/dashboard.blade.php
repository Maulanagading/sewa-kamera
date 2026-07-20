@extends('layouts.admin')

@section('title', 'Dashboard - Admin')
@section('page_title', 'Dashboard')

@push('styles')
<style>
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .kpi-card {
        background: #fff;
        border-radius: var(--radius);
        padding: 20px;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
    }
    
    .kpi-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: var(--primary);
    }
    
    .kpi-card:nth-child(2)::before { background: #f2994a; }
    .kpi-card:nth-child(3)::before { background: #ff4444; }
    .kpi-card:nth-child(4)::before { background: #9b51e0; }

    .kpi-title {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 8px;
        font-weight: 600;
    }
    
    .kpi-value {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-main);
    }
    
    .kpi-trend {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--success);
        position: absolute;
        top: 20px;
        right: 20px;
    }
    
    .kpi-chart {
        margin-top: 15px;
        height: 40px;
        background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 100 30" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,30 Q25,0 50,20 T100,10 L100,30 L0,30" fill="%230056ff22"/></svg>') no-repeat bottom;
        background-size: 100% 100%;
        border-bottom: 2px solid var(--primary);
    }
    .kpi-card:nth-child(2) .kpi-chart {
        background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 100 30" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,30 Q20,10 40,25 T100,5 L100,30 L0,30" fill="%23f2994a22"/></svg>');
        border-color: #f2994a;
    }

    .main-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 25px;
    }

    .chart-container {
        height: 300px;
        width: 100%;
        position: relative;
    }
</style>
@endpush

@section('content')

<div class="kpi-grid">
    <div class="kpi-card">
        <div class="kpi-title">Total Alat / Produk</div>
        <div class="kpi-value">{{ number_format($totalProducts) }}</div>
        <div class="kpi-trend">+15.9%</div>
        <div class="kpi-chart"></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-title">Total Pengguna Aktif</div>
        <div class="kpi-value">{{ number_format($totalUsers) }}</div>
        <div class="kpi-trend">+10.1%</div>
        <div class="kpi-chart"></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-title">Total Pesanan</div>
        <div class="kpi-value">{{ number_format($totalBookings) }}</div>
        <div class="kpi-trend" style="color:var(--danger)">-5.1%</div>
        <div class="kpi-chart"></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-title">Total Pendapatan (Selesai)</div>
        <div class="kpi-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        <div class="kpi-trend">+9.9%</div>
        <div class="kpi-chart"></div>
    </div>
</div>

<div class="main-grid">
    <!-- Chart -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pesanan Bulanan</h3>
            <span class="material-symbols-outlined" style="color:var(--text-muted); cursor:pointer;">more_horiz</span>
        </div>
        <div class="chart-container">
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pesanan Terbaru</h3>
            <a href="{{ route('admin.bookings') }}" class="btn btn-ghost" style="font-size:0.75rem; color:var(--primary); text-decoration:none;">Lihat Semua</a>
        </div>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBookings as $i => $b)
                        <tr>
                            <td style="font-weight:600; color:var(--text-muted);">{{ $i + 1 }}</td>
                            <td style="font-weight:600;">{{ $b->user->name ?? 'Guest' }}</td>
                            <td>{{ $b->product->name ?? 'Alat Dihapus' }}</td>
                            <td>{{ $b->quantity }}x</td>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding:30px; color:var(--text-muted);">Belum ada pesanan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('barChart').getContext('2d');
    
    // Gradient untuk bar
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, '#ff4d2e');
    gradient.addColorStop(1, '#ffa899');

    const chartData = {!! json_encode($chartData) !!};
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Jumlah Pesanan',
                data: chartData,
                backgroundColor: gradient,
                borderRadius: 4,
                barThickness: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { display: false },
                x: {
                    grid: { display: false, drawBorder: false },
                    ticks: { color: '#a3aed1', font: { size: 11, family: 'Inter' } }
                }
            }
        }
    });
</script>
@endpush
