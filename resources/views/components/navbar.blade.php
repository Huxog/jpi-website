<header>
    <nav>
        <div class="logo">{{ config('brand.company_name') }}</div>
        <ul>
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
        .language-switcher {
            margin-left: 1rem;
            padding-left: 1rem;
            border-left: 1px solid rgba(255,255,255,0.3);
        }

        .lang-link {
            font-weight: 600;
            font-size: 0.9rem;
        }
    </style>
</header>
