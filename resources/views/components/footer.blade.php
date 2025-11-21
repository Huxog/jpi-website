<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h3>{{ config('brand.company_name') }}</h3>
            <p>{{ __('messages.company_tagline') }}</p>
        </div>
        <div class="footer-section">
            <h3>{{ __('messages.footer.quick_links') }}</h3>
            <a href="{{ localized_route('home') }}">{{ __('messages.nav.home') }}</a>
            <a href="{{ localized_route('categories') }}">{{ __('messages.nav.categories') }}</a>
            <a href="{{ asset('Catalogo_Automatizaciones_2025.pdf') }}" target="_blank">{{ __('messages.footer.automation_catalog') }}</a>
            <a href="{{ localized_route('home') }}#contact">{{ __('messages.nav.contact') }}</a>
        </div>
        <div class="footer-section">
            <h3>{{ __('messages.footer.contact_info') }}</h3>
            <p>Phone: {{ config('brand.contact.phone') }}</p>
            <p>Email: {{ config('brand.contact.email') }}</p>
            <p>{{ __('messages.footer.hours') }}: {{ config('brand.contact.hours') }}</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} {{ __('messages.copyright', ['company' => config('brand.company_name')]) }}</p>
    </div>
</footer>
