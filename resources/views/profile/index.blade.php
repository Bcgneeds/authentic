@extends('layouts.app')

@section('title', 'My Account — Authentic Eclectics')

@section('content')

<div class="page-crumb">
    <div class="container">
        <nav><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">My Account</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">

        {{-- Sidebar --}}
        <div class="col-lg-3">
            <div style="position:sticky; top:80px;">
                <div style="background:#fff; border:1px solid var(--ae-border); border-radius:10px; padding:1.5rem; text-align:center;">
                    <div style="width:64px; height:64px; border-radius:50%; background:var(--ae-dark); color:#fff; display:flex; align-items:center; justify-content:center; font-size:1.4rem; font-weight:700; margin:0 auto 1rem;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div style="font-weight:600; font-size:.95rem;">{{ auth()->user()->name }}</div>
                    <div style="font-size:.78rem; color:var(--ae-muted); margin-top:.2rem;">{{ auth()->user()->email }}</div>
                </div>

                <div style="margin-top:1rem; background:#fff; border:1px solid var(--ae-border); border-radius:10px; overflow:hidden;">
                    <a href="{{ route('profile') }}" style="display:flex; align-items:center; gap:.7rem; padding:.8rem 1.2rem; font-size:.84rem; font-weight:500; color:var(--ae-dark); border-left:3px solid var(--ae-accent); background:rgba(0,0,0,.02); text-decoration:none;">
                        <i class="bi bi-receipt"></i> My Orders
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="display:flex; align-items:center; gap:.7rem; padding:.8rem 1.2rem; font-size:.84rem; font-weight:500; color:var(--ae-muted); background:none; border:none; width:100%; cursor:pointer; text-align:left;">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Main --}}
        <div class="col-lg-9">
            <h1 class="serif fw-bold mb-1" style="font-size:1.6rem;">My Orders</h1>
            <p style="font-size:.82rem; color:var(--ae-muted); margin-bottom:2rem;">
                {{ $orders->count() }} {{ Str::plural('order', $orders->count()) }}
            </p>

            @if($orders->isEmpty())
                <div style="text-align:center; padding:4rem 0;">
                    <i class="bi bi-bag-x" style="font-size:3rem; color:var(--ae-border);"></i>
                    <h5 class="serif mt-3 mb-2">No orders yet</h5>
                    <p style="font-size:.85rem; color:var(--ae-muted);">Head to the shop and place your first order.</p>
                    <a href="{{ route('shop') }}" class="btn-primary-ae mt-3">Browse Shop</a>
                </div>
            @else
                <div style="display:flex; flex-direction:column; gap:1rem;">
                    @foreach($orders as $order)
                    <div style="background:#fff; border:1px solid var(--ae-border); border-radius:10px; padding:1.4rem 1.5rem;">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                            <div>
                                <div style="font-weight:600; font-size:.9rem;">Order #{{ $order->order_number }}</div>
                                <div style="font-size:.75rem; color:var(--ae-muted); margin-top:.15rem;">
                                    {{ $order->created_at->format('d M Y') }}
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <span style="font-weight:700; font-size:.95rem;">${{ number_format($order->total, 2) }}</span>
                                <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>
                        <div style="font-size:.8rem; color:var(--ae-muted); border-top:1px solid var(--ae-border); padding-top:.8rem;">
                            {{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}
                            &mdash;
                            {{ $order->items->pluck('product_name')->take(3)->implode(', ') }}{{ $order->items->count() > 3 ? '…' : '' }}
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>

@endsection
