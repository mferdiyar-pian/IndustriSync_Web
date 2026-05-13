@extends('layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <h3 class="fw-bold mb-1">Executive Dashboard</h3>
        <p class="text-muted">Ringkasan performa bisnis IndustriSync Anda hari ini.</p>
    </div>
</div>

<!-- Summary Cards -->
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card p-4 h-100 border-0 shadow-sm">
            <div class="stat-card-icon bg-primary bg-opacity-10 text-primary mb-3">
                <i class="fas fa-wallet"></i>
            </div>
            <div class="text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">Total Penjualan</div>
            <h3 class="fw-bold mb-0 text-dark">Rp {{ number_format($totalSales, 0, ',', '.') }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 h-100 border-0 shadow-sm">
            <div class="stat-card-icon bg-success bg-opacity-10 text-success mb-3">
                <i class="fas fa-coins"></i>
            </div>
            <div class="text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">Keuntungan</div>
            <h3 class="fw-bold mb-0 text-dark">Rp {{ number_format($totalProfit, 0, ',', '.') }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 h-100 border-0 shadow-sm">
            <div class="stat-card-icon bg-warning bg-opacity-10 text-warning mb-3">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">Total Transaksi</div>
            <h3 class="fw-bold mb-0 text-dark">{{ number_format($totalTransactions, 0, ',', '.') }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 h-100 border-0 shadow-sm">
            <div class="stat-card-icon bg-info bg-opacity-10 text-info mb-3">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">Total Produk</div>
            <h3 class="fw-bold mb-0 text-dark">{{ number_format($totalProducts, 0, ',', '.') }}</h3>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-8">
        <div class="card h-100 border-0 shadow-sm overflow-hidden">
            <div class="card-header bg-white py-4 px-4 border-0">
                <h5 class="fw-bold mb-0">Tren Penjualan Mingguan</h5>
            </div>
            <div class="card-body px-4 pb-4 pt-0">
                <canvas id="salesChart" height="320"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-white py-4 px-4 border-0 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Stok Menipis</h5>
                <span class="badge rounded-pill bg-danger bg-opacity-10 text-danger px-3 py-2 fw-bold">{{ $lowStockProducts->count() }} Item</span>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($lowStockProducts as $product)
                        <div class="list-group-item d-flex justify-content-between align-items-center py-3 border-0 px-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-light p-2 rounded-3 me-3">
                                    <i class="fas fa-box text-muted"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $product->name }}</div>
                                    <div class="text-muted small">{{ $product->category->name }}</div>
                                </div>
                            </div>
                            <span class="badge bg-danger rounded-pill px-3">Sisa {{ $product->stock }}</span>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-check-circle text-success fa-3x mb-3 opacity-25"></i>
                            <p class="text-muted mb-0">Semua stok tersedia aman.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 24px;">
    <div class="card-header bg-white py-4 px-4 border-0">
        <h5 class="fw-bold mb-0">Aktivitas Transaksi Terbaru</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle border-0 mb-0">
                <thead class="bg-light text-muted small uppercase">
                    <tr>
                        <th class="ps-4 py-3 border-0">Invoice</th>
                        <th class="border-0">Pelanggan</th>
                        <th class="border-0">Total Belanja</th>
                        <th class="border-0">Status</th>
                        <th class="border-0">Waktu Transaksi</th>
                        <th class="pe-4 text-end border-0">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTransactions as $tx)
                        <tr>
                            <td class="ps-4 py-4 border-0">
                                <span class="fw-bold text-primary">{{ $tx->invoice_number }}</span>
                            </td>
                            <td class="border-0 fw-bold">{{ $tx->user->name }}</td>
                            <td class="border-0">
                                <span class="fw-bold text-dark">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</span>
                            </td>
                            <td class="border-0">
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold">Paid</span>
                            </td>
                            <td class="border-0 text-muted">{{ $tx->created_at->format('d M Y, H:i') }}</td>
                            <td class="pe-4 text-end border-0">
                                <a href="{{ route('transactions.show', $tx->id) }}" class="btn btn-sm btn-light rounded-pill px-3 border-0 fw-bold">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(37, 99, 235, 0.2)');
    gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($salesData->keys()) !!},
            datasets: [{
                label: 'Penjualan',
                data: {!! json_encode($salesData->values()) !!},
                backgroundColor: gradient,
                borderColor: '#2563eb',
                borderWidth: 4,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#2563eb',
                pointBorderWidth: 2,
                pointRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                x: { grid: { display: false } }
            },
            plugins: { legend: { display: false } }
        }
    });
</script>
@endpush
