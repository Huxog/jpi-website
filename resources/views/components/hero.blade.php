@props(['title' => null, 'subtitle', 'buttonText' => null, 'buttonUrl' => null, 'showLogo' => true])

<section class="hero">
    <style>
        .hero {
            background: var(--gradient-hero);
            color: white;
            padding: 6rem 2rem;
            text-align: center;
        }

        .hero-logo {
            max-width: 400px;
            height: auto;
            margin-bottom: 2rem;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .hero h1 {
            color: white;
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .hero p {
            color: rgba(255,255,255,0.95);
            font-size: 1.3rem;
            margin-bottom: 2rem;
        }

        .hero .cta-button {
            background: white;
            color: var(--color-primary);
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .hero .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        @media (max-width: 768px) {
            .hero {
                padding: 4rem 1.5rem;
            }

            .hero-logo {
                max-width: 280px;
                margin-bottom: 1.5rem;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1.1rem;
                margin-bottom: 1.5rem;
            }

            .hero .cta-button {
                padding: 0.9rem 2rem;
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .hero {
                padding: 3rem 1rem;
            }

            .hero-logo {
                max-width: 220px;
                margin-bottom: 1rem;
            }

            .hero h1 {
                font-size: 1.75rem;
            }

            .hero p {
                font-size: 1rem;
                margin-bottom: 1.5rem;
            }

            .hero .cta-button {
                padding: 0.8rem 1.8rem;
                font-size: 0.95rem;
                width: 100%;
                max-width: 280px;
            }
        }
    </style>

    <div class="container">
        @if($showLogo)
            <img src="{{ asset('images/main-logo.jpg') }}" alt="{{ config('brand.company_name') }}" class="hero-logo">
        @elseif($title)
            <h1>{{ $title }}</h1>
        @endif
        <p>{{ $subtitle }}</p>
        @if($buttonText && $buttonUrl)
            <a href="{{ $buttonUrl }}" class="cta-button">{{ $buttonText }}</a>
        @endif
    </div>
</section>
