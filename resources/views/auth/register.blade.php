<x-guest-layout>
    <div class="mb-4 text-center">
        <h4 class="fw-bold text-dark">{{ __('Create Account') }} ✨</h4>
        <p class="small text-muted">{{ __('Join IndustriSync and start managing your industry with precision.') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">{{ __('Full Name') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 rounded-start-4" style="border-radius: 14px 0 0 14px;"><i class="fas fa-user text-muted"></i></span>
                <input type="text" name="name" class="form-control border-start-0 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="John Doe" required autofocus style="border-radius: 0 14px 14px 0;">
            </div>
            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Email Address') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 rounded-start-4" style="border-radius: 14px 0 0 14px;"><i class="fas fa-envelope text-muted"></i></span>
                <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="name@example.com" required style="border-radius: 0 14px 14px 0;">
            </div>
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Password') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 rounded-start-4" style="border-radius: 14px 0 0 14px;"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="password" class="form-control border-start-0 @error('password') is-invalid @enderror" placeholder="••••••••" required autocomplete="new-password" style="border-radius: 0 14px 14px 0;">
            </div>
            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">{{ __('Confirm Password') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 rounded-start-4" style="border-radius: 14px 0 0 14px;"><i class="fas fa-shield-check text-muted"></i></span>
                <input type="password" name="password_confirmation" class="form-control border-start-0" placeholder="••••••••" required autocomplete="new-password" style="border-radius: 0 14px 14px 0;">
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-4 py-3">
            {{ __('Get Started Now') }} <i class="fas fa-rocket ms-2 opacity-50"></i>
        </button>

        <div class="text-center">
            <span class="small text-muted">{{ __('Already have an account?') }}</span> 
            <a href="{{ route('login') }}" class="small text-decoration-none fw-bold text-primary">{{ __('Login here') }}</a>
        </div>
    </form>
</x-guest-layout>
