@extends('layouts.app')

@section('title', 'Shopping Cart — Authentic Eclectics')

@section('content')

<div class="breadcrumb-ae">
    <div class="container">
        <nav><ol class="breadcrumb mb-0" style="font-size:.82rem;">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Shopping Cart</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">
    <h1 class="serif fw-bold mb-4" style="font-size:2rem;">Shopping Cart
        @if(count($cart) > 0)
            <span class="text-muted fs-5 fw-normal">({{ count($cart) }} {{ Str::plural('item', count($cart)) }})</span>
        @endif
    </h1>

    @if(empty($cart))
        <div class="text-center py-5">
            <i class="bi bi-bag" style="font-size:4rem; color:var(--ae-border);"></i>
            <h4 class="serif mt-4 mb-2">Your cart is empty</h4>
            <p class="text-muted mb-4">Looks like you haven't added anything yet.</p>
            <a href="{{ route('shop') }}" class="btn-gold btn btn-lg">Start Shopping</a>
        </div>
    @else
        <div class="row g-4">

            {{-- ── Cart Items ── --}}
            <div class="col-lg-8">
                <div style="border:1px solid var(--ae-border); border-radius:4px; overflow:hidden;">
                    @foreach($cart as $id => $item)
                    <div class="d-flex gap-3 p-3 align-items-start {{ !$loop->last ? 'border-bottom' : '' }}"
                         style="border-color:var(--ae-border);">

                        {{-- Image --}}
                        <a href="{{ route('shop.show', $item['slug']) }}" class="flex-shrink-0">
                            <img src="{{ $item['image'] ?? 'https://picsum.photos/seed/c'.$id.'/100/100' }}"
                                 alt="{{ $item['name'] }}"
                                 style="width:90px;height:90px;object-fit:cover;border-radius:4px;border:1px solid var(--ae-border);">
                        </a>

                        {{-- Info --}}
                        <div class="flex-grow-1">
                            <a href="{{ route('shop.show', $item['slug']) }}"
                               class="serif fw-semibold text-dark d-block mb-1" style="font-size:.95rem;">
                                {{ $item['name'] }}
                            </a>
                            <div class="text-gold fw-bold mb-2">${{ number_format($item['price'], 2) }}</div>

                            {{-- Qty update --}}
                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center gap-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <button type="button" onclick="adjQty(this,-1)" class="qty-btn-sm">−</button>
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                       min="0" max="99"
                                       class="form-control form-control-sm text-center"
                                       style="width:50px; border-radius:2px; border-color:var(--ae-border);">
                                <button type="button" onclick="adjQty(this,1)" class="qty-btn-sm">+</button>
                                <button type="submit" class="btn btn-link p-0 ms-1 text-muted" style="font-size:.78rem;">Update</button>
                            </form>
                        </div>

                        {{-- Subtotal + Remove --}}
                        <div class="text-end flex-shrink-0">
                            <div class="fw-bold mb-2">${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <button type="submit" class="btn btn-link p-0 text-danger" style="font-size:.78rem;">
                                    <i class="bi bi-trash3"></i> Remove
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-3">
                    <a href="{{ route('shop') }}" class="text-muted" style="font-size:.85rem;">
                        <i class="bi bi-arrow-left me-1"></i> Continue Shopping
                    </a>
                </div>
            </div>

            {{-- ── Summary ── --}}
            <div class="col-lg-4">
                <div style="border:1px solid var(--ae-border); border-radius:4px; padding:1.5rem; position:sticky; top:80px;">
                    <h5 class="serif fw-bold mb-4">Order Summary</h5>

                    @php
                        $shipping = $total >= 100 ? 0 : 10;
                        $grandTotal = $total + $shipping;
                    @endphp

                    <div class="d-flex justify-content-between mb-2" style="font-size:.9rem;">
                        <span class="text-muted">Subtotal</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3" style="font-size:.9rem;">
                        <span class="text-muted">Shipping</span>
                        @if($shipping == 0)
                            <span class="text-success fw-semibold">Free</span>
                        @else
                            <span>${{ number_format($shipping, 2) }}</span>
                        @endif
                    </div>

                    @if($shipping > 0)
                    <div class="mb-3 p-2 rounded-1" style="background:var(--ae-cream); font-size:.78rem; color:var(--ae-muted);">
                        <i class="bi bi-truck me-1 text-gold"></i>
                        Add ${{ number_format(100 - $total, 2) }} more for free shipping!
                    </div>
                    @endif

                    <hr style="border-color:var(--ae-border);">
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold serif">Total</span>
                        <span class="fw-bold" style="font-size:1.2rem;">${{ number_format($grandTotal, 2) }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn-gold btn w-100 mb-2">
                        <i class="bi bi-lock me-2"></i> Proceed to Checkout
                    </a>

                    <div class="text-center mt-3" style="font-size:.75rem; color:var(--ae-muted);">
                        <i class="bi bi-shield-lock me-1"></i> Secure & encrypted checkout
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('styles')
<style>
.qty-btn-sm {
    width:28px; height:28px; border:1px solid var(--ae-border);
    background:#fff; border-radius:2px; cursor:pointer; font-size:.9rem;
    display:flex; align-items:center; justify-content:center;
    transition: all .2s;
}
.qty-btn-sm:hover { background:var(--ae-dark); color:#fff; border-color:var(--ae-dark); }
</style>
@endpush

@push('scripts')
<script>
function adjQty(btn, delta) {
    const form = btn.closest('form');
    const input = form.querySelector('input[type=number]');
    input.value = Math.max(0, parseInt(input.value) + delta);
}
</script>
@endpush

@endsection
