@extends('layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-md-6">
        <h3 class="fw-bold mb-1">Manajemen Produk</h3>
        <p class="text-muted">Kelola inventori, stok, dan harga produk UMKM Anda.</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('products.create') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm fw-bold">
            <i class="fas fa-plus me-2"></i> Tambah Produk Baru
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 24px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle border-0 mb-0">
                <thead class="bg-light text-muted small uppercase">
                    <tr>
                        <th class="ps-4 py-3 border-0">Gambar</th>
                        <th class="border-0">Nama Produk</th>
                        <th class="border-0">Kategori</th>
                        <th class="border-0">Harga</th>
                        <th class="border-0 text-center">Stok</th>
                        <th class="pe-4 text-end border-0">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="ps-4 py-3 border-0">
                                <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://ui-avatars.com/api/?name='.urlencode($product->name).'&background=2563eb&color=fff' }}" 
                                     class="rounded-3 shadow-sm" width="50" height="50" style="object-fit: cover;">
                            </td>
                            <td class="border-0 fw-bold text-dark">{{ $product->name }}</td>
                            <td class="border-0">
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">{{ $product->category->name }}</span>
                            </td>
                            <td class="border-0 fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="border-0 text-center">
                                <span class="fw-bold {{ $product->stock <= 10 ? 'text-danger' : 'text-dark' }}">{{ $product->stock }}</span>
                            </td>
                            <td class="pe-4 text-end border-0">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-light rounded-circle p-2">
                                        <i class="fas fa-edit text-primary"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light rounded-circle p-2" onclick="return confirm('Hapus produk ini?')">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $products->links() }}
</div>
@endsection
