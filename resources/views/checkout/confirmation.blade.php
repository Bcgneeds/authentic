@extends('layouts.app')

@section('title', 'Order Confirmed — Authentic Eclectics')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 text-center">
            <div class="mb-4">
                <div style="width:80px;height:80px;border-radius:50%;background:#e8f5e9;display:flex;align-items:center;justify-content:center;margin:0 auto;">
                    <i class="bi bi-check-lg text-success" style="font-size:2.5rem;"></i>
                </div>
            </div>
            <h1 class="serif fw-bold mb-2" style="font-size:2rem;">Order Confirmed!</h1>
            <p class="text-muted mb-1">Thank you, <strong>{{ $order->full_name }}</strong>. Your order has been placed.</p>
            <div class="mb-5">
                <span class="badge px-3 py-2" style="background:var(--ae-cream);color:var(--ae-gold);font-size:.85rem;font-weight:600;border:1px solid var(--ae-gold);border-radius:2px;">
                    Order #{{ $order->order_number }}
                </span>
            </div>

            <div style="border:1px solid var(--ae-border);border-radius:4px;padding:2rem;text-align:left;" class="mb-4">
                <h5 class="serif fw-bold mb-4">Order Details</h5>

                @foreach($order->items as $item)
                <div class="d-flex justify-content-between align-items-center py-2 {{ !$loop->last ? 'border-bottom' : '' }}"
                     style="border-color:var(--ae-border);">
                    <div>
                        <div style="font-size:.9rem;font-weight:600;">{{ $item->product_name }}</div>
                        <div class="text-muted" style="font-size:.78rem;">Qty: {{ $item->quantity }}</div>
                    </div>
                    <div class="fw-semibold">${{ number_format($item->total, 2) }}</div>
                </div>
                @endforeach

                <div class="mt-4 pt-3" style="border-top:2px solid var(--ae-border);">
                    <div class="d-flex justify-content-between mb-1" style="font-size:.88rem;">
                        <span class="text-muted">Subtotal</span>
                        <span>${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2" style="font-size:.88rem;">
                        <span class="text-muted">Shipping</span>
                        <span>{{ $order->shipping > 0 ? '$'.number_format($order->shipping,2) : 'Free' }}</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold">
                        <span class="serif">Total</span>
                        <span style="font-size:1.1rem;">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-5 text-start">
                <div class="col-md-6">
                    <div style="border:1px solid var(--ae-border);border-radius:4px;padding:1.2rem;">
                        <div class="fw-semibold mb-2" style="font-size:.82rem;letter-spacing:.06em;text-transform:uppercase;color:var(--ae-muted);">Shipping To</div>
                        <div style="font-size:.88rem;line-height:1.8;">
                            {{ $order->full_name }}<br>
                            {{ $order->address }}<br>
                            {{ $order->city }}{{ $order->state ? ', '.$order->state : '' }}<br>
                            {{ $order->country }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="border:1px solid var(--ae-border);border-radius:4px;padding:1.2rem;">
                        <div class="fw-semibold mb-2" style="font-size:.82rem;letter-spacing:.06em;text-transform:uppercase;color:var(--ae-muted);">Payment</div>
                        <div style="font-size:.88rem;line-height:1.8;">
                            {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Bank Transfer' }}<br>
                            <span class="badge bg-warning text-dark mt-1" style="font-size:.72rem;">Pending</span>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-muted mb-4" style="font-size:.88rem;">
                A confirmation email has been sent to <strong>{{ $order->email }}</strong>.
            </p>

            <div class="d-flex gap-3 justify-content-center">
                <a href="{{ route('home') }}" class="btn-dark-ae btn">Back to Home</a>
                <a href="{{ route('shop') }}" class="btn-outline-gold btn">Continue Shopping</a>
            </div>
        </div>
    </div>
</div>
@endsection
