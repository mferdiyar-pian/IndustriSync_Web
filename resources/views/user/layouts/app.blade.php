<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IndustriSync') }} - Client Portal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #eff6ff;
            --bg-body: #f8fafc;
            --glass: rgba(255, 255, 255, 0.95);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-body);
            color: #1e293b;
            padding-top: 80px; /* Space for fixed top nav */
        }

        /* Top Navigation Styling */
        .top-navbar {
            height: 80px;
            background: var(--glass);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid #e2e8f0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 5%;
        }

        .navbar-brand-custom {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            margin-right: 40px;
        }

        .navbar-brand-custom i {
            background: linear-gradient(135deg, #2563eb, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-right: 10px;
        }

        .nav-menu {
            display: flex;
            gap: 10px;
            flex-grow: 1;
        }

        .nav-item-custom {
            padding: 8px 18px;
            border-radius: 12px;
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            display: flex;
            align-items: center;
        }

        .nav-item-custom i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        .nav-item-custom:hover {
            background-color: var(--primary-light);
            color: var(--primary);
        }

        .nav-item-custom.active {
            background-color: var(--primary);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        /* Cards and UI Elements */
        .card {
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            background: #ffffff;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        }

        .btn-primary-user {
            background-color: var(--primary);
            border: none;
            padding: 12px 24px;
            border-radius: 14px;
            font-weight: 600;
            color: white;
            transition: all 0.2s;
        }

        .btn-primary-user:hover {
            background-color: var(--primary-dark);
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        }

        .icon-box {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        /* Loader */
        #page-loader {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: white;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.5s;
        }

        @media (max-width: 992px) {
            .nav-menu { display: none; } /* Add mobile menu later if needed */
            .top-navbar { padding: 0 20px; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div id="page-loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>

    <!-- Top Navigation -->
    <header class="top-navbar">
        <a href="{{ route('user.dashboard') }}" class="navbar-brand-custom">
            <i class="fas fa-rocket"></i>
            <span>IndustriSync</span>
        </a>

        <nav class="nav-menu">
            <a href="{{ route('user.dashboard') }}" class="nav-item-custom {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> {{ __('Dashboard') }}
            </a>
            <a href="{{ route('user.products.index') }}" class="nav-item-custom {{ request()->routeIs('user.products.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-bag"></i> {{ __('Marketplace') }}
            </a>
            <a href="{{ route('user.transactions.index') }}" class="nav-item-custom {{ request()->routeIs('user.transactions.*') ? 'active' : '' }}">
                <i class="fas fa-receipt"></i> {{ __('Transactions') }}
            </a>
            <a href="{{ route('user.wishlist.index') }}" class="nav-item-custom {{ request()->routeIs('user.wishlist.*') ? 'active' : '' }}">
                <i class="fas fa-heart"></i> {{ __('Wishlist') }}
            </a>
        </nav>

        <div class="d-flex align-items-center">
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner') || auth()->user()->hasRole('staff'))
                <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm rounded-pill me-3 px-3 fw-bold text-primary">
                    <i class="fas fa-user-shield me-1"></i> Management
                </a>
            @endif

            <a href="{{ route('user.cart.index') }}" class="btn position-relative me-3 nav-item-custom px-2">
                <i class="fas fa-shopping-cart fs-5 text-secondary"></i>
                @php $cartCount = count(session('cart', [])); @endphp
                @if($cartCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem">{{ $cartCount }}</span>
                @endif
            </a>

            <div class="dropdown">
                <div class="d-flex align-items-center pointer" data-bs-toggle="dropdown" style="cursor: pointer;">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=2563eb&color=fff" 
                         class="rounded-circle shadow-sm" width="45" height="45">
                </div>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3" style="border-radius: 18px; min-width: 220px; overflow: hidden;">
                    <li class="px-3 py-3 bg-light">
                        <div class="fw-bold">{{ auth()->user()->name }}</div>
                        <div class="text-muted small">{{ auth()->user()->email }}</div>
                    </li>
                    <li><hr class="dropdown-divider m-0"></li>
                    <li><a class="dropdown-item py-2 px-3" href="{{ route('profile.edit') }}"><i class="far fa-user me-2"></i> {{ __('Profile') }}</a></li>
                    <li><a class="dropdown-item py-2 px-3" href="{{ route('settings.index') }}"><i class="fas fa-cog me-2"></i> {{ __('Settings') }}</a></li>
                    <li><a class="dropdown-item py-2 px-3" href="#"><i class="far fa-bell me-2"></i> {{ __('Notifications') }}</a></li>
                    <li><hr class="dropdown-divider m-0"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 px-3 text-danger fw-bold"><i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container-fluid py-5 px-lg-5">
        @if(session('success'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
                Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
            </script>
        @endif

        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('page-loader');
            loader.style.opacity = '0';
            setTimeout(() => loader.style.display = 'none', 500);
        });
    </script>
    @stack('scripts')
</body>
</html>
