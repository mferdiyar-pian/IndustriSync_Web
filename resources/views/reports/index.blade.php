@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">Laporan Bisnis</h4>
            <p class="text-muted">Analisis performa usaha Anda secara real-time.</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <form action="{{ route('reports.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Dari Tanggal</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Sampai Tanggal</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="btn-group">
                        <a href="{{ route('reports.export', ['type' => 'sales', 'start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-outline-danger">
                            <i class="fas fa-file-pdf me-1"></i> Export Penjualan
                        </a>
                        <a href="{{ route('reports.export', ['type' => 'stock']) }}" class="btn btn-outline-info">
                            <i class="fas fa-file-pdf me-1"></i> Export Stok
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 text-center">
                <div class="text-muted mb-1 small uppercase">Total Pendapatan Bersih</div>
                <h3 class="fw-bold text-primary">Rp {{ number_format($totalSales, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 text-center">
                <div class="text-muted mb-1 small uppercase">Total Keuntungan (Estimasi)</div>
                <h3 class="fw-bold text-success">Rp {{ number_format($totalProfit, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <!-- Tabs for different reports -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 pt-3">
            <ul class="nav nav-pills card-header-pills" id="reportTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active px-4 py-2 me-2 small fw-bold" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" type="button">Detail Penjualan</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link px-4 py-2 small fw-bold" id="stock-tab" data-bs-toggle="tab" data-bs-target="#stock" type="button">Status Stok</button>
                </li>
            </ul>
        </div>
        <div class="card-body p-0">
            <div class="tab-content" id="reportTabsContent">
                <!-- Sales Tab -->
                <div class="tab-pane fade show active" id="sales" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Invoice</th>
                                    <th>Kasir</th>
                                    <th>Total Item</th>
                                    <th class="text-end">Total Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $tx)
                                    <tr>
                                        <td>{{ $tx->created_at->format('d/m/Y') }}</td>
                                        <td class="fw-bold text-primary">{{ $tx->invoice_number }}</td>
                                        <td>{{ $tx->user->name }}</td>
                                        <td>{{ $tx->details->sum('quantity') }}</td>
                                        <td class="text-end fw-bold">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">Tidak ada data transaksi di periode ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Stock Tab -->
                <div class="tab-pane fade" id="stock" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga Satuan</th>
                                    <th class="text-center">Stok Saat Ini</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stockReport as $product)
                                    <tr>
                                        <td class="fw-bold">{{ $product->name }}</td>
                                        <td><span class="badge bg-light text-dark px-3 rounded-pill">{{ $product->category->name }}</span></td>
                                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td class="text-center fw-bold">{{ $product->stock }}</td>
                                        <td>
                                            @if($product->stock <= 10)
                                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">Menipis</span>
                                            @else
                                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Tersedia</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
