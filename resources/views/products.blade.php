@extends('layouts.app')

@php
    $categoryData = config('products.categories')[$category] ?? config('products.categories')['tools'];
@endphp

@section('title', $categoryData['title'] ?? 'Products')

@section('content')

<style>
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 2rem;
        color: #64748b;
        font-size: 0.9rem;
        padding: 0 2rem;
        margin-top: 2rem;
    }

    .breadcrumb a {
        color: var(--color-primary-light);
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .breadcrumb-separator {
        color: #cbd5e1;
    }

    .page-header {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }

    .category-info {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .category-icon-large {
        font-size: 3rem;
        background: var(--gradient-primary);
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    .category-details h1 {
        color: var(--color-primary);
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .category-details p {
        color: #64748b;
        font-size: 1.1rem;
    }

    .controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .search-box {
        flex: 1;
        min-width: 250px;
    }

    .search-box input {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 5px;
        font-size: 1rem;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    @media (max-width: 768px) {
        .category-info {
            flex-direction: column;
            text-align: center;
        }

        .controls {
            flex-direction: column;
        }

        .search-box {
            width: 100%;
        }
    }
</style>

<div class="container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ localized_route('home') }}">{{ __('messages.nav.home') }}</a>
        <span class="breadcrumb-separator">›</span>
        <a href="{{ localized_route('categories') }}">{{ __('messages.nav.categories') }}</a>
        <span class="breadcrumb-separator">›</span>
        <span>{{ $categoryData['title'] }}</span>
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <div class="category-info">
            <div class="category-icon-large">{{ $categoryData['icon'] }}</div>
            <div class="category-details">
                <h1>{{ $categoryData['title'] }}</h1>
                <p>{{ $categoryData['description'] }}</p>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <div class="controls">
        <div class="search-box">
            <input type="text" id="search-input" placeholder="{{ __('messages.products.search_placeholder') }}" class="form-control">
        </div>
    </div>

    <!-- Products Grid -->
    <div class="products-grid">
        @foreach($categoryData['products'] ?? [] as $product)
            <x-product-card
                :name="$product['name']"
                :sku="$product['sku']"
                :price="$product['price']"
                :stock="$product['stock']"
                :description="$product['description']"
                :badge="$product['badge']"
            />
        @endforeach
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Search functionality
    document.getElementById('search-input').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const productCards = document.querySelectorAll('.product-card');

        productCards.forEach(card => {
            const title = card.querySelector('.product-title').textContent.toLowerCase();
            const sku = card.querySelector('.product-sku').textContent.toLowerCase();
            const description = card.querySelector('.product-description').textContent.toLowerCase();

            if (title.includes(searchTerm) || sku.includes(searchTerm) || description.includes(searchTerm)) {
                card.parentElement.style.display = 'block';
            } else {
                card.parentElement.style.display = 'none';
            }
        });
    });
</script>
@endpush
