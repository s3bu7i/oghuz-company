<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __t('meta_title'))</title>
    <meta name="description" content="@yield('description', __t('meta_description'))">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('head')
</head>
<body>
    @php($locale = app()->getLocale())

    <!-- Creative Loader -->
    <div class="site-loader" id="siteLoader" aria-label="{{ __t('loader_label') }}">
        <div class="loader-panel">
            <div class="loader-top">
                <div class="loader-blocks" id="loaderBlocks" aria-hidden="true">
                    @for($i = 0; $i < 10; $i++)
                        <span></span>
                    @endfor
                </div>
                <div class="loader-count" id="loaderCount">0%</div>
            </div>
            <div class="loader-title" id="loaderStatus" data-loaded="{{ __t('loader_loaded') }}">{{ __t('loader_loading_content') }}</div>
            <div class="loader-complete" id="loaderComplete" aria-hidden="true">
                <div class="loader-brand">{{ __t('brand_name') }}</div>
                <div class="loader-loaded">{{ __t('loader_loaded') }}</div>
                <div class="loader-ready">{{ __t('loader_ready') }}</div>
            </div>
        </div>
    </div>

    <div class="cursor-glow" id="cursorGlow"></div>

    <!-- Particle Canvas -->
    <canvas id="particleCanvas"></canvas>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="nav-logo" aria-label="{{ __t('brand_name') }}">
                <img src="{{ asset('images/logo-nav.png') }}" class="logo-img" alt="{{ __t('brand_name') }}">
            </a>
            <ul class="nav-links" id="navLinks">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __t('nav_home') }}</a></li>
                <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">{{ __t('nav_services') }}</a></li>
                <li><a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio') ? 'active' : '' }}">{{ __t('nav_portfolio') }}</a></li>
                <li><a href="{{ route('blog') }}" class="{{ request()->routeIs('blog*') ? 'active' : '' }}">{{ __t('nav_blog') }}</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">{{ __t('nav_contact') }}</a></li>
            </ul>
            <div class="nav-actions">
                <div class="lang-switch" aria-label="{{ __t('language') }}">
                    <a href="{{ route('language.switch', 'az') }}" class="{{ $locale === 'az' ? 'active' : '' }}">AZ</a>
                    <a href="{{ route('language.switch', 'en') }}" class="{{ $locale === 'en' ? 'active' : '' }}">EN</a>
                </div>
                <a href="{{ route('contact') }}" class="btn-primary-sm">
                    <i class="fas fa-rocket"></i> {{ __t('start_project') }}
                </a>
                <button class="hamburger" id="hamburger" aria-label="{{ __t('menu') }}">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}">{{ __t('nav_home') }}</a>
        <a href="{{ route('services') }}">{{ __t('nav_services') }}</a>
        <a href="{{ route('portfolio') }}">{{ __t('nav_portfolio') }}</a>
        <a href="{{ route('blog') }}">{{ __t('nav_blog') }}</a>
        <a href="{{ route('contact') }}">{{ __t('nav_contact') }}</a>
        <div class="lang-switch lang-switch-mobile" aria-label="{{ __t('language') }}">
            <a href="{{ route('language.switch', 'az') }}" class="{{ $locale === 'az' ? 'active' : '' }}">AZ</a>
            <a href="{{ route('language.switch', 'en') }}" class="{{ $locale === 'en' ? 'active' : '' }}">EN</a>
        </div>
        <a href="{{ route('contact') }}" class="btn-primary-sm" style="display:inline-block;margin-top:1rem;">{{ __t('start_project') }}</a>
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
                    <a href="{{ route('home') }}" class="nav-logo footer-logo" aria-label="{{ __t('brand_name') }}">
                        <img src="{{ asset('images/logo-nav.png') }}" class="logo-img" alt="{{ __t('brand_name') }}">
                    </a>
                    <p>{{ __t('footer_about') }}</p>
                    <div class="social-links">
                        <a href="#" aria-label="{{ __t('social_facebook') }}"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="{{ __t('social_linkedin') }}"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" aria-label="{{ __t('social_instagram') }}"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="{{ __t('social_twitter') }}"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="{{ __t('social_github') }}"><i class="fab fa-github"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>{{ __t('footer_services') }}</h4>
                    <ul>
                        <li><a href="{{ route('services') }}">{{ __t('footer_software') }}</a></li>
                        <li><a href="{{ route('services') }}">{{ __t('footer_cloud') }}</a></li>
                        <li><a href="{{ route('services') }}">{{ __t('footer_security') }}</a></li>
                        <li><a href="{{ route('services') }}">{{ __t('footer_mobile') }}</a></li>
                        <li><a href="{{ route('services') }}">{{ __t('footer_ai') }}</a></li>
                        <li><a href="{{ route('services') }}">{{ __t('footer_consulting') }}</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>{{ __t('footer_company') }}</h4>
                    <ul>
                        <li><a href="{{ route('home') }}#about">{{ __t('footer_about_link') }}</a></li>
                        <li><a href="{{ route('portfolio') }}">{{ __t('nav_portfolio') }}</a></li>
                        <li><a href="{{ route('blog') }}">{{ __t('nav_blog') }}</a></li>
                        <li><a href="{{ route('contact') }}">{{ __t('nav_contact') }}</a></li>
                        <li><a href="{{ route('admin.dashboard') }}">{{ __t('admin_panel') }}</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>{{ __t('footer_contact') }}</h4>
                    <ul class="contact-list">
                        <li><i class="fas fa-phone"></i><a href="tel:+994508816613">+994 50 881 66 13</a></li>
                        <li><i class="fas fa-envelope"></i><a href="mailto:sabuhi.gasimzada@gmail.com">sabuhi.gasimzada@gmail.com</a></li>
                        <li><i class="fas fa-map-marker-alt"></i><span>{{ __t('footer_address') }}</span></li>
                        <li><i class="fas fa-clock"></i><span>{{ __t('footer_hours') }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ __t('brand_name') }}. {{ __t('footer_rights') }}</p>
                <div class="footer-live">
                    <span class="live-dot"></span>
                    <span id="onlineCount">12</span> {{ __t('footer_online') }}
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top -->
    <button class="scroll-top" id="scrollTop" aria-label="{{ __t('scroll_top') }}">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Toast Notification -->
    <div class="toast" id="toast"></div>

    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')
</body>
</html>
