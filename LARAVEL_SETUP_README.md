# Laravel MRO Website - Setup & Maintenance Guide

## 🎯 Project Overview

This is a Laravel-based website for **Juarez Proveeduria industrial**, an MRO (Maintenance, Repair & Operations) supplier. The site is designed for easy maintenance and consistent branding across all pages.

## 📁 Project Structure

```
jpi/
├── app/                          # Application core
├── config/
│   ├── brand.php                 # ⭐ Brand settings (company info, navigation)
│   └── products.php              # Product categories and data
├── public/
│   └── css/
│       └── brand.css             # ⭐ Centralized brand styles (colors, components)
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php         # ⭐ Main layout template
│   ├── components/
│   │   ├── navbar.blade.php      # Reusable navigation bar
│   │   ├── footer.blade.php      # Reusable footer
│   │   ├── hero.blade.php        # Hero section component
│   │   ├── category-card.blade.php  # Category display card
│   │   └── product-card.blade.php   # Product display card
│   ├── home.blade.php            # Homepage
│   ├── categories.blade.php      # Categories listing
│   ├── products.blade.php        # Product listing by category
│   └── events.blade.php          # (To be created)
└── routes/
    └── web.php                   # URL routes
```

## 🎨 Brand Consistency

### Centralized Brand Settings

All brand information is managed in **ONE place**: `config/brand.php`

```php
// config/brand.php
'company_name' => 'Juarez Proveeduria industrial',
'company_tagline' => 'Your trusted partner...',
'contact' => [
    'phone' => '(555) 123-4567',
    'email' => 'info@industrialsupply.com',
],
```

**To update company info:** Edit `config/brand.php` - changes apply site-wide automatically!

### Centralized Styles

All brand colors and reusable styles are in **ONE place**: `public/css/brand.css`

```css
:root {
    --color-primary: #1e3a8a; /* Deep blue */
    --color-primary-light: #3b82f6; /* Bright blue */
    --color-primary-dark: #1e40af; /* Darker blue */
}
```

**To change brand colors:** Edit the CSS variables in `public/css/brand.css` - changes apply everywhere!

## 🧩 Reusable Components

### Using Components in Your Pages

**Example: Adding a hero section**

```blade
<x-hero
    title="Your Page Title"
    subtitle="Your subtitle here"
    buttonText="Click Me"
    buttonUrl="/contact"
/>
```

**Example: Adding a category card**

```blade
<x-category-card
    category="Safety Equipment"
    icon="🦺"
    description="PPE and safety supplies"
    productCount="180"
    url="/products?category=safety"
/>
```

**Example: Adding a product card**

```blade
<x-product-card
    name="Safety Vest"
    sku="SV-1001"
    price="29.99"
    stock="In Stock"
    description="High-visibility safety vest"
    badge="Popular"
/>
```

## 📄 Creating a New Page

### Step 1: Create the Blade Template

Create a file in `resources/views/` (e.g., `about.blade.php`):

```blade
@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <div class="container">
        <h1>About Us</h1>
        <p>Your content here...</p>
    </div>
@endsection
```

### Step 2: Add a Route

Edit `routes/web.php`:

```php
Route::get('/about', function () {
    return view('about');
})->name('about');
```

### Step 3: Add to Navigation (Optional)

Edit `config/brand.php`:

```php
'navigation' => [
    // ... existing items
    [
        'label' => 'About',
        'route' => 'about',
        'url' => '/about',
    ],
],
```

## 🎨 Available CSS Classes

Use these pre-styled classes from `public/css/brand.css`:

### Layout

-   `.container` - Max-width content container
-   `.section` - Section with padding
-   `.section-white` - White background section
-   `.section-light` - Light gray background section

### Typography

-   `.section-title` - Large centered title
-   `.page-title` - Page heading
-   `.page-subtitle` - Page subtitle

### Buttons

```html
<button class="btn btn-primary">Primary Button</button>
<button class="btn btn-secondary">Secondary Button</button>
<button class="btn btn-large">Large Button</button>
<button class="btn btn-block">Full Width Button</button>
```

### Cards

```html
<div class="card">
    <div class="card-header">Header</div>
    <div class="card-body">Content</div>
    <div class="card-footer">Footer</div>
</div>
```

### Grids

```html
<div class="grid grid-3">
    <!-- Creates 3-column responsive grid -->
</div>
```

### Forms

```html
<div class="form-group">
    <label>Label</label>
    <input type="text" class="form-control" />
</div>
```

## 🚀 Running the Application

### Development Server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

### Building for Production

```bash
# Clear caches
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Optimize
php artisan config:cache
php artisan view:cache
php artisan route:cache
```

## 📤 Deploying to Shared Hosting

### Step 1: Upload Files

Upload all files via FTP to your hosting account:

-   Laravel files go in: `/home/youraccount/laravel/` (or similar)
-   Public files go in: `/home/youraccount/public_html/`

### Step 2: Move Public Files

Move contents of Laravel's `public/` folder to `public_html/`:

```
laravel/public/* → public_html/
```

### Step 3: Update index.php

Edit `public_html/index.php`:

Change:

```php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

To:

```php
require __DIR__.'/../laravel/vendor/autoload.php';
$app = require_once __DIR__.'/../laravel/bootstrap/app.php';
```

### Step 4: Set Permissions

```bash
chmod -R 755 storage bootstrap/cache
```

### Step 5: Configure Environment

Copy `.env.example` to `.env` and update:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

## 🔧 Common Maintenance Tasks

### Change Company Phone Number

Edit `config/brand.php`:

```php
'contact' => [
    'phone' => '(555) NEW-NUMBER',
],
```

### Change Brand Colors

Edit `public/css/brand.css`:

```css
:root {
    --color-primary: #YOUR-NEW-COLOR;
}
```

### Add New Product Category

Edit `config/products.php`:

```php
'new-category' => [
    'title' => 'Category Name',
    'icon' => '🔧',
    'description' => 'Category description',
    'products' => [
        // Add products here
    ],
],
```

Then add the card in `resources/views/categories.blade.php`:

```blade
<x-category-card
    category="Category Name"
    icon="🔧"
    description="Category description"
    productCount="50"
    url="/products?category=new-category"
/>
```

### Update Navigation Menu

Edit `config/brand.php`:

```php
'navigation' => [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'New Page', 'url' => '/new-page'],
    // ... more items
],
```

## 📊 Moving Products to Database (Future)

When ready to move products to a database:

1. Create migration:

```bash
php artisan make:migration create_products_table
```

2. Create model:

```bash
php artisan make:model Product
```

3. Update controllers to fetch from database instead of config files

## 🛟 Troubleshooting

### White Screen / 500 Error

-   Check file permissions: `chmod -R 755 storage bootstrap/cache`
-   Check `.env` file exists
-   Enable debug: `APP_DEBUG=true` in `.env`
-   Check Laravel logs: `storage/logs/laravel.log`

### CSS/Images Not Loading

-   Clear browser cache
-   Check `APP_URL` in `.env` matches your domain
-   Run: `php artisan config:clear`

### Routes Not Working

-   Check `.htaccess` exists in public folder
-   Run: `php artisan route:clear`

## 📞 Support

For Laravel documentation: https://laravel.com/docs

## ✅ Checklist for New Pages

-   [ ] Create Blade template in `resources/views/`
-   [ ] Add route in `routes/web.php`
-   [ ] Add to navigation in `config/brand.php` (if needed)
-   [ ] Use `@extends('layouts.app')` for consistent header/footer
-   [ ] Use existing components (`<x-hero>`, `<x-card>`, etc.)
-   [ ] Use CSS classes from `brand.css`
-   [ ] Test on mobile/desktop
