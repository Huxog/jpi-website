@props(['title', 'subtitle', 'buttonText' => null, 'buttonUrl' => null])

<section class="hero">
    <style>
        .hero {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 6rem 2rem;
            text-align: center;
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
            color: #1e40af;
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
            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1.1rem;
            }
        }
    </style>

    <div class="container">
        <h1>{{ $title }}</h1>
        <p>{{ $subtitle }}</p>
        @if($buttonText && $buttonUrl)
            <a href="{{ $buttonUrl }}" class="cta-button">{{ $buttonText }}</a>
        @endif
    </div>
</section>
