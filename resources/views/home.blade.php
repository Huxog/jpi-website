@extends('layouts.app')

@section('title', 'Juarez Proveeduria industrial - MRO Supplier for Manufacturing')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
@endpush

@section('content')

    <!-- Hero Section -->
    <x-hero :title="__('messages.home.hero_title')" :subtitle="__('messages.home.hero_subtitle')" :buttonText="__('messages.home.hero_cta')" buttonUrl="#contact" />

    <!-- Services Section -->
    <section class="section section-white" id="services">
        <div class="container">
            <h2 class="section-title">{{ __('messages.home.services.title') }}</h2>
            <div class="services-grid">
                @foreach (__('messages.home.services.list') as $service)
                    <div class="service-card">
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Industry Expertise Carousel Section -->
    <section class="expertise-section">
        <div class="expertise-content">
            <div class="container">
                <h2 class="section-title">{{ __('messages.home.services.expertise') }}</h2>
            </div>

            <div class="carousel-container">
                <!-- Carousel -->
                <div class="carousel-wrapper">
                    <div class="carousel-track" id="carouselTrack">
                        @foreach (__('messages.home.services.list') as $service)
                            <div class="carousel-slide">
                                <div class="carousel-slide-inner">
                                    <img src="{{ $service['thumbnail'] }}"
                                        alt="{{ $service['title'] }}">
                                    <div class="carousel-slide-overlay">
                                        <h3 class="carousel-slide-title">{{ $service['title'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button class="carousel-btn carousel-btn-prev" id="prevBtn" aria-label="Previous">‹</button>
                <button class="carousel-btn carousel-btn-next" id="nextBtn" aria-label="Next">›</button>

                <!-- Indicators -->
                <div class="carousel-indicators" id="carouselIndicators"></div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section section-white" id="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>{{ __('messages.home.about.title') }}</h2>
                    @foreach (__('messages.home.about.paragraphs') as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1565514020179-026b92b84bb6?auto=format&fit=crop&w=800&q=80"
                        alt="Industrial Supply Team">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="section" id="contact" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);">
        <div class="form-container">
            <h2>{{__('messages.home.contact.title')}}</h2>
            <form id="contact-form" action="#" method="POST" data-success-message="{{__('messages.home.contact.success_message')}}">
                @csrf
                <div class="form-group">
                    <label for="firstName">{{__('messages.home.contact.first_name')}} *</label>
                    <input type="text" id="firstName" name="firstName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="lastName">{{__('messages.home.contact.last_name')}} *</label>
                    <input type="text" id="lastName" name="lastName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="company">{{__('messages.home.contact.company')}}</label>
                    <input type="text" id="company" name="company" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">{{__('messages.home.contact.email')}} *</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">{{__('messages.home.contact.phone')}} *</label>
                    <input type="tel" id="phone" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="message">{{__('messages.home.contact.message')}}</label>
                    <textarea id="message" name="message" class="form-control" placeholder="{{__('messages.home.contact.message_placeholder')}}"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">{{__('messages.home.contact.submit')}}</button>
            </form>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('js/pages/home.js') }}"></script>
@endpush
