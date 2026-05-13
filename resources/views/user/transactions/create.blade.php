@extends('user.layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <h3 class="fw-bold mb-1">Penyelesaian Pesanan</h3>
        <p class="text-muted">Konfirmasi detail pesanan dan alamat pengiriman Anda.</p>
    </div>
</div>

<form action="{{ route('user.transactions.store') }}" method="POST">
    @csrf
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 24px;">
                <h5 class="fw-bold mb-4"><i class="fas fa-shopping-basket me-2 text-primary"></i> Rincian Produk</h5>
                <div class="table-responsive">
                    <table class="table align-middle border-0">
                        <thead class="text-muted small uppercase">
                            <tr class="border-bottom">
                                <th class="py-3">Produk</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $cart = session('cart', []); $total = 0; @endphp
                            @forelse($cart as $id => $item)
                                @php $total += $item['price'] * $item['quantity']; @endphp
                                <tr>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item['image'] ? asset('storage/'.$item['image']) : 'https://ui-avatars.com/api/?name='.urlencode($item['name']).'&background=random' }}" 
                                                 class="rounded-3 me-3" width="50" height="50" style="object-fit: cover;">
                                            <div>
                                                <div class="fw-bold text-dark">{{ $item['name'] }}</div>
                                                <input type="hidden" name="products[{{ $id }}][id]" value="{{ $id }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <div class="fw-bold">{{ $item['quantity'] }}</div>
                                        <input type="hidden" name="products[{{ $id }}][quantity]" value="{{ $item['quantity'] }}">
                                    </td>
                                    <td class="text-end fw-bold text-dark">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">Keranjang kosong.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4" style="border-radius: 24px;">
                <h5 class="fw-bold mb-4"><i class="fas fa-truck me-2 text-primary"></i> Informasi Pengiriman</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Nama Penerima</label>
                        <input type="text" class="form-control rounded-pill border-light bg-light" value="{{ auth()->user()->name }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Nomor Telepon</label>
                        <input type="text" class="form-control rounded-pill border-light bg-light" placeholder="Contoh: 08123456789">
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-bold">Alamat Lengkap</label>
                        <textarea class="form-control rounded-4 border-light bg-light" rows="3" placeholder="Masukkan alamat pengiriman lengkap Anda..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 sticky-top" style="border-radius: 24px; top: 100px;">
                <h5 class="fw-bold mb-4">Ringkasan Tagihan</h5>
                <div class="d-flex justify-content-between mb-3 text-muted">
                    <span>Total Belanja</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3 text-muted">
                    <span>Biaya Layanan</span>
                    <span class="text-success fw-bold">Gratis</span>
                </div>
                <div class="d-flex justify-content-between mb-3 text-muted">
                    <span>Pajak (0%)</span>
                    <span>Rp 0</span>
                </div>
                <hr class="opacity-10">
                <div class="d-flex justify-content-between mb-4">
                    <span class="h5 fw-bold text-dark">Total Akhir</span>
                    <span class="h5 fw-bold text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                
                <div class="p-3 bg-light rounded-4 mb-4 border-0 small">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        <span class="fw-bold">Metode Pembayaran</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bg-white p-2 rounded-3 me-2 border">
                            <i class="fas fa-wallet text-warning"></i>
                        </div>
                        <span class="text-muted">Pembayaran di Kasir / Transfer</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary-user w-100 py-3 rounded-pill fw-bold shadow-lg" {{ empty($cart) ? 'disabled' : '' }}>
                    Bayar & Buat Pesanan <i class="fas fa-check-circle ms-2"></i>
                </button>
                <a href="{{ route('user.cart.index') }}" class="btn btn-light w-100 py-2 mt-3 rounded-pill text-muted small fw-bold border-0">
                    Kembali ke Keranjang
                </a>
            </div>
        </div>
    </div>
</form>
@endsection
