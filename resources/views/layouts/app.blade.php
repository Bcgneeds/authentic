<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Authentic Eclectics')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --ae-bg:       #F3F5F8;
            --ae-dark:     #0D1B3E;
            --ae-accent:   #1E40AF;
            --ae-accent2:  #3B82F6;
            --ae-cream:    #E8EBF2;
            --ae-border:   #C9D0DC;
            --ae-text:     #1A2535;
            --ae-muted:    #64748B;
            --ae-surface:  #FFFFFF;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--ae-bg);
            color: var(--ae-text);
            font-size: 15px;
            line-height: 1.65;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, .serif {
            font-family: 'Cormorant Garamond', serif;
            letter-spacing: -0.01em;
        }

        a { text-decoration: none; color: inherit; transition: color .2s; }

        /* ── Announcement Bar ── */
        .announce-bar {
            background: var(--ae-dark);
            color: rgba(255,255,255,.65);
            font-size: .72rem;
            letter-spacing: .08em;
            text-align: center;
            padding: 9px 0;
        }
        .announce-bar strong { color: #fff; }

        /* ── Navbar ── */
        .site-nav {
            background: var(--ae-surface);
            border-bottom: 1px solid var(--ae-border);
            position: sticky;
            top: 0;
            z-index: 999;
        }
        .nav-inner {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 0 1.5rem;
            height: 64px;
        }
        .nav-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--ae-dark);
            letter-spacing: .02em;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .nav-logo span {
            color: var(--ae-accent);
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 0;
            flex: 1;
            justify-content: center;
            list-style: none;
        }
        .nav-links a {
            display: block;
            padding: .5rem 1rem;
            font-size: .75rem;
            font-weight: 500;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--ae-muted);
            position: relative;
            transition: color .2s;
        }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -1px; left: 1rem; right: 1rem;
            height: 2px;
            background: var(--ae-accent);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .25s ease;
        }
        .nav-links a:hover,
        .nav-links a.active { color: var(--ae-dark); }
        .nav-links a:hover::after,
        .nav-links a.active::after { transform: scaleX(1); }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: .2rem;
            flex-shrink: 0;
        }
        .nav-icon {
            width: 38px; height: 38px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
            color: var(--ae-dark);
            font-size: 1.05rem;
            position: relative;
            transition: background .2s;
            cursor: pointer;
            border: none;
            background: none;
        }
        .nav-icon:hover { background: var(--ae-bg); color: var(--ae-accent); }
        .cart-dot {
            position: absolute;
            top: 5px; right: 5px;
            width: 8px; height: 8px;
            background: var(--ae-accent);
            border-radius: 50%;
            border: 2px solid #fff;
        }

        /* Search bar */
        .nav-search {
            display: flex;
            align-items: center;
            border: 1px solid var(--ae-border);
            border-radius: 100px;
            overflow: hidden;
            background: var(--ae-bg);
        }
        .nav-search input {
            border: none;
            background: none;
            padding: .35rem .75rem;
            font-size: .78rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--ae-text);
            width: 180px;
            outline: none;
        }
        .nav-search button {
            border: none;
            background: none;
            padding: .35rem .65rem;
            color: var(--ae-muted);
            cursor: pointer;
            font-size: .82rem;
        }
        .nav-search button:hover { color: var(--ae-accent); }

        /* Dropdown */
        .nav-dropdown {
            position: relative;
        }
        .nav-dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            min-width: 200px;
            background: #fff;
            border: 1px solid var(--ae-border);
            border-radius: 8px;
            padding: .5rem;
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
            opacity: 0;
            pointer-events: none;
            transform: translateY(4px);
            transition: all .2s;
            z-index: 100;
        }
        .nav-dropdown:hover .nav-dropdown-menu {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }
        .nav-dropdown-menu a {
            display: block;
            padding: .45rem .75rem;
            border-radius: 6px;
            font-size: .8rem;
            color: var(--ae-text) !important;
            text-transform: none !important;
            letter-spacing: 0 !important;
        }
        .nav-dropdown-menu a::after { display: none !important; }
        .nav-dropdown-menu a:hover { background: var(--ae-bg); color: var(--ae-accent) !important; }

        /* Mobile toggle */
        .nav-toggle {
            display: none;
            border: none;
            background: none;
            font-size: 1.3rem;
            color: var(--ae-dark);
            cursor: pointer;
        }

        /* ── Buttons ── */
        .btn-primary-ae {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: var(--ae-dark);
            color: #fff;
            border: 1.5px solid var(--ae-dark);
            padding: .65rem 1.75rem;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            border-radius: 100px;
            cursor: pointer;
            transition: all .25s;
        }
        .btn-primary-ae:hover {
            background: var(--ae-accent);
            border-color: var(--ae-accent);
            color: #fff;
        }
        .btn-outline-ae {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: transparent;
            color: var(--ae-dark);
            border: 1.5px solid var(--ae-dark);
            padding: .65rem 1.75rem;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            border-radius: 100px;
            cursor: pointer;
            transition: all .25s;
        }
        .btn-outline-ae:hover {
            background: var(--ae-dark);
            color: #fff;
        }
        .btn-accent-ae {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: var(--ae-accent);
            color: #fff;
            border: 1.5px solid var(--ae-accent);
            padding: .65rem 1.75rem;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            border-radius: 100px;
            cursor: pointer;
            transition: all .25s;
        }
        .btn-accent-ae:hover {
            background: var(--ae-dark);
            border-color: var(--ae-dark);
            color: #fff;
        }

        /* ── Product Card ── */
        .product-card {
            background: var(--ae-surface);
            border-radius: 12px;
            overflow: hidden;
            transition: box-shadow .3s, transform .3s;
        }
        .product-card:hover {
            box-shadow: 0 16px 48px rgba(0,0,0,.1);
            transform: translateY(-4px);
        }
        .product-img-wrap {
            position: relative;
            overflow: hidden;
            aspect-ratio: 1 / 1;
            background: var(--ae-bg);
        }
        .product-img-wrap img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }
        .product-card:hover .product-img-wrap img { transform: scale(1.05); }
        .product-hover-actions {
            position: absolute;
            inset: 0;
            background: rgba(30,42,58,.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity .3s;
            backdrop-filter: blur(2px);
        }
        .product-card:hover .product-hover-actions { opacity: 1; }
        .badge-sale {
            position: absolute;
            top: 12px; left: 12px;
            background: var(--ae-accent);
            color: #fff;
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .08em;
            padding: 4px 10px;
            border-radius: 100px;
            text-transform: uppercase;
        }
        .product-info {
            padding: 1rem 1.1rem 1.2rem;
        }
        .product-cat-tag {
            font-size: .68rem;
            font-weight: 600;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--ae-accent);
            margin-bottom: .3rem;
        }
        .product-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--ae-dark);
            margin-bottom: .5rem;
            line-height: 1.3;
        }
        .product-pricing {
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .price-now { font-size: .95rem; font-weight: 600; color: var(--ae-dark); }
        .price-was { font-size: .82rem; color: var(--ae-muted); text-decoration: line-through; }

        /* ── Section Headings ── */
        .section-tag {
            font-size: .68rem;
            font-weight: 600;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--ae-accent);
            margin-bottom: .6rem;
        }
        .section-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.8rem, 3vw, 2.4rem);
            font-weight: 700;
            color: var(--ae-dark);
            line-height: 1.15;
        }

        /* ── Flash messages ── */
        .flash-wrap { padding: .75rem 0 0; }
        .flash-wrap .alert {
            border-radius: 10px;
            font-size: .85rem;
            border: none;
        }

        /* ── Breadcrumb ── */
        .page-crumb {
            background: var(--ae-surface);
            border-bottom: 1px solid var(--ae-border);
            padding: .65rem 0;
        }
        .breadcrumb { margin: 0; font-size: .78rem; }
        .breadcrumb-item a { color: var(--ae-accent); }
        .breadcrumb-item.active { color: var(--ae-muted); }

        /* ── Footer ── */
        .site-footer {
            background: var(--ae-dark);
            color: rgba(255,255,255,.55);
            padding: 5rem 0 0;
        }
        .footer-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
        }
        .footer-brand span { color: var(--ae-accent); }
        .footer-col-title {
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: rgba(255,255,255,.9);
            margin-bottom: 1.2rem;
        }
        .footer-link {
            display: block;
            font-size: .83rem;
            color: rgba(255,255,255,.5);
            margin-bottom: .55rem;
            transition: color .2s;
        }
        .footer-link:hover { color: var(--ae-accent); }
        .footer-bottom {
            margin-top: 4rem;
            padding: 1.2rem 0;
            border-top: 1px solid rgba(255,255,255,.08);
            font-size: .75rem;
            color: rgba(255,255,255,.3);
        }

        /* ── Helpers ── */
        .text-accent { color: var(--ae-accent) !important; }
        .bg-ae { background: var(--ae-bg); }
        .divider-accent {
            width: 40px; height: 2px;
            background: var(--ae-accent);
            margin: .8rem 0 0;
        }

        /* ── Auth button helpers ── */
        .btn-gold {
            background: var(--ae-accent);
            color: #fff;
            border-color: var(--ae-accent);
            font-weight: 600;
        }
        .btn-gold:hover, .btn-gold:focus {
            background: #1D4ED8;
            border-color: #1D4ED8;
            color: #fff;
        }
        .text-gold { color: var(--ae-accent) !important; }

        /* ── Responsive ── */
        @media (max-width: 991px) {
            .nav-links, .nav-search { display: none; }
            .nav-toggle { display: block; }
            .nav-inner { justify-content: space-between; }
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- Announcement --}}
<div class="announce-bar">
    <strong>Free shipping</strong> on orders over $100 &nbsp;·&nbsp; Use code <strong>WELCOME10</strong> for 10% off your first order
</div>

{{-- Navbar --}}
<header class="site-nav">
    <div class="container">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="nav-logo">
                Authentic <span>Eclectics</span>
            </a>

            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'active' : '' }}">Shop</a></li>
                <li class="nav-dropdown">
                    <a href="#">Categories <i class="bi bi-chevron-down" style="font-size:.6rem;"></i></a>
                    <div class="nav-dropdown-menu">
                        @foreach(\App\Models\Category::all() as $cat)
                            <a href="{{ route('shop.category', $cat->slug) }}">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </li>
                <li><a href="{{ route('shop') }}?sort=newest">New Arrivals</a></li>
            </ul>

            <div class="nav-actions">
                {{-- Search --}}
                <form action="{{ route('shop') }}" method="GET" class="nav-search d-none d-lg-flex">
                    <input type="search" name="q" placeholder="Search…" value="{{ request('q') }}">
                    <button type="submit"><i class="bi bi-search"></i></button>
                </form>

                {{-- Account --}}
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="nav-icon" title="Admin">
                            <i class="bi bi-shield-check"></i>
                        </a>
                    @else
                        <a href="{{ route('profile') }}" class="nav-icon" title="{{ auth()->user()->name }}">
                            <i class="bi bi-person-circle"></i>
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="nav-icon" title="Sign in">
                        <i class="bi bi-person"></i>
                    </a>
                @endauth

                {{-- Cart --}}
                <a href="{{ route('cart.index') }}" class="nav-icon" title="Cart">
                    <i class="bi bi-bag"></i>
                    @if(count(session('cart', [])) > 0)
                        <span class="cart-dot"></span>
                    @endif
                </a>

                <button class="nav-toggle" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div class="collapse" id="mobileMenu">
        <div class="container py-3" style="border-top:1px solid var(--ae-border);">
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('home') }}" style="font-size:.85rem; padding:.4rem 0; color:var(--ae-text);">Home</a>
                <a href="{{ route('shop') }}" style="font-size:.85rem; padding:.4rem 0; color:var(--ae-text);">Shop All</a>
                @foreach(\App\Models\Category::all() as $cat)
                    <a href="{{ route('shop.category', $cat->slug) }}" style="font-size:.82rem; padding:.35rem 0 .35rem 1rem; color:var(--ae-muted);">{{ $cat->name }}</a>
                @endforeach
                <hr style="border-color:var(--ae-border);">
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" style="font-size:.85rem; background:none; border:none; padding:.4rem 0; color:var(--ae-muted); cursor:pointer;">Sign Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="font-size:.85rem; padding:.4rem 0; color:var(--ae-text);">Sign In</a>
                    <a href="{{ route('register') }}" style="font-size:.85rem; padding:.4rem 0; color:var(--ae-text);">Create Account</a>
                @endauth
            </div>
        </div>
    </div>
</header>

{{-- Flash --}}
@if(session('success') || session('error'))
<div class="container flash-wrap">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>
@endif

@yield('content')

{{-- Footer --}}
<footer class="site-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand mb-3">Authentic <span>Eclectics</span></div>
                <p style="font-size:.83rem; line-height:1.8; color:rgba(255,255,255,.4); max-width:280px;">
                    A curated collection of unique, high-quality merchandise. Something genuine for every taste.
                </p>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="footer-col-title">Shop</div>
                <a href="{{ route('shop') }}" class="footer-link">All Products</a>
                @foreach(\App\Models\Category::take(5)->get() as $cat)
                    <a href="{{ route('shop.category', $cat->slug) }}" class="footer-link">{{ $cat->name }}</a>
                @endforeach
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="footer-col-title">Help</div>
                <a href="#" class="footer-link">About Us</a>
                <a href="#" class="footer-link">Contact</a>
                <a href="#" class="footer-link">FAQs</a>
                <a href="#" class="footer-link">Shipping Policy</a>
                <a href="#" class="footer-link">Returns</a>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer-col-title">Stay in the Loop</div>
                <p style="font-size:.82rem; color:rgba(255,255,255,.4); margin-bottom:.9rem; line-height:1.7;">
                    New arrivals, exclusive deals, and curated picks — right in your inbox.
                </p>
                <form class="d-flex gap-2">
                    <input type="email" class="form-control form-control-sm rounded-pill border-0"
                           placeholder="Your email"
                           style="background:rgba(255,255,255,.07); color:#fff; font-size:.8rem; flex:1;">
                    <button class="btn-accent-ae" type="submit" style="padding:.4rem 1rem; font-size:.72rem; border-radius:100px; white-space:nowrap;">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <span>&copy; {{ date('Y') }} Authentic Eclectics. All rights reserved.</span>
            <div>
                @auth
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('footer-logout').submit();"
                       style="color:rgba(255,255,255,.3); font-size:.72rem;">Sign Out</a>
                    <form id="footer-logout" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    @if(auth()->user()->is_admin)
                        &nbsp; <a href="{{ route('admin.dashboard') }}" style="color:var(--ae-accent); font-size:.72rem;">Admin Panel</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" style="color:rgba(255,255,255,.3); font-size:.72rem;">Sign In</a>
                @endauth
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
