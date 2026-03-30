@extends('layouts.admin')

@section('title', 'Orders')
@section('page-title', 'Orders')

@section('content')

{{-- Filter tabs --}}
<div class="d-flex gap-2 mb-4 flex-wrap">
    @foreach(['all' => 'All', 'pending' => 'Pending', 'processing' => 'Processing', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'] as $val => $label)
    <a href="{{ $val === 'all' ? route('admin.orders.index') : route('admin.orders.index', ['status' => $val]) }}"
       class="btn btn-sm {{ (request('status') === $val || ($val === 'all' && !request('status'))) ? 'btn-dark' : 'btn-light border' }}"
       style="font-size:.78rem; border-radius:20px;">
        {{ $label }}
    </a>
    @endforeach
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th width="80"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="fw-semibold text-dark" style="font-size:.82rem;">{{ $order->order_number }}</td>
                    <td>
                        <div style="font-size:.83rem; font-weight:500;">{{ $order->full_name }}</div>
                        <div class="text-muted" style="font-size:.73rem;">{{ $order->email }}</div>
                    </td>
                    <td class="text-muted" style="font-size:.78rem;">{{ $order->created_at->format('M d, Y') }}<br>{{ $order->created_at->format('h:i A') }}</td>
                    <td style="font-size:.82rem;">{{ $order->items->count() }}</td>
                    <td class="fw-semibold" style="font-size:.85rem;">${{ number_format($order->total, 2) }}</td>
                    <td style="font-size:.78rem; text-transform:capitalize;">{{ str_replace('_', ' ', $order->payment_method) }}</td>
                    <td>
                        <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}"
                           class="btn btn-sm btn-light border" style="font-size:.75rem;">View</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center py-4 text-muted">No orders found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
