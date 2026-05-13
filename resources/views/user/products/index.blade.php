@extends('user.layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <h3 class="fw-bold mb-1">Marketplace UMKM</h3>
        <p class="text-muted">Temukan berbagai produk unggulan dari pelaku usaha mikro di IndustriSync.</p>
    </div>
</div>

<div class="card border-0 shadow-sm p-4 mb-5" style="border-radius: 24px;">
    <form action="{{ route('user.products.index') }}" method="GET" class="row g-3">
        <div class="col-md-6">
            <div class="search-bar w-100">
                <i class="fas fa-search"></i>
                <input type="text" name="search" placeholder="Cari produk impian Anda..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-4">
            <select name="category" class="form-select border-0 bg-light rounded-pill px-4 h-100 py-2">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary-user w-100 rounded-pill h-100 py-2 shadow-sm">
                Cari Produk
            </button>
        </div>
    </form>
</div>

<div class="row g-4">
    @forelse($products as $product)
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 product-card overflow-hidden" style="border-radius: 24px;">
                <div class="position-relative">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://ui-avatars.com/api/?name='.urlencode($product->name).'&background=random' }}" 
                         class="card-img-top" style="height: 220px; object-fit: cover;">
                    
                    <form action="{{ route('user.wishlist.toggle', $product->id) }}" method="POST" class="position-absolute top-0 end-0 p-3">
                        @csrf
                        @php
                            $isWishlisted = \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->exists();
                        @endphp
                        <button type="submit" class="btn btn-white shadow-sm rounded-circle p-2 {{ $isWishlisted ? 'text-danger' : 'text-muted' }}" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                            <i class="{{ $isWishlisted ? 'fas' : 'far' }} fa-heart"></i>
                        </button>
                    </form>
                </div>
                <div class="card-body p-4">
                    <div class="badge bg-primary bg-opacity-10 text-primary rounded-pill mb-2 px-3 py-1 small fw-bold text-uppercase">{{ $product->category->name }}</div>
                    <h6 class="fw-bold text-dark mb-1">{{ $product->name }}</h6>
                    <div class="text-primary fw-bold mb-4 fs-5">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    
                    <div class="d-grid gap-2">
                        <form action="{{ route('user.cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary-user w-100 rounded-pill fw-bold" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-shopping-basket me-2"></i> {{ $product->stock <= 0 ? 'Habis' : 'Tambah' }}
                            </button>
                        </form>
                        <a href="{{ route('user.products.show', $product->id) }}" class="btn btn-light w-100 rounded-pill text-muted small fw-600 border-0">Detail Produk</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <div class="mb-4 text-light">
                <i class="fas fa-box-open fa-5x"></i>
            </div>
            <h5 class="fw-bold">Produk Tidak Ditemukan</h5>
            <p class="text-muted">Coba gunakan kata kunci pencarian yang lain.</p>
            <a href="{{ route('user.products.index') }}" class="btn btn-light rounded-pill px-4">Reset Pencarian</a>
        </div>
    @endforelse
</div>

<div class="mt-5 d-flex justify-content-center">
    {{ $products->links() }}
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
    .fw-600 { font-weight: 600; }
    
    /* Pagination Styling */
    .pagination {
        gap: 8px;
    }
    .page-link {
        border-radius: 12px !important;
        border: none;
        color: #64748b;
        padding: 10px 18px;
        font-weight: 600;
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .page-item.active .page-link {
        background: var(--primary);
        color: white;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }
</style>
@endsection
