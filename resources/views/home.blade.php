@extends('layouts.app')

@section('title', 'Authentic Eclectics — Curated General Merchandise')

@push('styles')
<style>
    /* ── Hero ── */
    .hero {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: calc(100vh - 106px);
        overflow: hidden;
    }
    .hero-left {
        background: var(--ae-dark);
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 5rem 4rem 5rem 6vw;
        position: relative;
    }
    .hero-left::after {
        content: '';
        position: absolute;
        inset: 0;
        background: url('https://images.unsplash.com/photo-1528360983277-13d401cdc186?w=900&h=1000&fit=crop') center/cover;
        opacity: .08;
        pointer-events: none;
    }
    .hero-content { position: relative; z-index: 1; }
    .hero-eyebrow {
        font-size: .68rem;
        font-weight: 600;
        letter-spacing: .25em;
        text-transform: uppercase;
        color: var(--ae-accent);
        margin-bottom: 1.4rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .hero-eyebrow::before {
        content: '';
        width: 28px; height: 1px;
        background: var(--ae-accent);
        display: block;
    }
    .hero-h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(3rem, 5.5vw, 5rem);
        font-weight: 700;
        color: #fff;
        line-height: 1.05;
        margin-bottom: 1.6rem;
    }
    .hero-h1 em {
        color: var(--ae-accent);
        font-style: italic;
    }
    .hero-p {
        font-size: .95rem;
        color: rgba(255,255,255,.5);
        max-width: 360px;
        line-height: 1.8;
        margin-bottom: 2.5rem;
    }
    .hero-ctas {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .hero-right {
        overflow: hidden;
        background: var(--ae-bg);
    }
    .hero-img {
        width: 100%; height: 100%;
        overflow: hidden;
    }
    .hero-img img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .6s ease;
    }
    .hero-img:hover img { transform: scale(1.04); }

    /* ── Category strip ── */
    .cat-strip {
        display: flex;
        overflow-x: auto;
        gap: 1rem;
        padding: 2.5rem 0;
        scrollbar-width: none;
    }
    .cat-strip::-webkit-scrollbar { display: none; }
    .cat-chip {
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: .7rem;
        cursor: pointer;
        text-decoration: none;
    }
    .cat-chip-img {
        width: 90px; height: 90px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid transparent;
        transition: border-color .2s;
    }
    .cat-chip-img img {
        width: 100%; height: 100%;
        object-fit: cover;
    }
    .cat-chip:hover .cat-chip-img { border-color: var(--ae-accent); }
    .cat-chip-label {
        font-size: .72rem;
        font-weight: 600;
        letter-spacing: .06em;
        color: var(--ae-text);
        text-align: center;
    }

    /* ── Split promo ── */
    .split-promo {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }
    .split-img {
        overflow: hidden;
        min-height: 420px;
    }
    .split-img img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .6s;
    }
    .split-img:hover img { transform: scale(1.04); }
    .split-text {
        background: var(--ae-cream);
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 4rem 5rem;
    }

    /* ── Banner ── */
    .full-banner {
        background: var(--ae-dark);
        position: relative;
        overflow: hidden;
        padding: 5rem 0;
        text-align: center;
    }
    .full-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=1400&h=500&fit=crop') center/cover;
        opacity: .12;
    }

    /* ── Testimonials ── */
    .testimonial-card {
        background: var(--ae-surface);
        border-radius: 12px;
        padding: 2rem;
        border: 1px solid var(--ae-border);
    }
    .stars { color: #F59E0B; letter-spacing: 2px; font-size: .85rem; }

    /* ── Why us ── */
    .why-item {
        display: flex;
        align-items: flex-start;
        gap: 1.2rem;
    }
    .why-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        background: rgba(196,98,45,.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: var(--ae-accent);
        flex-shrink: 0;
    }

    @media (max-width: 767px) {
        .hero { grid-template-columns: 1fr; min-height: auto; }
        .hero-left { padding: 3.5rem 1.5rem; }
        .hero-right { display: none; }
        .split-promo { grid-template-columns: 1fr; }
        .split-text { padding: 2.5rem 1.5rem; }
    }
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════ --}}
<section class="hero">
    <div class="hero-left">
        <div class="hero-content">
            <div class="hero-eyebrow">New Collection</div>
            <h1 class="hero-h1">
                Shop<br>
                The <em>Finest</em><br>
                Finds
            </h1>
            <p class="hero-p">
                Handpicked merchandise from artisans and makers worldwide. Unique products for people with taste.
            </p>
            <div class="hero-ctas">
                <a href="{{ route('shop') }}" class="btn-accent-ae">
                    Explore Shop <i class="bi bi-arrow-right"></i>
                </a>
                <a href="{{ route('shop') }}?sort=newest" class="btn-outline-ae" style="color:#fff; border-color:rgba(255,255,255,.3);">
                    New Arrivals
                </a>
            </div>
        </div>
    </div>
    <div class="hero-right">
        <div class="hero-img">
            <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=900&h=900&fit=crop" alt="Shop">
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     CATEGORY CHIPS
════════════════════════════════════════════════════ --}}

{{-- ═══════════════════════════════════════════════════
     FEATURED PRODUCTS (dummy placeholders)
════════════════════════════════════════════════════ --}}
<section class="py-5" style="background:var(--ae-bg);">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <div class="section-tag">Handpicked</div>
                <h2 class="section-heading">Featured Products</h2>
                <div class="divider-accent"></div>
            </div>
            <a href="{{ route('shop') }}" class="btn-outline-ae d-none d-md-inline-flex" style="padding:.5rem 1.4rem;">
                View All
            </a>
        </div>

        <div class="row g-4">
            @forelse($featuredProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-card">
                    <div class="product-img-wrap">
                        <img src="{{ $product->image ?? 'https://picsum.photos/seed/fp'.$product->id.'/500/500' }}"
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
            @empty
            <div class="col-12 text-center py-4 text-muted" style="font-size:.9rem;">
                No featured products yet. <a href="{{ route('shop') }}">Browse all products</a>.
            </div>
            @endforelse
        </div>

        <div class="text-center mt-5 d-md-none">
            <a href="{{ route('shop') }}" class="btn-outline-ae">View All Products</a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     SPLIT PROMO — Left image / Right text
════════════════════════════════════════════════════ --}}
<section class="split-promo">
    <div class="split-img">
        <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=700&h=600&fit=crop" alt="Our Story">
    </div>
    <div class="split-text">
        <div class="section-tag">Our Promise</div>
        <h2 class="section-heading mb-4" style="font-size:clamp(2rem,3.5vw,2.8rem);">
            Curated with care,<br><em>delivered with love</em>
        </h2>
        <p style="color:var(--ae-muted); line-height:1.9; margin-bottom:2rem; max-width:400px;">
            Every item in our store is personally selected for quality and uniqueness. We believe shopping should be an experience — not just a transaction.
        </p>
        <div class="d-flex flex-column gap-3 mb-3" style="max-width:340px;">
            <div class="why-item">
                <div class="why-icon"><i class="bi bi-shield-check"></i></div>
                <div>
                    <div style="font-weight:600; font-size:.9rem; margin-bottom:.2rem;">100% Authentic</div>
                    <div style="font-size:.82rem; color:var(--ae-muted);">Every product verified before it reaches you.</div>
                </div>
            </div>
            <div class="why-item">
                <div class="why-icon"><i class="bi bi-truck"></i></div>
                <div>
                    <div style="font-weight:600; font-size:.9rem; margin-bottom:.2rem;">Fast Delivery</div>
                    <div style="font-size:.82rem; color:var(--ae-muted);">Free shipping on all orders over $100.</div>
                </div>
            </div>
            <div class="why-item">
                <div class="why-icon"><i class="bi bi-arrow-counterclockwise"></i></div>
                <div>
                    <div style="font-weight:600; font-size:.9rem; margin-bottom:.2rem;">Easy Returns</div>
                    <div style="font-size:.82rem; color:var(--ae-muted);">30-day hassle-free return on all items.</div>
                </div>
            </div>
        </div>
        <a href="{{ route('shop') }}" class="btn-primary-ae mt-2">Shop Now</a>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     FULL-WIDTH BANNER
════════════════════════════════════════════════════ --}}
<section class="full-banner">
    <div class="container" style="position:relative; z-index:1;">
        <div class="section-tag" style="color:var(--ae-accent); justify-content:center; display:flex;">Limited Offer</div>
        <h2 class="serif text-white mt-2 mb-3" style="font-size:clamp(2rem,4vw,3.2rem); font-weight:700;">
            Free Shipping on Orders Over $100
        </h2>
        <p style="color:rgba(255,255,255,.5); font-size:.95rem; max-width:460px; margin:0 auto 2rem; line-height:1.8;">
            Shop our full collection and enjoy complimentary delivery. No code needed — discount applied automatically at checkout.
        </p>
        <a href="{{ route('shop') }}" class="btn-accent-ae">
            Shop Now <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     TESTIMONIALS
════════════════════════════════════════════════════ --}}
<section class="py-5" style="background:var(--ae-bg);">
    <div class="container py-4">
        <div class="text-center mb-5">
            <div class="section-tag" style="text-align:center;">Reviews</div>
            <h2 class="section-heading">What Our Customers Say</h2>
            <div class="divider-accent mx-auto"></div>
        </div>
        <div class="row g-4">
            @foreach([
                ['name'=>'Sarah M.',    'text'=>'Absolutely love the quality of everything I have ordered. The ceramic vase is even more beautiful in person. Fast delivery too!'],
                ['name'=>'James O.',   'text'=>'Authentic Eclectics is my go-to for gifts. The packaging is lovely and every item feels premium. Highly recommend.'],
                ['name'=>'Aisha B.',    'text'=>'Found some truly unique pieces here that I couldn\'t find anywhere else. The curation is excellent and customer service is top-notch.'],
            ] as $review)
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="stars mb-3">★★★★★</div>
                    <p style="font-size:.88rem; color:var(--ae-muted); line-height:1.8; margin-bottom:1.2rem;">
                        "{{ $review['text'] }}"
                    </p>
                    <div style="font-weight:600; font-size:.85rem; color:var(--ae-dark);">{{ $review['name'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     WHY SHOP WITH US
════════════════════════════════════════════════════ --}}
<section style="background:var(--ae-cream); border-top:1px solid var(--ae-border); padding:5rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-tag" style="text-align:center;">Our Promise</div>
            <h2 class="section-heading">Why Shop With Us</h2>
            <div class="divider-accent mx-auto"></div>
        </div>
        <div class="row g-4">
            @foreach([
                ['icon' => 'bi-shield-check',    'title' => 'Secure Checkout',    'text' => 'Every transaction is encrypted and protected. Shop with complete confidence.'],
                ['icon' => 'bi-arrow-repeat',    'title' => 'Easy Returns',       'text' => 'Not happy with your order? We offer a hassle-free return process.'],
                ['icon' => 'bi-gem',             'title' => 'Quality Guaranteed', 'text' => 'Every item is carefully selected to meet our standard of quality.'],
                ['icon' => 'bi-headset',         'title' => 'Dedicated Support',  'text' => 'Our team is always on hand to help with any questions or concerns.'],
            ] as $item)
            <div class="col-6 col-md-3">
                <div style="text-align:center; padding:1.5rem 1rem;">
                    <div style="width:56px; height:56px; border-radius:50%; background:var(--ae-bg); border:1px solid var(--ae-border); display:flex; align-items:center; justify-content:center; margin:0 auto 1.2rem; font-size:1.3rem; color:var(--ae-accent);">
                        <i class="bi {{ $item['icon'] }}"></i>
                    </div>
                    <div style="font-weight:700; font-size:.9rem; color:var(--ae-dark); margin-bottom:.5rem;">{{ $item['title'] }}</div>
                    <p style="font-size:.8rem; color:var(--ae-muted); line-height:1.7; margin:0;">{{ $item['text'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
