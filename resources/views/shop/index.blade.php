@extends('layouts.app')

@section('title', isset($category) ? $category->name . ' — Authentic Eclectics' : 'Shop — Authentic Eclectics')

@push('styles')
<style>
    .shop-sidebar { position: sticky; top: 80px; }
    .filter-label {
        font-size: .68rem;
        font-weight: 700;
        letter-spacing: .16em;
        text-transform: uppercase;
        color: var(--ae-dark);
        margin-bottom: .9rem;
    }
    .filter-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: .45rem 0;
        font-size: .83rem;
        color: var(--ae-muted);
        border-bottom: 1px solid transparent;
        transition: color .2s;
        text-decoration: none;
    }
    .filter-link:hover { color: var(--ae-accent); }
    .filter-link.active { color: var(--ae-dark); font-weight: 600; }
    .filter-count {
        font-size: .7rem;
        color: var(--ae-muted);
        background: var(--ae-bg);
        padding: 1px 8px;
        border-radius: 100px;
    }
    .sort-chip {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .35rem .9rem;
        border-radius: 100px;
        font-size: .75rem;
        font-weight: 500;
        border: 1.5px solid var(--ae-border);
        color: var(--ae-muted);
        cursor: pointer;
        text-decoration: none;
        transition: all .2s;
    }
    .sort-chip:hover { border-color: var(--ae-accent); color: var(--ae-accent); }
    .sort-chip.active { background: var(--ae-dark); border-color: var(--ae-dark); color: #fff; }
</style>
@endpush

@section('content')

<div class="page-crumb">
    <div class="container">
        <nav><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
            @isset($category)
                <li class="breadcrumb-item active">{{ $category->name }}</li>
            @endisset
        </ol></nav>
    </div>
</div>

@php
$activeSlug = isset($category) ? $category->slug : ($selectedCategory ?? null);
@endphp

<div class="container py-5">
    <div class="row g-5">

        {{-- ── Sidebar ── --}}
        <div class="col-lg-3 d-none d-lg-block">
            <div class="shop-sidebar">

                <div class="mb-4">
                    <div class="filter-label">Categories</div>
                    <a href="{{ route('shop') }}"
                       class="filter-link {{ !$activeSlug ? 'active' : '' }}">
                        All Products
                    </a>
                    @foreach($categories as $cat)
                    <a href="{{ route('shop.category', $cat->slug) }}"
                       class="filter-link {{ $activeSlug === $cat->slug ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                    @endforeach
                </div>

                <hr style="border-color:var(--ae-border);">

                <div class="mt-4">
                    <div class="filter-label">Sort By</div>
                    <div class="d-flex flex-column gap-2">
                        @foreach(['newest' => 'Newest First', 'price_asc' => 'Price: Low → High', 'price_desc' => 'Price: High → Low'] as $val => $label)
                        <a href="{{ request()->fullUrlWithQuery(['sort' => $val]) }}"
                           class="filter-link {{ request('sort','newest') === $val ? 'active' : '' }}">
                            {{ $label }}
                            @if(request('sort','newest') === $val)
                                <i class="bi bi-check2 text-accent"></i>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Products Grid ── --}}
        <div class="col-lg-9">

            {{-- Top bar --}}
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3"
                 style="border-bottom:1px solid var(--ae-border);">
                <div>
                    <h1 class="serif fw-bold mb-1" style="font-size:1.6rem;">
                        @isset($category) {{ $category->name }}
                        @elseif(request('q')) Results for "{{ request('q') }}"
                        @else All Products
                        @endisset
                    </h1>
                    <p class="mb-0" style="font-size:.78rem; color:var(--ae-muted);">
                        {{ $products->total() }} {{ Str::plural('item', $products->total()) }}
                    </p>
                </div>

                {{-- Sort chips (desktop) --}}
                <div class="d-none d-md-flex gap-2">
                    @foreach(['newest' => 'Latest', 'price_asc' => 'Price ↑', 'price_desc' => 'Price ↓'] as $val => $label)
                    <a href="{{ request()->fullUrlWithQuery(['sort' => $val]) }}"
                       class="sort-chip {{ request('sort','newest') === $val ? 'active' : '' }}">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-search" style="font-size:3rem; color:var(--ae-border);"></i>
                    <h5 class="serif mt-3 mb-2">No results found</h5>
                    <p style="font-size:.85rem; color:var(--ae-muted);">Try a different search or browse all categories.</p>
                    <a href="{{ route('shop') }}" class="btn-primary-ae mt-3">Browse All</a>
                </div>
            @else
                <div class="row g-4">
                    @foreach($products as $product)
                    <div class="col-6 col-md-4">
                        <div class="product-card">
                            <div class="product-img-wrap">
                                <img src="{{ $product->image ?? 'https://picsum.photos/seed/sp'.$product->id.'/500/500' }}"
                                     alt="{{ $product->name }}" loading="lazy">
                                <div class="product-hover-actions" style="flex-direction:column; gap:.5rem;">
                                    <a href="{{ route('shop.show', $product->slug) }}"
                                       class="btn-outline-ae" style="padding:.4rem 1.2rem; font-size:.72rem; color:#fff; border-color:rgba(255,255,255,.6);">
                                        <i class="bi bi-eye me-1"></i> View Product
                                    </a>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn-accent-ae"
                                                style="padding:.4rem 1.2rem; font-size:.72rem; border:none; cursor:pointer; width:100%;">
                                            <i class="bi bi-bag-plus me-1"></i> Quick Add
                                        </button>
                                    </form>
                                </div>
                                @if($product->is_on_sale)
                                    <span class="badge-sale">Sale</span>
                                @endif
                            </div>
                            <div class="product-info">
                                <div class="product-cat-tag">{{ $product->category->name }}</div>
                                <div class="product-title">
                                    <a href="{{ route('shop.show', $product->slug) }}" style="color:inherit;">{{ $product->name }}</a>
                                </div>
                                <div class="product-pricing">
                                    <span class="price-now">${{ number_format($product->current_price, 2) }}</span>
                                    @if($product->is_on_sale)
                                        <span class="price-was">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-5">
                    {{ $products->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
