@extends('user.layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <a href="{{ route('user.products.index') }}" class="btn btn-light rounded-pill px-3 py-2 mb-4 border-0 small fw-bold">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Marketplace
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm overflow-hidden mb-5" style="border-radius: 32px;">
    <div class="row g-0">
        <div class="col-md-5">
            <div class="position-relative h-100">
                <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://ui-avatars.com/api/?name='.urlencode($product->name).'&background=random' }}" 
                     class="img-fluid w-100 h-100" style="object-fit: cover; min-height: 500px;">
                
                <form action="{{ route('user.wishlist.toggle', $product->id) }}" method="POST" class="position-absolute top-0 end-0 p-4">
                    @csrf
                    @php
                        $isWishlisted = \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->exists();
                    @endphp
                    <button type="submit" class="btn btn-white shadow-lg rounded-circle p-3 {{ $isWishlisted ? 'text-danger' : 'text-muted' }}" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="{{ $isWishlisted ? 'fas' : 'far' }} fa-heart fs-4"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card-body p-4 p-md-5 h-100 d-flex flex-column">
                <div class="mb-auto">
                    <div class="badge bg-primary bg-opacity-10 text-primary rounded-pill mb-3 px-3 py-2 fw-bold text-uppercase" style="letter-spacing: 0.1em;">{{ $product->category->name }}</div>
                    <h1 class="fw-bold text-dark mb-3 display-6">{{ $product->name }}</h1>
                    <h2 class="text-primary fw-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
                    
                    <div class="p-4 bg-light rounded-4 mb-4 border-0">
                        <h6 class="fw-bold text-dark mb-2 text-uppercase small" style="letter-spacing: 0.1em;">Deskripsi Produk</h6>
                        <p class="text-secondary mb-0" style="line-height: 1.8;">{{ $product->description ?: 'Produk UMKM berkualitas tinggi yang dikurasi khusus untuk Anda. Nikmati kemudahan bertransaksi di IndustriSync.' }}</p>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-6 col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 text-success p-3 rounded-4 me-3">
                                    <i class="fas fa-check-double"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">Status Stok</div>
                                    <div class="fw-bold {{ $product->stock <= 10 ? 'text-danger' : 'text-success' }}">{{ $product->stock > 0 ? 'Tersedia' : 'Habis' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 me-3">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">Jumlah Stok</div>
                                    <div class="fw-bold">{{ $product->stock }} Unit</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-3">
                    <form action="{{ route('user.cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary-user w-100 py-3 rounded-pill fw-bold shadow-lg" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-basket me-2"></i> {{ $product->stock <= 0 ? 'Maaf, Stok Habis' : 'Tambahkan ke Keranjang' }}
                        </button>
                    </form>
                    <div class="text-center">
                        <span class="small text-muted"><i class="fas fa-info-circle me-1"></i> Gratis ongkir khusus member tingkat Silver</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 text-center" style="border-radius: 24px;">
            <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-circle d-inline-flex mb-3 mx-auto">
                <i class="fas fa-shield-alt fs-4"></i>
            </div>
            <h6 class="fw-bold">Garansi Kualitas</h6>
            <p class="small text-muted mb-0">Setiap produk UMKM telah melalui verifikasi standar kualitas IndustriSync.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 text-center" style="border-radius: 24px;">
            <div class="bg-info bg-opacity-10 text-info p-3 rounded-circle d-inline-flex mb-3 mx-auto">
                <i class="fas fa-truck fs-4"></i>
            </div>
            <h6 class="fw-bold">Pengiriman Cepat</h6>
            <p class="small text-muted mb-0">Kerjasama dengan kurir terpercaya untuk memastikan pesanan sampai tepat waktu.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 text-center" style="border-radius: 24px;">
            <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle d-inline-flex mb-3 mx-auto">
                <i class="fas fa-hand-holding-heart fs-4"></i>
            </div>
            <h6 class="fw-bold">Dukung UMKM</h6>
            <p class="small text-muted mb-0">Setiap pembelian Anda berkontribusi langsung pada pertumbuhan ekonomi lokal.</p>
        </div>
    </div>
</div>

<style>
    .btn-white {
        background: white;
        border: none;
    }
</style>
@endsection
