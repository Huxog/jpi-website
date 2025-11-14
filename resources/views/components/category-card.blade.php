@props(['category', 'icon', 'description', 'productCount', 'url'])

<a href="{{ $url }}" class="category-card">
    <style>
        .category-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 20, 57, 0.15);
        }

        .category-image {
            width: 100%;
            height: 200px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .category-icon {
            font-size: 4rem;
            position: relative;
            z-index: 1;
        }

        .category-content {
            padding: 1.5rem;
        }

        .category-title {
            color: var(--color-primary);
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .category-description {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .category-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .product-count {
            color: var(--color-primary-light);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .view-products {
            color: var(--color-primary);
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .view-products::after {
            content: '→';
            transition: transform 0.3s;
        }

        .category-card:hover .view-products::after {
            transform: translateX(5px);
        }
    </style>

    <div class="category-image">
        <div class="category-icon">{{ $icon }}</div>
    </div>
    <div class="category-content">
        <h3 class="category-title">{{ $category }}</h3>
        <p class="category-description">{{ $description }}</p>
        <div class="category-meta">
            <span class="product-count">{{ __('messages.categories.products_count', ['count' => $productCount]) }}</span>
            <span class="view-products">{{ __('messages.categories.view_products') }}</span>
        </div>
    </div>
</a>
