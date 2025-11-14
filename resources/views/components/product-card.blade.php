@props(['name', 'sku', 'price', 'stock', 'description', 'badge' => null])

<div class="product-card">
    <style>
        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(30, 58, 138, 0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            position: relative;
        }

        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #3b82f6;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .product-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            color: #1e3a8a;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .product-sku {
            color: #94a3b8;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }

        .product-description {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            flex: 1;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .product-price {
            color: #1e3a8a;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .product-stock {
            color: #10b981;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .product-stock.low-stock {
            color: #f59e0b;
        }

        .product-stock.out-of-stock {
            color: #ef4444;
        }

        .add-to-quote {
            width: 100%;
            background: #3b82f6;
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 0.8rem;
        }

        .add-to-quote:hover {
            background: #1e40af;
        }
    </style>

    <div class="product-image">
        @if($badge)
            <span class="product-badge">{{ $badge }}</span>
        @endif
        📦
    </div>
    <div class="product-content">
        <h3 class="product-title">{{ $name }}</h3>
        <div class="product-sku">{{ __('messages.products.sku') }}: {{ $sku }}</div>
        <p class="product-description">{{ $description }}</p>
        <div class="product-meta">
            <span class="product-price">${{ number_format($price, 2) }}</span>
            <span class="product-stock {{ $stock === 'Low Stock' ? 'low-stock' : ($stock === 'Out of Stock' ? 'out-of-stock' : '') }}">
                @if($stock === 'In Stock')
                    {{ __('messages.products.in_stock') }}
                @elseif($stock === 'Low Stock')
                    {{ __('messages.products.low_stock') }}
                @else
                    {{ __('messages.products.out_of_stock') }}
                @endif
            </span>
        </div>
        <button class="add-to-quote" onclick="alert('{{ __('messages.products.quote_added') }}')">
            {{ __('messages.products.add_to_quote') }}
        </button>
    </div>
</div>
