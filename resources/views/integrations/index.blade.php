@extends('layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <h3 class="fw-bold mb-1">Integrasi Marketplace</h3>
        <p class="text-muted">Hubungkan IndustriSync dengan marketplace favorit Anda untuk sinkronisasi stok dan pesanan secara otomatis.</p>
    </div>
</div>

<div class="row g-4">
    <!-- Shopee Integration Card -->
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-orange bg-opacity-10 p-3 rounded-4 me-3" style="background-color: #ee4d2d1a;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Shopee.svg" alt="Shopee" width="40">
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Shopee</h5>
                        <span class="badge bg-success rounded-pill px-3">Tersedia</span>
                    </div>
                </div>
                <p class="text-muted small mb-4">Sinkronkan stok produk, harga, dan manajemen pesanan Shopee langsung dari dashboard IndustriSync.</p>
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Status Koneksi</span>
                        <span class="text-danger fw-bold">Terputus</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-danger" style="width: 0%"></div>
                    </div>
                </div>

                <a href="{{ route('integrations.shopee') }}" class="btn btn-primary w-100 rounded-pill fw-bold py-2">
                    Mulai Integrasi
                </a>
            </div>
        </div>
    </div>

    <!-- Tokopedia Integration Card (Mockup) -->
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm opacity-75" style="filter: grayscale(0.5);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="p-3 rounded-4 me-3" style="background-color: #42b5491a;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/bc/Tokopedia.svg" alt="Tokopedia" width="40">
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Tokopedia</h5>
                        <span class="badge bg-secondary rounded-pill px-3">Segera Hadir</span>
                    </div>
                </div>
                <p class="text-muted small mb-4">Integrasi dengan Tokopedia untuk pengelolaan toko yang lebih efisien di berbagai platform.</p>
                <button class="btn btn-outline-secondary w-100 rounded-pill fw-bold py-2" disabled>
                    Hubungi Support
                </button>
            </div>
        </div>
    </div>

    <!-- TikTok Shop Integration Card (Mockup) -->
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm opacity-75" style="filter: grayscale(0.5);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-dark bg-opacity-10 p-3 rounded-4 me-3">
                        <i class="fab fa-tiktok fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">TikTok Shop</h5>
                        <span class="badge bg-secondary rounded-pill px-3">Segera Hadir</span>
                    </div>
                </div>
                <p class="text-muted small mb-4">Manfaatkan tren *social commerce* dengan menghubungkan TikTok Shop Anda ke IndustriSync.</p>
                <button class="btn btn-outline-secondary w-100 rounded-pill fw-bold py-2" disabled>
                    Hubungi Support
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
