<header>
    <nav>
        <a href="{{ localized_route('home') }}" class="logo">
            <img src="{{ asset('images/main-logo.jpg') }}" alt="{{ config('brand.company_name') }}" class="logo-img">
        </a>

        {{-- Mobile Menu Toggle --}}
        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <ul class="nav-menu" id="navMenu">
            <li><a href="{{ localized_route('home') }}">{{ __('messages.nav.home') }}</a></li>
            <li><a href="{{ localized_route('categories') }}">{{ __('messages.nav.categories') }}</a></li>
            <li><a href="{{ localized_route('home') }}#contact">{{ __('messages.nav.contact') }}</a></li>

            {{-- Language Switcher --}}
            <li class="language-switcher">
                @foreach(config('brand.languages') as $code => $name)
                    @if($code !== current_locale())
                        <a href="{{ switch_locale_url($code) }}" class="lang-link">{{ strtoupper($code) }}</a>
                    @endif
                @endforeach
            </li>
        </ul>
    </nav>

    <style>
        .logo-img {
            height: 50px;
            width: auto;
            display: block;
            transition: opacity 0.3s;
        }

        .logo-img:hover {
            opacity: 0.8;
        }

        header.scrolled .logo-img {
            height: 40px;
        }

        .language-switcher {
            margin-left: 1rem;
            padding-left: 1rem;
            border-left: 1px solid rgba(255,255,255,0.3);
        }

        .lang-link {
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 24px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
            z-index: 1001;
        }

        .mobile-menu-toggle span {
            width: 100%;
            height: 3px;
            background: white;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .mobile-menu-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
        }

        .mobile-menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }

        @media (max-width: 768px) {
            .logo-img {
                height: 40px;
            }

            header.scrolled .logo-img {
                height: 35px;
            }

            /* Show hamburger menu */
            .mobile-menu-toggle {
                display: flex;
            }

            /* Mobile menu styles */
            .nav-menu {
                position: fixed;
                top: 60px;
                right: -100%;
                width: 280px;
                height: calc(100vh - 60px);
                background: var(--color-primary);
                flex-direction: column;
                padding: 2rem 1rem;
                transition: right 0.3s ease;
                box-shadow: -2px 0 10px rgba(0, 0, 0, 0.2);
                overflow-y: auto;
            }

            .nav-menu.active {
                right: 0;
            }

            .nav-menu li {
                margin-bottom: 1rem;
            }

            .nav-menu a {
                display: block;
                padding: 0.8rem 1rem;
                font-size: 1.1rem;
                border-radius: 5px;
                transition: background 0.3s;
            }

            .nav-menu a:hover {
                background: rgba(255, 255, 255, 0.1);
            }

            .language-switcher {
                margin-left: 0;
                padding-left: 0;
                border-left: none;
                border-top: 1px solid rgba(255,255,255,0.3);
                padding-top: 1rem;
                margin-top: 1rem;
            }

            .language-switcher a {
                width: 100%;
            }
        }
    </style>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const navMenu = document.getElementById('navMenu');

            if (mobileMenuToggle && navMenu) {
                mobileMenuToggle.addEventListener('click', function() {
                    this.classList.toggle('active');
                    navMenu.classList.toggle('active');
                });

                // Close menu when clicking on a link
                const navLinks = navMenu.querySelectorAll('a');
                navLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenuToggle.classList.remove('active');
                        navMenu.classList.remove('active');
                    });
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(event) {
                    const isClickInsideNav = navMenu.contains(event.target);
                    const isClickOnToggle = mobileMenuToggle.contains(event.target);

                    if (!isClickInsideNav && !isClickOnToggle && navMenu.classList.contains('active')) {
                        mobileMenuToggle.classList.remove('active');
                        navMenu.classList.remove('active');
                    }
                });
            }
        });
    </script>
</header>
