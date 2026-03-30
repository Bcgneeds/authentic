@extends('layouts.admin')

@section('title', 'Order ' . $order->order_number)
@section('page-title', 'Order Details')

@section('topbar-actions')
    <a href="{{ route('admin.orders.index') }}" class="btn btn-light btn-sm border">
        <i class="bi bi-arrow-left me-1"></i> Back to Orders
    </a>
@endsection

@section('content')
<div class="row g-4">

    {{-- Order Items --}}
    <div class="col-lg-8">
        <div class="admin-card mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 class="serif fw-bold mb-0">{{ $order->order_number }}</h5>
                    <div class="text-muted" style="font-size:.78rem;">{{ $order->created_at->format('F d, Y — h:i A') }}</div>
                </div>
                <span class="status-badge status-{{ $order->status }} px-3 py-2" style="font-size:.78rem;">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($item->product && $item->product->image)
                                <img src="{{ $item->product->image }}"
                                     style="width:42px;height:42px;object-fit:cover;border-radius:4px;border:1px solid #e5e7eb;"
                                     alt="{{ $item->product_name }}">
                                @endif
                                <div class="fw-semibold" style="font-size:.83rem;">{{ $item->product_name }}</div>
                            </div>
                        </td>
                        <td style="font-size:.83rem;">${{ number_format($item->price, 2) }}</td>
                        <td style="font-size:.83rem;">{{ $item->quantity }}</td>
                        <td class="text-end fw-semibold" style="font-size:.83rem;">${{ number_format($item->total, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end text-muted" style="font-size:.82rem;">Subtotal</td>
                        <td class="text-end fw-semibold" style="font-size:.83rem;">${{ number_format($order->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end text-muted" style="font-size:.82rem;">Shipping</td>
                        <td class="text-end" style="font-size:.83rem;">{{ $order->shipping > 0 ? '$'.number_format($order->shipping,2) : 'Free' }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end fw-bold serif" style="font-size:.9rem;">Total</td>
                        <td class="text-end fw-bold" style="font-size:.95rem;">${{ number_format($order->total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4">

        {{-- Update Status --}}
        <div class="admin-card mb-3">
            <h6 class="serif fw-bold mb-3">Update Status</h6>
            <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                @csrf
                <select name="status" class="form-select form-select-sm rounded-1 mb-3">
                    @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                    <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-ae-gold btn w-100 btn-sm">Update Status</button>
            </form>
        </div>

        {{-- Customer Info --}}
        <div class="admin-card mb-3">
            <h6 class="serif fw-bold mb-3">Customer</h6>
            <div style="font-size:.83rem; line-height:2;">
                <div class="fw-semibold">{{ $order->full_name }}</div>
                <div class="text-muted">{{ $order->email }}</div>
                @if($order->phone)<div class="text-muted">{{ $order->phone }}</div>@endif
            </div>
        </div>

        {{-- Shipping --}}
        <div class="admin-card mb-3">
            <h6 class="serif fw-bold mb-3">Shipping Address</h6>
            <div style="font-size:.83rem; line-height:1.9; color:#4b5563;">
                {{ $order->address }}<br>
                {{ $order->city }}{{ $order->state ? ', '.$order->state : '' }}{{ $order->zip ? ' '.$order->zip : '' }}<br>
                {{ $order->country }}
            </div>
        </div>

        {{-- Payment --}}
        <div class="admin-card">
            <h6 class="serif fw-bold mb-3">Payment</h6>
            <div style="font-size:.83rem; color:#4b5563;">
                {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Bank Transfer' }}
            </div>
            @if($order->notes)
            <div class="mt-3 pt-3" style="border-top:1px solid #e5e7eb;">
                <div class="text-muted" style="font-size:.75rem; text-transform:uppercase; letter-spacing:.06em; margin-bottom:.3rem;">Notes</div>
                <div style="font-size:.82rem;">{{ $order->notes }}</div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
