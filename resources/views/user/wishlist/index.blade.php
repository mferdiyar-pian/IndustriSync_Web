@extends('user.layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h3 class="fw-bold">Wishlist Saya</h3>
        <p class="text-muted">Daftar produk impian yang Anda simpan untuk dibeli nanti.</p>
    </div>
</div>

<div class="row g-4">
    @forelse($wishlist as $item)
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 product-card overflow-hidden" style="border-radius: 24px;">
                <div class="position-relative">
                    <img src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://ui-avatars.com/api/?name='.urlencode($item->product->name).'&background=random' }}" 
                         class="card-img-top" style="height: 220px; object-fit: cover;">
                    <form action="{{ route('user.wishlist.toggle', $item->product->id) }}" method="POST" class="position-absolute top-0 end-0 p-3">
                        @csrf
                        <button type="submit" class="btn btn-white shadow-sm rounded-circle text-danger p-2" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-heart"></i>
                        </button>
                    </form>
                </div>
                <div class="card-body p-4">
                    <div class="badge bg-primary bg-opacity-10 text-primary rounded-pill mb-2 px-3 py-1 small fw-bold text-uppercase">{{ $item->product->category->name }}</div>
                    <h6 class="fw-bold text-dark mb-1">{{ $item->product->name }}</h6>
                    <div class="text-primary fw-bold mb-4 fs-5">Rp {{ number_format($item->product->price, 0, ',', '.') }}</div>
                    
                    <div class="d-grid gap-2">
                        <form action="{{ route('user.cart.add', $item->product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary-user w-100 rounded-pill fw-bold">
                                <i class="fas fa-shopping-basket me-2"></i> Tambahkan
                            </button>
                        </form>
                        <a href="{{ route('user.products.show', $item->product->id) }}" class="btn btn-light w-100 rounded-pill text-muted small fw-600 border-0">Detail Produk</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <div class="mb-4">
                <i class="far fa-heart fa-5x text-light opacity-50"></i>
            </div>
            <h5 class="fw-bold text-dark">Wishlist Kosong</h5>
            <p class="text-muted">Simpan produk favorit Anda untuk memudahkan pencarian di kemudian hari.</p>
            <a href="{{ route('user.products.index') }}" class="btn btn-primary-user mt-3 rounded-pill px-5 shadow">Cari Produk Sekarang</a>
        </div>
    @endforelse
</div>

<style>
    .product-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important;
    }
    .btn-white {
        background: white;
        border: none;
    }
</style>
@endsection
