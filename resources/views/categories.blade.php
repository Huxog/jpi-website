@extends('layouts.app')

@section('title', __('messages.categories.title'))

@section('content')

<div class="container" style="margin-top: 2rem; margin-bottom: 3rem;">
    <div class="page-header text-center" style="margin-bottom: 3rem;">
        <h1 class="page-title">{{ __('messages.categories.title') }}</h1>
        <p class="page-subtitle">{{ __('messages.categories.subtitle') }}</p>
    </div>

    <style>
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
    </style>

    <div class="categories-grid">
        <x-category-card
            :category="__('messages.categories.safety_equipment')"
            icon="🦺"
            :description="__('messages.categories.safety_equipment_desc')"
            productCount="180"
            :url="localized_route('products') . '?category=safety-equipment'"
        />

        <x-category-card
            :category="__('messages.categories.tools')"
            icon="🔧"
            :description="__('messages.categories.tools_desc')"
            productCount="250"
            :url="localized_route('products') . '?category=tools'"
        />

        <x-category-card
            :category="__('messages.categories.fasteners')"
            icon="🔩"
            :description="__('messages.categories.fasteners_desc')"
            productCount="320"
            :url="localized_route('products') . '?category=fasteners'"
        />

        <x-category-card
            :category="__('messages.categories.electrical')"
            icon="⚡"
            :description="__('messages.categories.electrical_desc')"
            productCount="195"
            :url="localized_route('products') . '?category=electrical'"
        />

        <x-category-card
            :category="__('messages.categories.plumbing_hvac')"
            icon="🔧"
            :description="__('messages.categories.plumbing_hvac_desc')"
            productCount="165"
            :url="localized_route('products') . '?category=plumbing-hvac'"
        />

        <x-category-card
            :category="__('messages.categories.welding')"
            icon="🔥"
            :description="__('messages.categories.welding_desc')"
            productCount="140"
            :url="localized_route('products') . '?category=welding'"
        />

        <x-category-card
            :category="__('messages.categories.material_handling')"
            icon="📦"
            :description="__('messages.categories.material_handling_desc')"
            productCount="125"
            :url="localized_route('products') . '?category=material-handling'"
        />

        <x-category-card
            :category="__('messages.categories.lubricants')"
            icon="🛢️"
            :description="__('messages.categories.lubricants_desc')"
            productCount="90"
            :url="localized_route('products') . '?category=lubricants'"
        />

        <x-category-card
            :category="__('messages.categories.abrasives')"
            icon="⚙️"
            :description="__('messages.categories.abrasives_desc')"
            productCount="210"
            :url="localized_route('products') . '?category=abrasives'"
        />

        <x-category-card
            :category="__('messages.categories.cleaning')"
            icon="🧹"
            :description="__('messages.categories.cleaning_desc')"
            productCount="110"
            :url="localized_route('products') . '?category=cleaning'"
        />

        <x-category-card
            :category="__('messages.categories.adhesives')"
            icon="🧪"
            :description="__('messages.categories.adhesives_desc')"
            productCount="85"
            :url="localized_route('products') . '?category=adhesives'"
        />

        <x-category-card
            :category="__('messages.categories.bearings')"
            icon="⚙️"
            :description="__('messages.categories.bearings_desc')"
            productCount="175"
            :url="localized_route('products') . '?category=bearings'"
        />
    </div>
</div>

@endsection
