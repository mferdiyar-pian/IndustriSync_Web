<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IndustriSync') }} - Management</title>

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
            --sidebar-width: 280px;
            --glass: rgba(255, 255, 255, 0.9);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-body);
            color: #1e293b;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        #main-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            z-index: 1001;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-brand {
            padding: 30px 25px;
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .sidebar-brand i {
            background: linear-gradient(135deg, #2563eb, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-right: 12px;
        }

        .menu-label {
            padding: 0 25px 10px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .sidebar-nav {
            padding: 0 15px;
        }

        .nav-link-main {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            margin-bottom: 5px;
            border-radius: 12px;
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-link-main:hover {
            background-color: var(--primary-light);
            color: var(--primary);
        }

        .nav-link-main.active {
            background-color: var(--primary);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .nav-link-main i {
            width: 24px;
            margin-right: 12px;
            font-size: 1.2rem;
        }

        /* Content Area */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s;
        }

        .main-navbar {
            height: 80px;
            background: var(--glass);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        /* Cards and Elements */
        .card {
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.05);
        }

        .stat-card-icon {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s;
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
            #main-sidebar { left: -var(--sidebar-width); }
            #main-sidebar.show { left: 0; }
            #main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div id="page-loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>

    <!-- Sidebar -->
    <nav id="main-sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-layer-group"></i>
            <span>IndustriSync</span>
        </div>

        <div class="menu-label">Analytics</div>
        <div class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-link-main {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i> {{ __('Dashboard') }}
            </a>
            <a href="{{ route('reports.index') }}" class="nav-link-main {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <i class="fas fa-file-invoice-dollar"></i> {{ __('Reports') }}
            </a>
        </div>

        <div class="menu-label mt-4">Inventory</div>
        <div class="sidebar-nav">
            <a href="{{ route('products.index') }}" class="nav-link-main {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="fas fa-box-open"></i> {{ __('Products') }}
            </a>
            <a href="{{ route('categories.index') }}" class="nav-link-main {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i> {{ __('Categories') }}
            </a>
        </div>

        <div class="menu-label mt-4">Sales</div>
        <div class="sidebar-nav">
            <a href="{{ route('transactions.index') }}" class="nav-link-main {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i> {{ __('Transactions') }}
            </a>
        </div>

        <div class="menu-label mt-4">Integrasi</div>
        <div class="sidebar-nav">
            <a href="{{ route('integrations.index') }}" class="nav-link-main {{ request()->routeIs('integrations.*') ? 'active' : '' }}">
                <i class="fas fa-plug"></i> {{ __('Marketplace') }}
            </a>
        </div>

        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner'))
        <div class="menu-label mt-4">System</div>
        <div class="sidebar-nav">
            @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('users.index') }}" class="nav-link-main {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="fas fa-users-cog"></i> {{ __('Users') }}
            </a>
            @endif
            <a href="{{ route('settings.index') }}" class="nav-link-main {{ request()->routeIs('settings.index') ? 'active' : '' }}">
                <i class="fas fa-cog"></i> {{ __('Settings') }}
            </a>
        </div>
        @endif

        <div class="menu-label mt-4">User View</div>
        <div class="sidebar-nav">
            <a href="{{ route('user.dashboard') }}" class="nav-link-main">
                <i class="fas fa-external-link-alt text-warning"></i> {{ __('Switch to Client') }}
            </a>
        </div>

        <div class="sidebar-nav mt-auto mb-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link-main border-0 bg-transparent w-100 text-start text-danger">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main id="main-content">
        <header class="main-navbar">
            <button class="btn d-lg-none" id="sidebar-toggle">
                <i class="fas fa-bars"></i>
            </button>

            <div class="fw-bold d-none d-lg-block">
                {{ strtoupper(auth()->user()->role->name ?? 'Admin') }} PANEL
            </div>

            <div class="d-flex align-items-center">
                <a href="{{ route('user.dashboard') }}" class="btn btn-light btn-sm rounded-pill me-3 px-3 fw-bold text-primary border">
                    <i class="fas fa-shopping-bag me-1"></i> {{ __('Switch to Client') }}
                </a>
                
                <div class="dropdown">
                    <div class="d-flex align-items-center pointer" data-bs-toggle="dropdown" style="cursor: pointer;">
                        <div class="me-3 text-end d-none d-sm-block">
                            <div class="fw-bold small">{{ auth()->user()->name }}</div>
                            <div class="text-muted small" style="font-size: 0.7rem text-uppercase">{{ auth()->user()->email }}</div>
                        </div>
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=2563eb&color=fff" 
                             class="rounded-circle shadow-sm" width="45" height="45">
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3" style="border-radius: 15px; min-width: 200px;">
                        <li><a class="dropdown-item py-2 px-3" href="{{ route('profile.edit') }}"><i class="far fa-user me-2"></i> {{ __('Profile') }}</a></li>
                        <li><a class="dropdown-item py-2 px-3" href="{{ route('settings.index') }}"><i class="fas fa-cog me-2"></i> {{ __('Settings') }}</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 px-3 text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="p-4 p-md-5">
            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        timer: 3000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        borderRadius: '15px'
                    });
                </script>
            @endif

            @yield('content')
        </div>
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

        document.getElementById('sidebar-toggle')?.addEventListener('click', () => {
            document.getElementById('main-sidebar').classList.toggle('show');
        });
    </script>
    @stack('scripts')
</body>
</html>
