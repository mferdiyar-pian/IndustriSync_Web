@extends('layouts.app')

@section('content')
<div class="row mb-5 align-items-center">
    <div class="col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('integrations.index') }}" class="text-decoration-none">Integrasi</a></li>
                <li class="breadcrumb-item active">Shopee</li>
            </ol>
        </nav>
        <h3 class="fw-bold mb-0">Integrasi Shopee</h3>
    </div>
    <div class="col-md-4 text-md-end">
        <form action="{{ route('integrations.shopee.sync') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                <i class="fas fa-sync-alt me-2"></i> Sinkronkan Sekarang
            </button>
        </form>
    </div>
</div>

<div class="row g-4">
    <!-- Config Card -->
    <div class="col-md-7">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h5 class="fw-bold mb-4">Pengaturan API Shopee</h5>
            <form>
                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted text-uppercase">Partner ID</label>
                    <input type="text" class="form-control form-control-lg rounded-3 bg-light border-0" placeholder="Masukkan Partner ID Shopee Anda" value="123456" readonly>
                    <div class="form-text small">Didapatkan dari Shopee Open Platform Console.</div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted text-uppercase">Partner Key</label>
                    <div class="input-group">
                        <input type="password" class="form-control form-control-lg rounded-start-3 bg-light border-0" value="••••••••••••••••" readonly>
                        <button class="btn btn-light border-0 rounded-end-3 px-3" type="button"><i class="far fa-eye"></i></button>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted text-uppercase">Status Autentikasi</label>
                    <div class="d-flex align-items-center p-3 bg-success bg-opacity-10 rounded-4 text-success border border-success border-opacity-25">
                        <i class="fas fa-check-circle fa-2x me-3"></i>
                        <div>
                            <div class="fw-bold">Terkoneksi Berhasil</div>
                            <div class="small">Token aktif hingga 24 Mei 2026.</div>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-danger rounded-pill px-4 fw-bold">
                    Putuskan Koneksi
                </button>
            </form>
        </div>
    </div>

    <!-- Stats Card -->
    <div class="col-md-5">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h5 class="fw-bold mb-4">Informasi Sinkronisasi</h5>
            
            <div class="list-group list-group-flush">
                <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center border-0">
                    <div class="text-muted small fw-bold text-uppercase">Terakhir Sinkron</div>
                    <div class="fw-bold text-dark">Hari ini, 10:45 WIB</div>
                </div>
                <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center border-0">
                    <div class="text-muted small fw-bold text-uppercase">Total Produk Shopee</div>
                    <div class="fw-bold text-dark">45 Item</div>
                </div>
                <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center border-0">
                    <div class="text-muted small fw-bold text-uppercase">Produk Tidak Sinkron</div>
                    <div class="fw-bold text-danger">3 Item</div>
                </div>
            </div>

            <hr class="my-4 opacity-10">

            <div class="p-3 bg-light rounded-4">
                <h6 class="fw-bold mb-2 small text-muted text-uppercase">Log Aktivitas Terbaru</h6>
                <div class="small mb-2">
                    <span class="text-success fw-bold">SUCCESS:</span> Update stok "Botol Minum 1L" (Shopee)
                </div>
                <div class="small mb-2">
                    <span class="text-success fw-bold">SUCCESS:</span> Download pesanan #24A5S1 (Shopee)
                </div>
                <div class="small text-danger fw-bold">
                    ERROR: Gagal sinkron harga "Tas Ransel" (API Timeout)
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm p-4 bg-primary text-white" style="background: linear-gradient(135deg, #2563eb, #6366f1); border-radius: 24px;">
            <div class="row align-items-center">
                <div class="col-md-1 text-center">
                    <i class="fas fa-lightbulb fa-3x opacity-50"></i>
                </div>
                <div class="col-md-8">
                    <h5 class="fw-bold mb-1">Butuh Bantuan Integrasi?</h5>
                    <p class="mb-0 opacity-75">Lihat panduan lengkap cara mendapatkan Partner ID dan Partner Key di dokumentasi Shopee Open Platform kami.</p>
                </div>
                <div class="col-md-3 text-md-end">
                    <a href="#" class="btn btn-white text-primary rounded-pill fw-bold px-4 bg-white border-0 shadow-sm">Buka Panduan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
