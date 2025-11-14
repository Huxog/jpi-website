# Bilingual Website Setup Guide

## 🌍 Overview

Your website now supports **English and Spanish** with clean URL structure:
- English: `yoursite.com/en/...`
- Spanish: `yoursite.com/es/...`

## 🏗️ How It Works

### 1. **URL Structure**

```
/ → Redirects to /en (default language)
/en → English homepage
/en/categories → English categories page
/en/products?category=tools → English products page

/es → Spanish homepage
/es/categories → Spanish categories page (Categorías)
/es/products?category=tools → Spanish products page (Productos)
```

### 2. **Language Detection**

The `SetLocale` middleware automatically detects the language from the URL and sets it for the entire request.

### 3. **Translation Files**

All translatable text is stored in:
- `lang/en/messages.php` - English translations
- `lang/es/messages.php` - Spanish translations

## 📝 How to Use Translations in Your Code

### In Blade Templates

```blade
{{-- Simple translation --}}
<h1>{{ __('messages.home.hero_title') }}</h1>

{{-- Translation with parameters --}}
<p>{{ __('messages.copyright', ['company' => config('brand.company_name')]) }}</p>

{{-- In attributes --}}
<input placeholder="{{ __('messages.products.search_placeholder') }}">
```

### Generating Localized URLs

```blade
{{-- Link to home in current language --}}
<a href="{{ localized_route('home') }}">Home</a>

{{-- Link to categories in current language --}}
<a href="{{ localized_route('categories') }}">Categories</a>

{{-- Link to products with query parameters --}}
<a href="{{ localized_route('products') }}?category=tools">Tools</a>
```

### Language Switcher

The navbar already includes a language switcher that maintains the current page:

```blade
{{-- Automatically switches between EN/ES while staying on same page --}}
@foreach(config('brand.languages') as $code => $name)
    @if($code !== current_locale())
        <a href="{{ switch_locale_url($code) }}">{{ strtoupper($code) }}</a>
    @endif
@endforeach
```

## ✏️ Adding New Translations

### Step 1: Add to English file (`lang/en/messages.php`)

```php
return [
    'new_section' => [
        'title' => 'New Section Title',
        'description' => 'This is the description',
    ],
];
```

### Step 2: Add to Spanish file (`lang/es/messages.php`)

```php
return [
    'new_section' => [
        'title' => 'Título de Nueva Sección',
        'description' => 'Esta es la descripción',
    ],
];
```

### Step 3: Use in Blade

```blade
<h2>{{ __('messages.new_section.title') }}</h2>
<p>{{ __('messages.new_section.description') }}</p>
```

## 🎯 What's Already Translated

### ✅ Components
- **Navbar** - Navigation links + language switcher
- **Footer** - All links and copyright
- **Product Card** - Add to Quote button, stock status, SKU label
- **Category Card** - "View Products" link, product count

### ✅ Translation Keys Available

**Navigation:**
- `messages.nav.home`
- `messages.nav.categories`
- `messages.nav.events`
- `messages.nav.contact`

**Homepage:**
- `messages.home.hero_title`
- `messages.home.hero_subtitle`
- `messages.home.hero_cta`
- `messages.home.services_title`
- `messages.home.service_tools_title` (and 5 more service sections)
- `messages.home.about_title`
- `messages.home.contact_title`

**Categories Page:**
- `messages.categories.title`
- `messages.categories.subtitle`
- `messages.categories.safety_equipment` (and 11 more categories)
- `messages.categories.products_count`
- `messages.categories.view_products`

**Products Page:**
- `messages.products.search_placeholder`
- `messages.products.add_to_quote`
- `messages.products.sku`
- `messages.products.in_stock`
- `messages.products.low_stock`
- `messages.products.out_of_stock`

**Contact Form:**
- `messages.contact.first_name`
- `messages.contact.last_name`
- `messages.contact.company`
- `messages.contact.email`
- `messages.contact.phone`
- `messages.contact.message`
- `messages.contact.submit`

## 🔧 Helper Functions Available

### `localized_route($name, $params = [], $locale = null)`
Generate a URL for a named route in the current (or specified) language.

```blade
<a href="{{ localized_route('home') }}">Home</a>
<a href="{{ localized_route('products') }}?category=tools">Products</a>
<a href="{{ localized_route('home', [], 'es') }}">Spanish Home</a>
```

### `current_locale()`
Get the current language code.

```blade
@if(current_locale() == 'es')
    <p>¡Hola!</p>
@else
    <p>Hello!</p>
@endif
```

### `switch_locale_url($locale)`
Get URL to switch to a different language while staying on the same page.

```blade
<a href="{{ switch_locale_url('es') }}">Español</a>
<a href="{{ switch_locale_url('en') }}">English</a>
```

## 📋 Completing Remaining Views

Some views still need translation updates. Here's how to update them:

### Example: Update Services Section in home.blade.php

**Before:**
```blade
<h2 class="section-title">Our MRO Solutions</h2>
<div class="service-card">
    <h3>Industrial Tools & Equipment</h3>
    <p>High-quality tools...</p>
</div>
```

**After:**
```blade
<h2 class="section-title">{{ __('messages.home.services_title') }}</h2>
<div class="service-card">
    <h3>{{ __('messages.home.service_tools_title') }}</h3>
    <p>{{ __('messages.home.service_tools_desc') }}</p>
</div>
```

### Example: Update Categories Page

The categories page needs to use translation keys for category names and descriptions:

**Before:**
```blade
<x-category-card
    category="Safety Equipment"
    description="PPE, fall protection..."
    productCount="180"
    url="/products?category=safety-equipment"
/>
```

**After:**
```blade
<x-category-card
    :category="__('messages.categories.safety_equipment')"
    :description="__('messages.categories.safety_equipment_desc')"
    productCount="180"
    :url="localized_route('products') . '?category=safety-equipment'"
/>
```

## 🌐 Adding a New Language

To add Portuguese, for example:

### Step 1: Update config
Edit `config/brand.php`:
```php
'languages' => [
    'en' => 'English',
    'es' => 'Español',
    'pt' => 'Português', // New!
],
```

### Step 2: Create translation file
Copy `lang/en/messages.php` to `lang/pt/messages.php` and translate all values.

### Step 3: Done!
The language will automatically appear in the switcher and work with URLs like `/pt/categories`.

## 🚀 Best Practices

### 1. **Never Hard-code Text**
❌ Bad:
```blade
<button>Add to Cart</button>
```

✅ Good:
```blade
<button>{{ __('messages.cart.add') }}</button>
```

### 2. **Use Descriptive Keys**
❌ Bad:
```php
'btn1' => 'Submit',
```

✅ Good:
```php
'contact.submit' => 'Submit Request',
```

### 3. **Keep Non-translatable in Config**
Things that DON'T change per language go in `config/brand.php`:
- Company name
- Phone number
- Email address
- Social media URLs

### 4. **Always Use Helper Functions for URLs**
❌ Bad:
```blade
<a href="/categories">Categories</a>
```

✅ Good:
```blade
<a href="{{ localized_route('categories') }}">{{ __('messages.nav.categories') }}</a>
```

## 🔍 Testing

### Test Language Switching
1. Start server: `php artisan serve`
2. Visit: `http://localhost:8000`
3. Should redirect to: `http://localhost:8000/en`
4. Click "ES" in navbar
5. Should go to: `http://localhost:8000/es`
6. All text should be in Spanish

### Test URL Structure
```bash
# English
http://localhost:8000/en
http://localhost:8000/en/categories
http://localhost:8000/en/products?category=tools

# Spanish
http://localhost:8000/es
http://localhost:8000/es/categories
http://localhost:8000/es/products?category=tools
```

## 📊 File Structure

```
jpi/
├── lang/
│   ├── en/
│   │   └── messages.php          ← English translations
│   └── es/
│       └── messages.php          ← Spanish translations
├── app/
│   ├── helpers.php               ← localized_route(), switch_locale_url()
│   └── Http/Middleware/
│       └── SetLocale.php         ← Detects language from URL
├── config/
│   └── brand.php                 ← Supported languages config
└── routes/
    └── web.php                   ← Language-prefixed routes
```

## 🎓 Quick Reference

**Get translation:**
```blade
{{ __('messages.key.name') }}
```

**Link to page:**
```blade
{{ localized_route('page-name') }}
```

**Switch language:**
```blade
{{ switch_locale_url('es') }}
```

**Check current language:**
```blade
{{ current_locale() }}
```

**Translation with variable:**
```blade
{{ __('messages.welcome', ['name' => 'John']) }}
```
In lang file: `'welcome' => 'Welcome, :name!'`

## ✅ Next Steps

1. **Update remaining views** to use translation keys (home.blade.php services section, about section, contact form)
2. **Update categories.blade.php** to use localized routes
3. **Update products.blade.php** to translate search placeholder and breadcrumbs
4. **Test thoroughly** in both languages
5. **Add product data** in both languages (currently hardcoded in English)

## 📞 Common Issues

**Problem:** Translations not showing
- **Solution:** Clear cache: `php artisan config:clear && php artisan view:clear`

**Problem:** Language not switching
- **Solution:** Check middleware is registered in `bootstrap/app.php`

**Problem:** URLs broken after language change
- **Solution:** Make sure you're using `localized_route()` instead of `route()`

**Problem:** New translation not appearing
- **Solution:** Add to BOTH `lang/en/messages.php` AND `lang/es/messages.php`
