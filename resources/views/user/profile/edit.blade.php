@extends('user.layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <h3 class="fw-bold mb-1">Pengaturan Profil</h3>
        <p class="text-muted">Kelola informasi pribadi dan keamanan akun Anda di IndustriSync.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 24px;">
            <div class="d-flex align-items-center mb-4">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 me-3">
                    <i class="fas fa-user-circle fs-4"></i>
                </div>
                <h5 class="fw-bold mb-0">Informasi Akun</h5>
            </div>

            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control rounded-pill border-light bg-light py-2 px-4 @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label small fw-bold text-muted">Alamat Email</label>
                        <input type="email" name="email" class="form-control rounded-pill border-light bg-light py-2 px-4 @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded-4 mb-4 small text-muted border-0">
                            <i class="fas fa-info-circle me-2"></i> Perubahan email akan memerlukan verifikasi ulang untuk keamanan akun Anda.
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary-user rounded-pill px-5 fw-bold shadow">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 24px;">
            <div class="d-flex align-items-center mb-4">
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-4 me-3">
                    <i class="fas fa-shield-alt fs-4"></i>
                </div>
                <h5 class="fw-bold mb-0">Keamanan Akun</h5>
            </div>

            <form action="{{ route('user.profile.password') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label small fw-bold text-muted">Password Sekarang</label>
                        <input type="password" name="current_password" class="form-control rounded-pill border-light bg-light py-2 px-4 @error('current_password') is-invalid @enderror" required>
                        @error('current_password') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold text-muted">Password Baru</label>
                        <input type="password" name="password" class="form-control rounded-pill border-light bg-light py-2 px-4 @error('password') is-invalid @enderror" required>
                        @error('password') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label small fw-bold text-muted">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control rounded-pill border-light bg-light py-2 px-4" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-dark w-100 rounded-pill py-3 fw-bold shadow-sm">
                            Ganti Password <i class="fas fa-key ms-2 opacity-50"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card border-0 shadow-sm p-4 bg-danger bg-opacity-10" style="border-radius: 24px; border: 1px dashed #f87171 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold text-danger mb-1">Hapus Akun</h6>
                    <p class="small text-muted mb-0">Tindakan ini permanen. Semua data transaksi dan wishlist akan dihapus.</p>
                </div>
                <button class="btn btn-outline-danger rounded-pill px-4 fw-bold">Hapus Selamanya</button>
            </div>
        </div>
    </div>
</div>
@endsection
