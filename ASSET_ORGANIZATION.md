# Asset Organization Guide

## Overview
CSS and JavaScript have been consolidated into separate files to keep Blade templates clean and maintainable.

## Structure

```
public/
├── css/
│   ├── brand.css           # Global brand styles (colors, typography, components)
│   └── pages/
│       └── home.css        # Home page specific styles
├── js/
│   └── pages/
│       └── home.js         # Home page specific scripts
```

## How It Works

### 1. Global Styles (brand.css)
- Loaded in every page via `resources/views/layouts/app.blade.php`
- Contains CSS variables, reusable components, and brand guidelines
- Includes: buttons, cards, forms, typography, header, footer, utilities

### 2. Page-Specific Styles
- Located in `public/css/pages/`
- Loaded via `@push('styles')` in individual Blade files
- Example in `home.blade.php`:
```blade
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
@endpush
```

### 3. Page-Specific Scripts
- Located in `public/js/pages/`
- Loaded via `@push('scripts')` in individual Blade files
- Example in `home.blade.php`:
```blade
@push('scripts')
    <script src="{{ asset('js/pages/home.js') }}"></script>
@endpush
```

## Benefits

### Before (600+ lines in home.blade.php)
- Inline `<style>` tags mixed with HTML
- Inline `<script>` tags at the bottom
- Hard to maintain and debug
- No separation of concerns

### After (122 lines in home.blade.php)
- Clean, readable HTML structure
- Styles and scripts in dedicated files
- Easy to find and modify code
- Better code organization
- Improved caching and performance

## Home Page Assets

### CSS (public/css/pages/home.css)
Contains styles for:
- Services grid and cards
- Expertise carousel section
- Parallax background pattern
- Carousel controls (buttons, indicators)
- About section layout
- Contact form container
- Responsive breakpoints

### JavaScript (public/js/pages/home.js)
Contains functionality for:
- Parallax scrolling effect
- Carousel functionality (auto-rotation, navigation, touch support)
- Contact form submission handler

## Adding New Pages

When creating new pages with custom styles/scripts:

1. Create CSS file: `public/css/pages/your-page.css`
2. Create JS file: `public/js/pages/your-page.js`
3. In your Blade file:
```blade
@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/your-page.css') }}">
@endpush

@section('content')
    <!-- Your content here -->
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/your-page.js') }}"></script>
@endpush
```

## Notes

- Use IIFEs (Immediately Invoked Function Expressions) in JS to avoid global scope pollution
- Rename throttling variables to avoid conflicts (e.g., `parallaxTicking`, `navbarTicking`)
- Pass dynamic data from Blade to JS using data attributes on HTML elements
- Keep brand.css for global styles only - page-specific styles go in pages/ folder

## Maintenance

When updating styles or scripts:
1. Edit the appropriate file in `public/css/pages/` or `public/js/pages/`
2. Clear browser cache if changes don't appear
3. In production, consider cache-busting: `{{ asset('css/pages/home.css?v=1.0') }}`
