@extends('user.layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="d-md-flex align-items-center justify-content-between">
            <div>
                <h2 class="fw-bold mb-1 text-gradient">{{ __('Hello') }}, {{ explode(' ', auth()->user()->name)[0] }}! 👋</h2>
                <p class="text-secondary">Berikut ringkasan aktivitas belanja dan akun Anda hari ini.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('user.products.index') }}" class="btn btn-primary-user shadow">
                    <i class="fas fa-shopping-cart me-2"></i> Mulai Belanja
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Stats -->
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon-box bg-primary bg-opacity-10 text-primary">
                <i class="fas fa-wallet"></i>
            </div>
            <div class="text-muted small fw-bold uppercase" style="letter-spacing: 0.05em">Total Pengeluaran</div>
            <div class="h3 fw-bold mt-1">Rp {{ number_format($totalSpent, 0, ',', '.') }}</div>
            <div class="small text-success mt-2">
                <i class="fas fa-arrow-up me-1"></i> 12% bulan ini
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon-box bg-success bg-opacity-10 text-success">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="text-muted small fw-bold uppercase" style="letter-spacing: 0.05em">Total Pesanan</div>
            <div class="h3 fw-bold mt-1">{{ $totalTransactions }}</div>
            <div class="small text-muted mt-2">Pesanan sukses tercatat</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon-box bg-warning bg-opacity-10 text-warning">
                <i class="fas fa-box"></i>
            </div>
            <div class="text-muted small fw-bold uppercase" style="letter-spacing: 0.05em">Produk Katalog</div>
            <div class="h3 fw-bold mt-1">{{ \App\Models\Product::count() }}</div>
            <div class="small text-muted mt-2">Di marketplace kami</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon-box bg-info bg-opacity-10 text-info">
                <i class="fas fa-star"></i>
            </div>
            <div class="text-muted small fw-bold uppercase" style="letter-spacing: 0.05em">Poin Member</div>
            <div class="h3 fw-bold mt-1">1,250</div>
            <div class="small text-primary mt-2">Tingkat Silver Member</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Chart Section -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 24px;">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="fw-bold mb-0">Statistik Transaksi</h5>
                <select class="form-select border-0 bg-light rounded-pill small" style="width: 150px;">
                    <option>7 Hari Terakhir</option>
                    <option>30 Hari Terakhir</option>
                </select>
            </div>
            <div style="height: 350px;">
                <canvas id="userExpChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Quick Actions / Notifications -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 24px;">
            <h5 class="fw-bold mb-3">Pusat Notifikasi</h5>
            <div class="notification-list">
                <div class="d-flex align-items-start mb-3">
                    <div class="rounded-circle bg-danger bg-opacity-10 p-2 text-danger me-3">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div>
                        <div class="small fw-bold">Update Harga Produk</div>
                        <div class="text-muted" style="font-size: 0.75rem">Ada perubahan harga pada item di wishlist Anda.</div>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-2 text-primary me-3">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div>
                        <div class="small fw-bold">Kupon Belanja Baru</div>
                        <div class="text-muted" style="font-size: 0.75rem">Gunakan kode 'SYNCFREE' untuk diskon ongkir.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4 text-white" style="border-radius: 24px; background: linear-gradient(135deg, #2563eb, #1d4ed8);">
            <div class="mb-3">
                <i class="fas fa-crown fa-2x opacity-50"></i>
            </div>
            <h5 class="fw-bold mb-2">Upgrade Pro Plan</h5>
            <p class="small opacity-75 mb-4">Dapatkan akses ke fitur premium, monitoring stok advanced, dan prioritas layanan UMKM.</p>
            <button class="btn btn-light w-100 rounded-pill fw-bold py-2">Bandingkan Paket</button>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 24px;">
            <div class="p-4 d-flex align-items-center justify-content-between border-bottom border-light">
                <h5 class="fw-bold mb-0">Riwayat Belanja Terakhir</h5>
                <a href="{{ route('user.transactions.index') }}" class="btn btn-light rounded-pill px-3 py-1 small fw-bold">Lihat Semua</a>
            </div>
            <div class="table-responsive p-3">
                <table class="table table-hover align-middle border-0 mb-0">
                    <thead>
                        <tr class="text-muted small">
                            <th class="ps-3">Invoice</th>
                            <th>Kuantitas</th>
                            <th>Total Pembayaran</th>
                            <th>Status Transaksi</th>
                            <th class="text-end pe-3">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions as $tx)
                        <tr>
                            <td class="ps-3"><span class="fw-bold text-primary">{{ $tx->invoice_number }}</span></td>
                            <td>{{ $tx->details->sum('quantity') }} Item</td>
                            <td><span class="fw-bold text-dark">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</span></td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i> Success
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                <a href="{{ route('user.transactions.show', $tx->id) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                    Lihat <i class="fas fa-chevron-right ms-1" style="font-size: 0.6rem"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted opacity-50">
                                    <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                                    <p>Belum ada riwayat transaksi.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .text-gradient {
        background: linear-gradient(135deg, #1e293b, #2563eb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('userExpChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(37, 99, 235, 0.1)');
    gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($txData->keys()) !!},
            datasets: [{
                label: 'Pengeluaran',
                data: {!! json_encode($txData->values()) !!},
                borderColor: '#2563eb',
                borderWidth: 4,
                backgroundColor: gradient,
                fill: true,
                tension: 0.45,
                pointRadius: 0,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: '#2563eb',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    titleFont: { size: 14, family: 'Outfit' },
                    bodyFont: { size: 14, family: 'Outfit' },
                    displayColors: false,
                    callbacks: {
                        label: (context) => 'Rp ' + context.parsed.y.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f1f5f9', borderDash: [5, 5] },
                    ticks: { 
                        color: '#94a3b8', 
                        font: { family: 'Outfit' },
                        callback: value => 'Rp ' + value.toLocaleString('id-ID')
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8', font: { family: 'Outfit' } }
                }
            }
        }
    });
</script>
@endpush
