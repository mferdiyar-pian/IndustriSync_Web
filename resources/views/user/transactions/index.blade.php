@extends('user.layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <h3 class="fw-bold mb-1">Riwayat Transaksi Saya</h3>
        <p class="text-muted">Pantau status pengiriman dan detail pesanan Anda secara real-time.</p>
    </div>
</div>

<div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 24px;">
    <div class="card-header bg-white p-4 border-0 d-flex align-items-center justify-content-between">
        <h5 class="fw-bold mb-0">Daftar Transaksi</h5>
        <div class="d-flex gap-2">
            <button class="btn btn-light rounded-pill px-3 small fw-bold">Filter</button>
            <button class="btn btn-light rounded-pill px-3 small fw-bold">Export PDF</button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle border-0 mb-0">
                <thead class="bg-light text-muted small uppercase">
                    <tr>
                        <th class="ps-4 py-3">Nomor Invoice</th>
                        <th>Tanggal Pesanan</th>
                        <th>Total Pembelian</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th class="pe-4 text-end">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $tx)
                        <tr>
                            <td class="ps-4 py-4">
                                <span class="fw-bold text-primary">{{ $tx->invoice_number }}</span>
                            </td>
                            <td>{{ $tx->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <span class="fw-bold text-dark">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</span>
                                <div class="text-muted small">{{ $tx->details->sum('quantity') }} Item Produk</div>
                            </td>
                            <td><span class="small text-muted">Integrasi Sistem</span></td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i> Success
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('user.transactions.show', $tx->id) }}" class="btn btn-sm btn-primary-user rounded-pill px-4 py-2 shadow-sm">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted opacity-25 mb-3">
                                    <i class="fas fa-receipt fa-5x"></i>
                                </div>
                                <h5 class="fw-bold text-dark">Belum Ada Transaksi</h5>
                                <p class="text-muted">Sepertinya Anda belum melakukan pembelian produk UMKM.</p>
                                <a href="{{ route('user.products.index') }}" class="btn btn-primary-user mt-3 rounded-pill px-4">Eksplor Sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $transactions->links() }}
</div>
@endsection
