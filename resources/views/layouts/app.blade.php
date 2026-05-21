<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'OghuzTech — IT Həlləri Şirkəti')</title>
    <meta name="description" content="@yield('description', 'OghuzTech — Azərbaycanda premium IT həlləri. Proqram inkişafı, bulud, kibertəhlükəsizlik, mobil tətbiqlər.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('head')
</head>
<body>
    <!-- Particle Canvas -->
    <canvas id="particleCanvas"></canvas>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="nav-logo">
                <span class="logo-icon"><i class="fas fa-microchip"></i></span>
                <span class="logo-text">Oghuz<span class="logo-accent">Tech</span></span>
            </a>
            <ul class="nav-links" id="navLinks">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Ana Səhifə</a></li>
                <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Xidmətlər</a></li>
                <li><a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio') ? 'active' : '' }}">Portfolio</a></li>
                <li><a href="{{ route('blog') }}" class="{{ request()->routeIs('blog*') ? 'active' : '' }}">Blog</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Əlaqə</a></li>
            </ul>
            <div class="nav-actions">
                <a href="{{ route('contact') }}" class="btn-primary-sm">
                    <i class="fas fa-rocket"></i> Layihə Başlat
                </a>
                <button class="hamburger" id="hamburger" aria-label="Menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}">Ana Səhifə</a>
        <a href="{{ route('services') }}">Xidmətlər</a>
        <a href="{{ route('portfolio') }}">Portfolio</a>
        <a href="{{ route('blog') }}">Blog</a>
        <a href="{{ route('contact') }}">Əlaqə</a>
        <a href="{{ route('contact') }}" class="btn-primary-sm" style="display:inline-block;margin-top:1rem;">Layihə Başlat</a>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-glow"></div>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ route('home') }}" class="nav-logo">
                        <span class="logo-icon"><i class="fas fa-microchip"></i></span>
                        <span class="logo-text">Oghuz<span class="logo-accent">Tech</span></span>
                    </a>
                    <p>Azərbaycanda innovativ IT həlləri ilə biznesinizi gələcəyə daşıyırıq. 2016-dan bəri güvənilir texnologiya tərəfdaşınız.</p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Xidmətlər</h4>
                    <ul>
                        <li><a href="{{ route('services') }}">Proqram Təminatı</a></li>
                        <li><a href="{{ route('services') }}">Bulud Həlləri</a></li>
                        <li><a href="{{ route('services') }}">Kibertəhlükəsizlik</a></li>
                        <li><a href="{{ route('services') }}">Mobil Tətbiqlər</a></li>
                        <li><a href="{{ route('services') }}">AI Həlləri</a></li>
                        <li><a href="{{ route('services') }}">IT Konsaltinq</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Şirkət</h4>
                    <ul>
                        <li><a href="{{ route('home') }}#about">Haqqımızda</a></li>
                        <li><a href="{{ route('portfolio') }}">Portfolio</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a href="{{ route('contact') }}">Əlaqə</a></li>
                        <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Əlaqə</h4>
                    <ul class="contact-list">
                        <li><i class="fas fa-phone"></i><a href="tel:+994508816613">+994 50 881 66 13</a></li>
                        <li><i class="fas fa-envelope"></i><a href="mailto:sabuhi.gasimzada@gmail.com">sabuhi.gasimzada@gmail.com</a></li>
                        <li><i class="fas fa-map-marker-alt"></i><span>Bakı, Azərbaycan</span></li>
                        <li><i class="fas fa-clock"></i><span>B.e – Cümə: 09:00–18:00</span></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} OghuzTech. Bütün hüquqlar qorunur.</p>
                <div class="footer-live">
                    <span class="live-dot"></span>
                    <span id="onlineCount">12</span> nəfər onlayndır
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top -->
    <button class="scroll-top" id="scrollTop" aria-label="Yuxarı qayıt">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Toast Notification -->
    <div class="toast" id="toast"></div>

    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')
</body>
</html>
