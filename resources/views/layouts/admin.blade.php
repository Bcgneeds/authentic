<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Authentic Eclectics</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --ae-gold: #1E40AF;
            --ae-gold-dark: #1D4ED8;
            --sidebar-bg: #111827;
            --sidebar-w: 250px;
        }
        body { font-family: 'DM Sans', sans-serif; background: #F3F4F6; color: #1f2937; }
        h1,h2,h3,h4,h5,.serif { font-family: 'Cormorant Garamond', serif; }

        /* Sidebar */
        .admin-sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            z-index: 1000;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        .sidebar-logo {
            padding: 1.5rem 1.4rem;
            border-bottom: 1px solid #1f2937;
        }
        .sidebar-logo .brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: #fff;
        }
        .sidebar-logo .brand span { color: var(--ae-gold); }
        .sidebar-logo small { color: #6b7280; font-size: .68rem; letter-spacing: .08em; text-transform: uppercase; }

        .sidebar-nav { flex: 1; padding: 1rem 0; }
        .sidebar-section {
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: #4b5563;
            padding: .8rem 1.4rem .3rem;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: .6rem 1.4rem;
            color: #9ca3af;
            font-size: .83rem;
            font-weight: 500;
            text-decoration: none;
            transition: all .2s;
            border-left: 3px solid transparent;
        }
        .sidebar-link i { font-size: .95rem; width: 18px; text-align: center; }
        .sidebar-link:hover { color: #fff; background: rgba(255,255,255,.05); }
        .sidebar-link.active {
            color: var(--ae-gold);
            background: rgba(201,168,76,.08);
            border-left-color: var(--ae-gold);
        }
        .sidebar-footer {
            padding: 1rem 1.4rem;
            border-top: 1px solid #1f2937;
        }

        /* Main */
        .admin-main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: .9rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .admin-topbar .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }
        .admin-content { flex: 1; padding: 2rem 1.5rem; }

        /* Cards */
        .admin-card {
            background: #fff;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            padding: 1.5rem;
        }
        .stat-card {
            background: #fff;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            padding: 1.4rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .stat-icon {
            width: 50px; height: 50px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        .stat-num { font-size: 1.6rem; font-weight: 700; line-height: 1; color: #111827; }
        .stat-label { font-size: .75rem; color: #6b7280; margin-top: 2px; }

        /* Buttons */
        .btn-ae-gold { background: var(--ae-gold); color: #fff; border: none; font-size: .82rem; font-weight: 600; padding: .45rem 1.1rem; border-radius: 6px; transition: .2s; }
        .btn-ae-gold:hover { background: var(--ae-gold-dark); color: #fff; }
        .btn-ae-outline { background: transparent; color: var(--ae-gold); border: 1.5px solid var(--ae-gold); font-size: .82rem; font-weight: 600; padding: .45rem 1.1rem; border-radius: 6px; transition: .2s; }
        .btn-ae-outline:hover { background: var(--ae-gold); color: #fff; }

        /* Table */
        .admin-table { font-size: .83rem; }
        .admin-table th { font-weight: 600; font-size: .72rem; letter-spacing: .04em; text-transform: uppercase; color: #6b7280; background: #f9fafb; border-color: #e5e7eb; }
        .admin-table td { border-color: #f3f4f6; vertical-align: middle; }
        .admin-table tbody tr:hover { background: #f9fafb; }

        /* Form */
        .form-control:focus, .form-select:focus {
            border-color: var(--ae-gold);
            box-shadow: 0 0 0 3px rgba(30,64,175,.15);
        }
        .form-label { font-size: .82rem; font-weight: 600; color: #374151; }

        /* Status badges */
        .status-pending    { background:#fef3c7; color:#d97706; }
        .status-processing { background:#dbeafe; color:#2563eb; }
        .status-shipped    { background:#ede9fe; color:#7c3aed; }
        .status-delivered  { background:#d1fae5; color:#059669; }
        .status-cancelled  { background:#fee2e2; color:#dc2626; }
        .status-badge { font-size:.7rem; font-weight:600; padding:3px 10px; border-radius:20px; text-transform:capitalize; }

        @media (max-width: 991px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-main { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- Sidebar --}}
<aside class="admin-sidebar">
    <div class="sidebar-logo">
        <div class="brand">Authentic <span>Eclectics</span></div>
        <small>Admin Panel</small>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-section">Main</div>
        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>

        <div class="sidebar-section mt-2">Catalogue</div>
        <a href="{{ route('admin.products.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Products
        </a>
        <a href="{{ route('admin.categories.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
            <i class="bi bi-tag"></i> Categories
        </a>

        <div class="sidebar-section mt-2">Orders</div>
        <a href="{{ route('admin.orders.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i> All Orders
        </a>

        <div class="sidebar-section mt-2">Store</div>
        <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
            <i class="bi bi-shop"></i> View Store
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div style="width:32px;height:32px;background:var(--ae-gold);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:700;color:#fff;flex-shrink:0;opacity:.9;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <div style="font-size:.78rem;color:#e5e7eb;font-weight:500;">{{ auth()->user()->name }}</div>
                <div style="font-size:.68rem;color:#6b7280;">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-link w-100 border-0 bg-transparent mt-1 text-start">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</aside>

{{-- Main --}}
<div class="admin-main">
    <div class="admin-topbar">
        <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
        <div class="d-flex align-items-center gap-3">
            @yield('topbar-actions')
            <a href="{{ route('home') }}" target="_blank" class="btn btn-light btn-sm border" style="font-size:.78rem;">
                <i class="bi bi-box-arrow-up-right me-1"></i> View Store
            </a>
        </div>
    </div>

    <div class="admin-content">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show py-2 mb-4" style="font-size:.85rem;border-radius:8px;">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show py-2 mb-4" style="font-size:.85rem;border-radius:8px;">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
