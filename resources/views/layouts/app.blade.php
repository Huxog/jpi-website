<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('brand.company_name')) - {{ config('brand.company_name') }}</title>

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('images/android-chrome-512x512.png') }}">

    <!-- Brand Styles -->
    <link rel="stylesheet" href="{{ asset('css/brand.css') }}">

    <!-- Page-specific styles -->
    @stack('styles')
</head>
<body>
    <!-- Header & Navigation -->
    <x-navbar />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Scripts -->
    <script>
        // Sticky navbar with scroll effect
        const header = document.querySelector('header');
        let lastScrollTop = 0;

        function handleScroll() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            lastScrollTop = scrollTop;
        }

        // Throttle scroll events for performance
        let navbarTicking = false;
        window.addEventListener('scroll', () => {
            if (!navbarTicking) {
                window.requestAnimationFrame(() => {
                    handleScroll();
                    navbarTicking = false;
                });
                navbarTicking = true;
            }
        });

        // Check on page load
        handleScroll();

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        // Account for sticky header height
                        const headerHeight = header.offsetHeight;
                        const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;

                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    </script>

    <!-- Page-specific scripts -->
    @stack('scripts')
</body>
</html>
