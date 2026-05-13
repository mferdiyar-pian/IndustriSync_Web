@extends($layout)

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <h2 class="fw-bold mb-1 text-gradient">{{ __('Account Profile') }} 👤</h2>
        <p class="text-secondary">{{ __('Manage your personal information and account security.') }}</p>
    </div>
</div>

<div class="row g-4">
    <!-- Account Information -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 24px;">
            <div class="d-flex align-items-center mb-4">
                <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h5 class="fw-bold mb-0">{{ __('Profile Information') }}</h5>
            </div>

            <form method="post" action="{{ route('profile.update') }}" class="mt-2">
                @csrf
                @method('patch')

                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted uppercase">{{ __('Full Name') }}</label>
                    <input type="text" name="name" class="form-control rounded-4 border-light bg-light py-2 px-3 @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted uppercase">{{ __('Email Address') }}</label>
                    <input type="email" name="email" class="form-control rounded-4 border-light bg-light py-2 px-3 @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-primary-user rounded-pill px-5 fw-bold shadow">
                        {{ __('Save Changes') }}
                    </button>

                    @if (session('status') === 'profile-updated')
                        <p class="text-success small mb-0 fw-medium">
                            <i class="fas fa-check-circle me-1"></i> {{ __('Saved.') }}
                        </p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Change Password -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 24px;">
            <div class="d-flex align-items-center mb-4">
                <div class="icon-box bg-warning bg-opacity-10 text-warning me-3">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h5 class="fw-bold mb-0">{{ __('Update Password') }}</h5>
            </div>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted uppercase">{{ __('Current Password') }}</label>
                    <input type="password" name="current_password" class="form-control rounded-4 border-light bg-light py-2 px-3 @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
                    @error('current_password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted uppercase">{{ __('New Password') }}</label>
                    <input type="password" name="password" class="form-control rounded-4 border-light bg-light py-2 px-3 @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                    @error('password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted uppercase">{{ __('Confirm Password') }}</label>
                    <input type="password" name="password_confirmation" class="form-control rounded-4 border-light bg-light py-2 px-3" autocomplete="new-password">
                </div>

                <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-bold shadow-sm">
                        {{ __('Update Password') }}
                    </button>

                    @if (session('status') === 'password-updated')
                        <p class="text-success small mb-0 fw-medium">
                            {{ __('Saved.') }}
                        </p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Danger Zone -->
    <div class="col-12 mt-2">
        <div class="card border-0 shadow-sm p-4 bg-danger bg-opacity-10" style="border-radius: 24px; border: 1px dashed #f87171 !important;">
            <div class="d-md-flex align-items-center justify-content-between text-center text-md-start">
                <div>
                    <h6 class="fw-bold text-danger mb-1">{{ __('Delete Account') }}</h6>
                    <p class="small text-muted mb-0">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}</p>
                </div>
                <button class="btn btn-outline-danger rounded-pill px-4 fw-bold mt-3 mt-md-0" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">
                    {{ __('Delete Permanently') }}
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmUserDeletion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 24px;">
            <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
                @csrf
                @method('delete')

                <h5 class="fw-bold mb-3">{{ __('Are you sure you want to delete your account?') }}</h5>
                <p class="text-muted small mb-4">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted uppercase">{{ __('Password') }}</label>
                    <input type="password" name="password" class="form-control rounded-4 border-light bg-light py-2 px-3 @error('password', 'userDeletion') is-invalid @enderror" placeholder="{{ __('Password') }}">
                    @error('password', 'userDeletion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">{{ __('Delete Account') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .text-gradient {
        background: linear-gradient(135deg, #1e293b, #2563eb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection
