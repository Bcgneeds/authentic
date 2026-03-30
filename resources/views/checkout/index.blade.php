@extends('layouts.app')

@section('title', 'Checkout — Authentic Eclectics')

@section('content')

<div class="breadcrumb-ae">
    <div class="container">
        <nav><ol class="breadcrumb mb-0" style="font-size:.82rem;">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
            <li class="breadcrumb-item active">Checkout</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">
    <h1 class="serif fw-bold mb-5" style="font-size:2rem;">Checkout</h1>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="row g-5">

            {{-- ── Shipping Details ── --}}
            <div class="col-lg-7">
                <h5 class="serif fw-bold mb-4 pb-2" style="border-bottom:2px solid var(--ae-gold); display:inline-block;">
                    Shipping Information
                </h5>

                @if($errors->any())
                <div class="alert alert-danger py-2 mb-4">
                    <ul class="mb-0 ps-3" style="font-size:.85rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label small fw-semibold">First Name *</label>
                        <input type="text" name="first_name" class="form-control rounded-1"
                               value="{{ old('first_name', auth()->user()->name ?? '') }}" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label small fw-semibold">Last Name *</label>
                        <input type="text" name="last_name" class="form-control rounded-1" value="{{ old('last_name') }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-semibold">Email Address *</label>
                        <input type="email" name="email" class="form-control rounded-1"
                               value="{{ old('email', auth()->user()->email ?? '') }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-semibold">Phone Number</label>
                        <input type="tel" name="phone" class="form-control rounded-1" value="{{ old('phone') }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-semibold">Street Address *</label>
                        <input type="text" name="address" class="form-control rounded-1" value="{{ old('address') }}" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label small fw-semibold">City *</label>
                        <input type="text" name="city" class="form-control rounded-1" value="{{ old('city') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">State</label>
                        <input type="text" name="state" class="form-control rounded-1" value="{{ old('state') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold">ZIP Code</label>
                        <input type="text" name="zip" class="form-control rounded-1" value="{{ old('zip') }}">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="form-label small fw-semibold">Order Notes (optional)</label>
                    <textarea name="notes" class="form-control rounded-1" rows="3"
                              placeholder="Any special instructions...">{{ old('notes') }}</textarea>
                </div>

                {{-- Payment --}}
                <div class="mt-5">
                    <h5 class="serif fw-bold mb-4 pb-2" style="border-bottom:2px solid var(--ae-gold); display:inline-block;">
                        Payment Method
                    </h5>
                    <div class="d-flex flex-column gap-3">
                        <label class="d-flex gap-3 align-items-start p-3 rounded-1 cursor-pointer"
                               style="border:2px solid var(--ae-border); cursor:pointer; transition:.2s;"
                               onclick="this.style.borderColor='var(--ae-gold)'">
                            <input type="radio" name="payment_method" value="cod" {{ old('payment_method','cod')=='cod'?'checked':'' }}
                                   class="mt-1 flex-shrink-0" style="accent-color:var(--ae-gold);">
                            <div>
                                <div class="fw-semibold" style="font-size:.9rem;"><i class="bi bi-cash-stack me-2 text-gold"></i>Cash on Delivery</div>
                                <div class="text-muted" style="font-size:.78rem;">Pay when your order arrives.</div>
                            </div>
                        </label>
                        <label class="d-flex gap-3 align-items-start p-3 rounded-1"
                               style="border:2px solid var(--ae-border); cursor:pointer; transition:.2s;"
                               onclick="this.style.borderColor='var(--ae-gold)'">
                            <input type="radio" name="payment_method" value="bank_transfer" {{ old('payment_method')=='bank_transfer'?'checked':'' }}
                                   class="mt-1 flex-shrink-0" style="accent-color:var(--ae-gold);">
                            <div>
                                <div class="fw-semibold" style="font-size:.9rem;"><i class="bi bi-bank me-2 text-gold"></i>Bank Transfer</div>
                                <div class="text-muted" style="font-size:.78rem;">We'll send bank details after you place the order.</div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- ── Order Summary ── --}}
            <div class="col-lg-5">
                <div style="border:1px solid var(--ae-border); border-radius:4px; padding:1.6rem; position:sticky; top:80px;">
                    <h5 class="serif fw-bold mb-4">Order Summary</h5>

                    <div style="max-height:280px; overflow-y:auto;">
                        @foreach($cart as $id => $item)
                        <div class="d-flex gap-3 align-items-center mb-3">
                            <img src="{{ $item['image'] ?? 'https://picsum.photos/seed/co'.$id.'/80/80' }}"
                                 style="width:54px;height:54px;object-fit:cover;border-radius:3px;border:1px solid var(--ae-border);"
                                 alt="{{ $item['name'] }}">
                            <div class="flex-grow-1">
                                <div style="font-size:.82rem; font-weight:600; line-height:1.3;">{{ $item['name'] }}</div>
                                <div class="text-muted" style="font-size:.75rem;">Qty: {{ $item['quantity'] }}</div>
                            </div>
                            <div class="fw-semibold" style="font-size:.88rem;">
                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <hr style="border-color:var(--ae-border);">

                    <div class="d-flex justify-content-between mb-2" style="font-size:.88rem;">
                        <span class="text-muted">Subtotal</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3" style="font-size:.88rem;">
                        <span class="text-muted">Shipping</span>
                        @if($shipping == 0)
                            <span class="text-success fw-semibold">Free</span>
                        @else
                            <span>${{ number_format($shipping, 2) }}</span>
                        @endif
                    </div>

                    <hr style="border-color:var(--ae-border);">
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold serif">Total</span>
                        <span class="fw-bold" style="font-size:1.25rem;">${{ number_format($total, 2) }}</span>
                    </div>

                    <button type="submit" class="btn-gold btn w-100 btn-lg">
                        <i class="bi bi-bag-check me-2"></i> Place Order
                    </button>
                    <div class="text-center mt-3" style="font-size:.72rem; color:var(--ae-muted);">
                        <i class="bi bi-shield-lock me-1"></i> Your information is secure & encrypted
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

@endsection
