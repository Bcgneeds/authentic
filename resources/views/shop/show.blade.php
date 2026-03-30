@extends('layouts.app')

@section('title', $product->name . ' — Authentic Eclectics')

@push('styles')
<style>
    .product-gallery-main {
        aspect-ratio: 1/1;
        overflow: hidden;
        border-radius: 4px;
        background: var(--ae-cream);
        border: 1px solid var(--ae-border);
    }
    .product-gallery-main img {
        width: 100%; height: 100%;
        object-fit: cover;
    }
    .product-detail-price { font-size: 1.8rem; font-weight: 700; color: var(--ae-dark); }
    .product-detail-old   { font-size: 1.1rem; color: var(--ae-muted); text-decoration: line-through; }
    .qty-input {
        width: 55px;
        text-align: center;
        border: 1px solid var(--ae-border);
        border-radius: 2px;
        font-size: .9rem;
        padding: .35rem;
    }
    .qty-btn {
        width: 34px; height: 34px;
        border: 1px solid var(--ae-border);
        background: #fff;
        border-radius: 2px;
        cursor: pointer;
        font-size: 1rem;
        line-height: 1;
        transition: all .2s;
    }
    .qty-btn:hover { background: var(--ae-dark); color: #fff; border-color: var(--ae-dark); }
    .meta-row { display: flex; gap: .5rem; align-items: center; font-size: .85rem; color: var(--ae-muted); margin-bottom: .5rem; }
    .meta-row strong { color: var(--ae-dark); min-width: 80px; }
    .stock-badge {
        display: inline-block;
        font-size: .72rem;
        font-weight: 600;
        letter-spacing: .06em;
        padding: 3px 10px;
        border-radius: 2px;
        text-transform: uppercase;
    }
    .stock-in  { background: #e8f5e9; color: #2e7d32; }
    .stock-low { background: #fff3e0; color: #e65100; }
    .stock-out { background: #fce4ec; color: #c62828; }
</style>
@endpush

@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-ae">
    <div class="container">
        <nav><ol class="breadcrumb mb-0" style="font-size:.82rem;">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($product->name, 35) }}</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">

        {{-- ── Gallery ── --}}
        <div class="col-lg-6">
            <div class="product-gallery-main">
                <img src="{{ $product->image ?? 'https://picsum.photos/seed/pd'.$product->id.'/700/700' }}"
                     alt="{{ $product->name }}">
            </div>
        </div>

        {{-- ── Details ── --}}
        <div class="col-lg-6">
            <div class="product-category mb-2">{{ $product->category->name }}</div>

            <h1 class="serif fw-bold mb-3" style="font-size:2rem; line-height:1.2;">{{ $product->name }}</h1>

            {{-- Price --}}
            <div class="d-flex align-items-center gap-3 mb-4">
                <span class="product-detail-price">${{ number_format($product->current_price, 2) }}</span>
                @if($product->is_on_sale)
                    <span class="product-detail-old">${{ number_format($product->price, 2) }}</span>
                    <span class="badge bg-danger px-2 py-1" style="font-size:.7rem; border-radius:2px;">
                        {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% OFF
                    </span>
                @endif
            </div>

            {{-- Short desc --}}
            @if($product->short_description)
            <p class="text-muted mb-4" style="line-height:1.8;">{{ $product->short_description }}</p>
            @endif

            <hr style="border-color:var(--ae-border);">

            {{-- Meta --}}
            <div class="mb-4">
                <div class="meta-row">
                    <strong>Availability</strong>
                    @if($product->stock > 10)
                        <span class="stock-badge stock-in"><i class="bi bi-check-circle me-1"></i>In Stock</span>
                    @elseif($product->stock > 0)
                        <span class="stock-badge stock-low"><i class="bi bi-exclamation-circle me-1"></i>Only {{ $product->stock }} left</span>
                    @else
                        <span class="stock-badge stock-out">Out of Stock</span>
                    @endif
                </div>
                <div class="meta-row">
                    <strong>Category</strong>
                    <a href="{{ route('shop.category', $product->category->slug) }}" class="text-gold">{{ $product->category->name }}</a>
                </div>
            </div>

            {{-- Add to cart --}}
            @if($product->stock > 0)
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                        <input type="number" name="quantity" id="qty" class="qty-input" value="1" min="1" max="{{ $product->stock }}">
                        <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <button type="submit" class="btn-gold btn btn-lg flex-grow-1">
                        <i class="bi bi-bag-plus me-2"></i> Add to Cart
                    </button>
                    <a href="{{ route('checkout.index') }}" class="btn-outline-gold btn btn-lg">Buy Now</a>
                </div>
            </form>
            @else
                <button class="btn btn-secondary btn-lg w-100" disabled>Out of Stock</button>
            @endif

            {{-- Perks --}}
            <div class="row g-2 mt-4">
                <div class="col-4 text-center" style="font-size:.75rem; color:var(--ae-muted);">
                    <i class="bi bi-truck text-gold d-block mb-1" style="font-size:1.2rem;"></i> Free Shipping<br>over $100
                </div>
                <div class="col-4 text-center" style="font-size:.75rem; color:var(--ae-muted);">
                    <i class="bi bi-shield-check text-gold d-block mb-1" style="font-size:1.2rem;"></i> Authentic<br>Guaranteed
                </div>
                <div class="col-4 text-center" style="font-size:.75rem; color:var(--ae-muted);">
                    <i class="bi bi-arrow-counterclockwise text-gold d-block mb-1" style="font-size:1.2rem;"></i> 30-Day<br>Returns
                </div>
            </div>
        </div>
    </div>

    {{-- ── Description ── --}}
    @if($product->description)
    <div class="row mt-5">
        <div class="col-12">
            <ul class="nav nav-tabs border-0 mb-4" id="productTabs">
                <li class="nav-item">
                    <button class="nav-link active border-0 px-0 me-4 pb-2 serif fw-bold"
                            style="font-size:1rem; color:var(--ae-dark); border-bottom:2px solid var(--ae-gold) !important; background:none;"
                            data-bs-toggle="tab" data-bs-target="#desc">
                        Description
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="desc">
                    <div class="text-muted" style="line-height:1.9; max-width:700px;">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ── Related Products ── --}}
    @if($related->count())
    <div class="mt-5 pt-4" style="border-top:1px solid var(--ae-border);">
        <div class="section-header text-start mb-4">
            <div class="section-label text-start" style="text-align:left !important;">You May Also Like</div>
            <h3 class="section-title" style="font-size:1.6rem; text-align:left !important;">Related Products</h3>
        </div>
        <div class="row g-4">
            @foreach($related as $rel)
            <div class="col-6 col-md-3">
                <div class="product-card h-100">
                    <div class="product-img-wrap">
                        <img src="{{ $rel->image ?? 'https://picsum.photos/seed/r'.$rel->id.'/500/500' }}"
                             alt="{{ $rel->name }}" loading="lazy">
                        @if($rel->is_on_sale) <span class="badge-sale">Sale</span> @endif
                    </div>
                    <div class="product-body">
                        <div class="product-name">
                            <a href="{{ route('shop.show', $rel->slug) }}" class="text-dark">{{ $rel->name }}</a>
                        </div>
                        <div class="product-price">
                            <span class="price-current">${{ number_format($rel->current_price, 2) }}</span>
                            @if($rel->is_on_sale)
                                <span class="price-old">${{ number_format($rel->price, 2) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
function changeQty(delta) {
    const input = document.getElementById('qty');
    const max = parseInt(input.max);
    let val = parseInt(input.value) + delta;
    input.value = Math.max(1, Math.min(max, val));
}
</script>
@endpush

@endsection
