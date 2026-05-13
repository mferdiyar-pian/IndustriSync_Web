<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IndustriSync') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #eff6ff;
            --dark: #1e293b;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            padding: 20px;
        }

        /* Background Glow Decorations */
        .bg-glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .glow-1 {
            position: absolute;
            top: -10%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .glow-2 {
            position: absolute;
            bottom: -10%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(96, 165, 250, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 480px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            z-index: 1;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .auth-logo {
            font-size: 2rem;
            color: var(--primary);
            font-weight: 800;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            padding: 14px;
            font-weight: 700;
            border-radius: 16px;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 15px 20px -3px rgba(37, 99, 235, 0.3);
        }

        .form-control {
            padding: 12px 20px;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            background-color: #f1f5f9;
            font-weight: 500;
            transition: 0.3s;
        }

        .form-control:focus {
            background-color: white;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            border-color: var(--primary);
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        .lang-switcher {
            position: absolute;
            top: 30px;
            right: 30px;
            display: flex;
            gap: 10px;
        }

        .lang-btn {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.3s;
        }

        .lang-btn:hover {
            background: #f8fafc;
            color: var(--primary);
        }
        
        .lang-btn.active {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }
    </style>
</head>
<body>
    <div class="bg-glow">
        <div class="glow-1"></div>
        <div class="glow-2"></div>
    </div>

    <div class="lang-switcher">
        <form action="{{ route('settings.locale') }}" method="POST">
            @csrf
            <input type="hidden" name="locale" value="id">
            <button type="submit" class="lang-btn {{ app()->getLocale() == 'id' ? 'active' : '' }}">
                <img src="https://flagcdn.com/w20/id.png" width="16"> ID
            </button>
        </form>
        <form action="{{ route('settings.locale') }}" method="POST">
            @csrf
            <input type="hidden" name="locale" value="en">
            <button type="submit" class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                <img src="https://flagcdn.com/w20/us.png" width="16"> EN
            </button>
        </form>
    </div>

    <div class="auth-card">
        <div class="auth-header">
            <a href="/" class="auth-logo">
                <i class="fas fa-rocket"></i> IndustriSync
            </a>
            <p class="text-secondary fw-medium">{{ __('Modern Industrial Management Platform') }}</p>
        </div>
        
        {{ $slot }}
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
