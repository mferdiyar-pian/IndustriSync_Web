@extends('layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-md-6">
        <h3 class="fw-bold mb-1">Kategori Produk</h3>
        <p class="text-muted">Kelola pengelompokan produk untuk memudahkan pencarian pelanggan.</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('categories.create') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm fw-bold">
            <i class="fas fa-plus me-2"></i> Tambah Kategori
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm" style="border-radius: 24px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle border-0 mb-0">
                        <thead class="bg-light text-muted small uppercase">
                            <tr>
                                <th class="ps-4 py-3 border-0">Nama Kategori</th>
                                <th class="border-0">Jumlah Produk</th>
                                <th class="pe-4 text-end border-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td class="ps-4 py-4 border-0">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3 me-3">
                                                <i class="fas fa-folder-open"></i>
                                            </div>
                                            <span class="fw-bold text-dark fs-6">{{ $category->name }}</span>
                                        </div>
                                    </td>
                                    <td class="border-0">
                                        <span class="badge bg-light text-dark rounded-pill px-3 py-2 fw-bold border">{{ $category->products_count ?? 0 }} Produk</span>
                                    </td>
                                    <td class="pe-4 text-end border-0">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-light rounded-circle p-2">
                                                <i class="fas fa-edit text-primary"></i>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light rounded-circle p-2" onclick="return confirm('Hapus kategori ini?')">
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
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 bg-primary text-white text-center" style="border-radius: 24px;">
            <i class="fas fa-info-circle fa-3x mb-3 opacity-25"></i>
            <h5 class="fw-bold">Informasi Kategori</h5>
            <p class="small opacity-75 mb-0">Kategori membantu UMKM untuk mengelompokkan produk mereka sehingga pelanggan dapat menemukan barang dengan lebih cepat di marketplace.</p>
        </div>
    </div>
</div>
@endsection
