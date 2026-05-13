<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IndustriSync - {{ __('Modern Industrial Management') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #eff6ff;
            --secondary: #64748b;
            --dark: #1e293b;
            --bg-body: #f8fafc;
            --glass: rgba(255, 255, 255, 0.95);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-body);
            color: var(--dark);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Background Decorations */
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
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.05) 0%, transparent 70%);
            border-radius: 50%;
        }

        .glow-2 {
            position: absolute;
            bottom: -10%;
            left: -10%;
            width: 40vw;
            height: 40vw;
            background: radial-gradient(circle, rgba(96, 165, 250, 0.05) 0%, transparent 70%);
            border-radius: 50%;
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 80px;
            padding: 0 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            backdrop-filter: blur(15px);
            background: var(--glass);
            border-bottom: 1px solid #e2e8f0;
        }

        .navbar-brand-custom {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            gap: 10px;
        }

        .navbar-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .navbar-links a {
            text-decoration: none;
            color: var(--secondary);
            font-weight: 500;
            transition: 0.3s;
        }

        .navbar-links a:hover {
            color: var(--primary);
        }

        .navbar-auth {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        /* Buttons */
        .btn-custom {
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
        }

        .btn-login {
            color: var(--dark);
            background: transparent;
        }

        .btn-login:hover {
            background: #f1f5f9;
        }

        .btn-register {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
        }

        .btn-register:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .lang-switcher {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 10px;
            gap: 4px;
        }

        .lang-btn {
            background: transparent;
            border: none;
            padding: 5px 10px;
            border-radius: 7px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            color: var(--secondary);
            transition: 0.2s;
        }

        .lang-btn.active {
            background: white;
            color: var(--primary);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        /* Hero Section */
        .hero {
            padding: 160px 5% 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            min-height: 90vh;
        }

        .badge-custom {
            display: inline-block;
            padding: 6px 16px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 100px;
            font-weight: 700;
            font-size: 0.85rem;
            margin-bottom: 24px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 24px;
            max-width: 900px;
            color: var(--dark);
        }

        .hero h1 span {
            color: var(--primary);
            position: relative;
        }

        .hero h1 span::after {
            content: '';
            position: absolute;
            bottom: 10px;
            left: 0;
            width: 100%;
            height: 15px;
            background: var(--primary);
            opacity: 0.1;
            z-index: -1;
        }

        .hero p {
            font-size: 1.25rem;
            color: var(--secondary);
            max-width: 650px;
            margin-bottom: 40px;
        }

        .hero-actions {
            display: flex;
            gap: 20px;
            margin-bottom: 60px;
        }

        .btn-large {
            padding: 16px 40px;
            font-size: 1.1rem;
            border-radius: 16px;
        }

        /* Hero Image */
        .hero-image-container {
            position: relative;
            width: 100%;
            max-width: 1100px;
            margin-top: 40px;
            border-radius: 32px;
            padding: 10px;
            background: white;
            box-shadow: 0 40px 100px rgba(0,0,0,0.1);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .hero-image {
            width: 100%;
            border-radius: 24px;
            display: block;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, transparent 80%, white);
        }

        /* Stats Section */
        .stats {
            padding: 60px 5%;
            background: white;
            border-top: 1px solid #f1f5f9;
            border-bottom: 1px solid #f1f5f9;
        }

        .stats-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-item h4 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .stat-item p {
            color: var(--secondary);
            font-weight: 500;
        }

        /* Features Section */
        .features {
            padding: 120px 5%;
        }

        .section-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 800;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: white;
            padding: 40px;
            border-radius: 24px;
            border: 1px solid #f1f5f9;
            transition: 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
            border-color: var(--primary-light);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 24px;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .feature-card p {
            color: var(--secondary);
        }

        /* Solutions Section */
        .solutions {
            padding: 120px 5%;
            background: #f8fafc;
        }

        .solution-item {
            max-width: 1100px;
            margin: 0 auto 60px;
            display: flex;
            align-items: center;
            gap: 60px;
            background: white;
            padding: 60px;
            border-radius: 32px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.03);
        }

        .solution-item:nth-child(even) {
            flex-direction: row-reverse;
        }

        .solution-content {
            flex: 1;
        }

        .solution-content h3 {
            font-size: 2rem;
            margin-bottom: 20px;
            font-weight: 800;
        }

        .solution-image {
            flex: 1;
            background: var(--primary-light);
            height: 300px;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8rem;
            color: var(--primary);
            opacity: 0.3;
        }

        /* Pricing */
        .pricing {
            padding: 120px 5%;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .pricing-card {
            background: white;
            padding: 50px 40px;
            border-radius: 32px;
            border: 1px solid #f1f5f9;
            text-align: center;
            transition: 0.3s;
        }

        .pricing-card.featured {
            background: var(--dark);
            color: white;
            transform: scale(1.05);
            box-shadow: 0 30px 60px rgba(30, 41, 59, 0.2);
            border: none;
        }

        .pricing-card h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .price {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 30px;
        }

        .price span {
            font-size: 1rem;
            font-weight: 500;
            opacity: 0.6;
        }

        .pricing-features {
            list-style: none;
            margin-bottom: 40px;
            text-align: left;
        }

        .pricing-features li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .pricing-features i {
            color: var(--primary);
        }

        /* About Section */
        .about {
            padding: 120px 5%;
            background: white;
        }

        /* Footer */
        footer {
            background: #0f172a;
            color: white;
            padding: 100px 5% 40px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            margin-bottom: 80px;
        }

        .footer-logo-side {
            max-width: 400px;
        }

        .footer-logo-side .navbar-brand-custom {
            color: white;
            margin-bottom: 24px;
        }

        .footer-logo-side p {
            opacity: 0.6;
        }

        .footer-links-side {
            display: flex;
            gap: 100px;
        }

        .footer-column h5 {
            font-size: 1.1rem;
            margin-bottom: 24px;
            font-weight: 700;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 12px;
        }

        .footer-column ul li a {
            color: white;
            text-decoration: none;
            opacity: 0.6;
            transition: 0.3s;
        }

        .footer-column ul li a:hover {
            opacity: 1;
            color: var(--primary);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 40px;
            border-top: 1px solid rgba(255,255,255,0.1);
            opacity: 0.4;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .hero h1 { font-size: 3rem; }
            .feature-grid, .pricing-grid, .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .solution-item { flex-direction: column !important; padding: 40px; }
            .navbar-links { display: none; }
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .feature-grid, .pricing-grid, .stats-grid { grid-template-columns: 1fr; }
            .footer-content { flex-direction: column; gap: 60px; }
            .footer-links-side { gap: 40px; flex-wrap: wrap; }
        }
    </style>
</head>
<body>
    <div class="bg-glow">
        <div class="glow-1"></div>
        <div class="glow-2"></div>
    </div>

    <nav>
        <a href="/" class="navbar-brand-custom">
            <i class="fas fa-rocket"></i>
            <span>IndustriSync</span>
        </a>

        <div class="navbar-links">
            <a href="#features">{{ __('Features') }}</a>
            <a href="#solutions">{{ __('Solutions') }}</a>
            <a href="#pricing">{{ __('Pricing') }}</a>
            <a href="#about">{{ __('About') }}</a>
        </div>

        <div class="navbar-auth">
            <div class="lang-switcher">
                <form action="{{ route('settings.locale') }}" method="POST" id="lang-form-id">
                    @csrf
                    <input type="hidden" name="locale" value="id">
                    <button type="submit" class="lang-btn {{ app()->getLocale() == 'id' ? 'active' : '' }}">ID</button>
                </form>
                <form action="{{ route('settings.locale') }}" method="POST" id="lang-form-en">
                    @csrf
                    <input type="hidden" name="locale" value="en">
                    <button type="submit" class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</button>
                </form>
            </div>
            
            @auth
                <a href="{{ route('dashboard') }}" class="btn-custom btn-register">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-custom btn-login">{{ __('Login') }}</a>
                <a href="{{ route('register') }}" class="btn-custom btn-register">{{ __('Get Started') }}</a>
            @endauth
        </div>
    </nav>

    <section class="hero">
        <div class="badge-custom">{{ __('Next-Gen Industrial Management') }}</div>
        <h1>{{ __('Synchronize Your') }} <span>{{ __('Industry') }}</span> {{ __('with Real-time Precision') }}</h1>
        <p>{{ __('The all-in-one platform to manage your inventory, transactions, and marketplace integrations with world-class aesthetics and performance.') }}</p>
        
        <div class="hero-actions">
            <a href="{{ route('register') }}" class="btn-custom btn-register btn-large">{{ __('Start Free Trial') }}</a>
            <a href="#features" class="btn-custom btn-login btn-large">{{ __('Explore Features') }} <i class="fas fa-arrow-right ms-2 opacity-50"></i></a>
        </div>

        <div class="hero-image-container">
            <img src="/hero.png" alt="IndustriSync Dashboard" class="hero-image" style="object-fit: cover; aspect-ratio: 16/9;">
            <div class="image-overlay"></div>
        </div>
    </section>

    <section class="stats">
        <div class="stats-grid">
            <div class="stat-item">
                <h4>500+</h4>
                <p>{{ __('Factories Synced') }}</p>
            </div>
            <div class="stat-item">
                <h4>99.9%</h4>
                <p>{{ __('Uptime Guaranteed') }}</p>
            </div>
            <div class="stat-item">
                <h4>1M+</h4>
                <p>{{ __('Products Tracked') }}</p>
            </div>
            <div class="stat-item">
                <h4>24/7</h4>
                <p>{{ __('Global Support') }}</p>
            </div>
        </div>
    </section>

    <section id="features" class="features">
        <div class="section-header">
            <div class="badge-custom">{{ __('Core Features') }}</div>
            <h2>{{ __('Everything You Need to Scale') }}</h2>
        </div>
        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <h3>{{ __('Inventory Management') }}</h3>
                <p>{{ __('Track your stock across multiple locations with real-time updates and automated restock alerts.') }}</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>{{ __('Real-time Analytics') }}</h3>
                <p>{{ __('Visualize your performance with dynamic charts and deep-dive reports generated instantly.') }}</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>{{ __('Enterprise Security') }}</h3>
                <p>{{ __('Role-based access control and high-level encryption to keep your industrial data safe and secure.') }}</p>
            </div>
        </div>
    </section>

    <section id="solutions" class="solutions">
        <div class="section-header">
            <div class="badge-custom">{{ __('Solutions') }}</div>
            <h2>{{ __('Tailored for Every Industry') }}</h2>
        </div>
        
        <div class="solution-item">
            <div class="solution-content">
                <h3>{{ __('Manufacturing Sync') }}</h3>
                <p>{{ __('Connect your shop floor to your top floor. Real-time data sync for assembly lines and machine performance.') }}</p>
                <ul class="pricing-features" style="text-align: left; margin-top: 2rem;">
                    <li><i class="fas fa-check"></i> {{ __('Machine downtime tracking') }}</li>
                    <li><i class="fas fa-check"></i> {{ __('Operator performance metrics') }}</li>
                    <li><i class="fas fa-check"></i> {{ __('Predictive maintenance') }}</li>
                </ul>
            </div>
            <div class="solution-image" style="overflow: hidden; opacity: 1;">
                <img src="/solution-manufacturing.png" alt="Manufacturing Sync" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>

        <div class="solution-item">
            <div class="solution-content">
                <h3>{{ __('Logistics & Supply Chain') }}</h3>
                <p>{{ __('Full visibility into your supply chain. Track shipments, manage warehouse levels, and sync with distributors.') }}</p>
                <ul class="pricing-features" style="text-align: left; margin-top: 2rem;">
                    <li><i class="fas fa-check"></i> {{ __('Real-time fleet tracking') }}</li>
                    <li><i class="fas fa-check"></i> {{ __('Smart inventory alerts') }}</li>
                    <li><i class="fas fa-check"></i> {{ __('Partner portal integration') }}</li>
                </ul>
            </div>
            <div class="solution-image" style="overflow: hidden; opacity: 1;">
                <img src="/solution-logistics.png" alt="Logistics Sync" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>
    </section>

    <section id="pricing" class="pricing">
        <div class="section-header">
            <div class="badge-custom">{{ __('Pricing') }}</div>
            <h2>{{ __('Simple, Transparent Plans') }}</h2>
        </div>
        
        <div class="pricing-grid">
            <div class="pricing-card">
                <h3>{{ __('Starter') }}</h3>
                <div class="price">{{ __('Free') }}</div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> {{ __('Up to 50 items') }}</li>
                    <li><i class="fas fa-check"></i> {{ __('1 Warehouse location') }}</li>
                    <li><i class="fas fa-check"></i> {{ __('Basic analytics') }}</li>
                    <li><i class="fas fa-check"></i> {{ __('Community support') }}</li>
                </ul>
                <a href="{{ route('register') }}" class="btn-custom btn-login w-100 justify-content-center">{{ __('Get Started') }}</a>
            </div>
            
            <div class="pricing-card featured">
                <div class="badge-custom mb-3" style="margin-bottom: 1rem !important;">{{ __('Most Popular') }}</div>
                <h3>{{ __('Pro Plan') }}</h3>
                <div class="price">$49<span>/{{ __('mo') }}</span></div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> {{ __('Unlimited items') }}</li>
                    <li><i class="fas fa-check"></i> {{ __('5 Warehouse locations') }}</li>
                    <li><i class="fas fa-check"></i> {{ __('Advanced AI insights') }}</li>
                    <li><i class="fas fa-check"></i> {{ __('Priority 24/7 support') }}</li>
                </ul>
                <a href="{{ route('register') }}" class="btn-custom btn-primary-user w-100 justify-content-center">{{ __('Try Pro Free') }}</a>
            </div>

            <div class="pricing-card">
                <h3>{{ __('Enterprise') }}</h3>
                <div class="price">{{ __('Custom') }}</div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> {{ __('Custom integrations') }}</li>
                    <li><i class="fas fa-check"></i> {{ __('Unlimited locations') }}</li>
                    <li><i class="fas fa-check"></i> {{ __('Dedicated account manager') }}</li>
                    <li><i class="fas fa-check"></i> {{ __('SLA guarantee') }}</li>
                </ul>
                <a href="#" class="btn-custom btn-login w-100 justify-content-center">{{ __('Contact Sales') }}</a>
            </div>
        </div>
    </section>

    <section id="about" class="about">
        <div class="section-header">
            <div class="badge-custom">{{ __('About Us') }}</div>
            <h2>{{ __('Our Mission') }}</h2>
            <p style="margin: 0 auto; max-width: 800px;">{{ __('We started IndustriSync with a simple goal: to make industrial operations as fluid and connected as modern software development.') }}</p>
        </div>
        <div style="max-width: 800px; margin: 0 auto; text-align: center; color: var(--secondary);">
            <p>{{ __('Today, we help thousands of SMEs and large enterprises across Indonesia and Southeast Asia to digitize their operations, reduce waste, and increase productivity through our innovative synchronization platform.') }}</p>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-logo-side">
                <a href="/" class="navbar-brand-custom">
                    <i class="fas fa-rocket"></i>
                    <span>IndustriSync</span>
                </a>
                <p>{{ __('The leading platform for modern industrial synchronization and management across various sectors.') }}</p>
            </div>
            <div class="footer-links-side">
                <div class="footer-column">
                    <h5>{{ __('Product') }}</h5>
                    <ul>
                        <li><a href="#">{{ __('Features') }}</a></li>
                        <li><a href="#">{{ __('Integrations') }}</a></li>
                        <li><a href="#">{{ __('Pricing') }}</a></li>
                        <li><a href="#">{{ __('Changelog') }}</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h5>{{ __('Company') }}</h5>
                    <ul>
                        <li><a href="#">{{ __('About Us') }}</a></li>
                        <li><a href="#">{{ __('Careers') }}</a></li>
                        <li><a href="#">{{ __('Privacy Policy') }}</a></li>
                        <li><a href="#">{{ __('Terms of Service') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} IndustriSync. {{ __('All rights reserved.') }}
        </div>
    </footer>
</body>
</html>
