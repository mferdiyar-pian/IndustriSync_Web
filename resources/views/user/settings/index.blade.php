@extends($layout)

@section('content')
<div class="row mb-5">
    <div class="col-12 text-center text-md-start">
        <h2 class="fw-bold mb-1 text-gradient">{{ __('Account Settings') }} ⚙️</h2>
        <p class="text-secondary">{{ __('Manage your account preferences and application configuration.') }}</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <!-- Language & Localization -->
        <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 24px;">
            <div class="d-flex align-items-center mb-4">
                <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                    <i class="fas fa-language"></i>
                </div>
                <h5 class="fw-bold mb-0">{{ __('Language & Localization') }}</h5>
            </div>

            <form action="{{ route('settings.locale') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold uppercase">{{ __('Select Primary Language') }}</label>
                    <div class="row g-3">
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="locale" id="lang_id" value="id" {{ app()->getLocale() == 'id' ? 'checked' : '' }} onchange="this.form.submit()">
                            <label class="btn btn-outline-primary w-100 py-3 rounded-4 fw-bold shadow-sm d-flex flex-column align-items-center" for="lang_id">
                                <img src="https://flagcdn.com/w40/id.png" class="mb-2 rounded-1" width="30"> 
                                <span>Bahasa Indonesia</span>
                            </label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="locale" id="lang_en" value="en" {{ app()->getLocale() == 'en' ? 'checked' : '' }} onchange="this.form.submit()">
                            <label class="btn btn-outline-primary w-100 py-3 rounded-4 fw-bold shadow-sm d-flex flex-column align-items-center" for="lang_en">
                                <img src="https://flagcdn.com/w40/us.png" class="mb-2 rounded-1" width="30"> 
                                <span>English (US)</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="p-3 bg-light rounded-4 border-0 small text-secondary mb-0">
                    <i class="fas fa-info-circle me-1"></i> {{ __('Language changes will be applied instantly across the entire interface.') }}
                </div>
            </form>
        </div>

        <!-- Notifications -->
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 24px;">
            <div class="d-flex align-items-center mb-4">
                <div class="icon-box bg-warning bg-opacity-10 text-warning me-3">
                    <i class="fas fa-bell"></i>
                </div>
                <h5 class="fw-bold mb-0">{{ __('Notifications') }}</h5>
            </div>
            
            <div class="list-group list-group-flush">
                <div class="list-group-item border-0 px-0 py-3">
                    <div class="form-check form-switch d-flex justify-content-between align-items-center ps-0">
                        <label class="form-check-label fw-bold text-dark" for="emailNotif">{{ __('Transaction Email Notifications') }}</label>
                        <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                    </div>
                    <p class="small text-muted mb-0 mt-1">{{ __('Receive emails for every transaction and activity.') }}</p>
                </div>
                <div class="list-group-item border-0 px-0 py-3">
                    <div class="form-check form-switch d-flex justify-content-between align-items-center ps-0">
                        <label class="form-check-label fw-bold text-dark" for="promoNotif">{{ __('Marketing & Updates') }}</label>
                        <input class="form-check-input" type="checkbox" id="promoNotif">
                    </div>
                    <p class="small text-muted mb-0 mt-1">{{ __('Get notified about new features and special offers.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <!-- Privacy & Security -->
        <div class="card border-0 shadow-sm p-4 text-white mb-4" style="border-radius: 24px; background: linear-gradient(135deg, #1e293b, #334155);">
            <div class="d-flex align-items-center mb-4">
                <div class="icon-box bg-white bg-opacity-10 text-white me-3">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h5 class="fw-bold mb-0 text-white">{{ __('Privacy & Security') }}</h5>
            </div>
            <p class="opacity-75 mb-4">{{ __('Keep your account secure by updating your password regularly and enabling two-factor authentication.') }}</p>
            <a href="{{ route('profile.edit') }}" class="btn btn-light w-100 rounded-pill fw-bold py-3 shadow-sm">
                <i class="fas fa-key me-2"></i> {{ __('Update Profile & Security') }}
            </a>
        </div>

        <!-- Help & Support -->
        <div class="card border-0 shadow-sm p-4" style="border-radius: 24px;">
            <div class="d-flex align-items-center mb-4">
                <div class="icon-box bg-info bg-opacity-10 text-info me-3">
                    <i class="fas fa-question-circle"></i>
                </div>
                <h5 class="fw-bold mb-0">{{ __('Help & Support') }}</h5>
            </div>
            <p class="small text-secondary mb-4">{{ __('Need help or have questions about IndustriSync? Our support team is ready to assist you.') }}</p>
            <div class="d-grid gap-2">
                <a href="#" class="btn btn-outline-dark rounded-pill py-2 fw-bold small">
                    <i class="fas fa-book me-2"></i> {{ __('Documentation') }}
                </a>
                <a href="#" class="btn btn-outline-dark rounded-pill py-2 fw-bold small">
                    <i class="fas fa-headset me-2"></i> {{ __('Contact Support') }}
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-check:checked + .btn-outline-primary {
        background-color: rgba(37, 99, 235, 0.05);
        border-color: var(--primary);
        color: var(--primary);
    }
    .text-gradient {
        background: linear-gradient(135deg, #1e293b, #2563eb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .icon-box {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 1.25rem;
    }
</style>
@endsection
