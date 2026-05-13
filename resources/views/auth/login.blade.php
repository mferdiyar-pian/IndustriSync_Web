<x-guest-layout>
    <div class="mb-4 text-center">
        <h4 class="fw-bold text-dark">{{ __('Welcome Back!') }} 👋</h4>
        <p class="small text-muted">{{ __('Please enter your credentials to access your dashboard.') }}</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label class="form-label">{{ __('Email Address') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 rounded-start-4" style="border-radius: 14px 0 0 14px;"><i class="fas fa-envelope text-muted"></i></span>
                <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="name@example.com" required autofocus style="border-radius: 0 14px 14px 0;">
            </div>
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Password') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 rounded-start-4" style="border-radius: 14px 0 0 14px;"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="password" class="form-control border-start-0 @error('password') is-invalid @enderror" placeholder="••••••••" required autocomplete="current-password" style="border-radius: 0 14px 14px 0;">
            </div>
            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember_me">
                <label class="form-check-label small text-muted fw-medium" for="remember_me">{{ __('Remember me') }}</label>
            </div>
            @if (Route::has('password.request'))
                <a class="small text-decoration-none fw-bold text-primary" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-4 py-3">
            {{ __('Login to Dashboard') }} <i class="fas fa-sign-in-alt ms-2 opacity-50"></i>
        </button>

        <div class="text-center">
            <span class="small text-muted">{{ __("Don't have an account?") }}</span> 
            <a href="{{ route('register') }}" class="small text-decoration-none fw-bold text-primary">{{ __('Register Now') }}</a>
        </div>
    </form>
</x-guest-layout>
