@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef3c7;">
                <i class="bi bi-receipt" style="color:#d97706;"></i>
            </div>
            <div>
                <div class="stat-num">{{ $stats['orders'] }}</div>
                <div class="stat-label">Total Orders</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#d1fae5;">
                <i class="bi bi-currency-dollar" style="color:#059669;"></i>
            </div>
            <div>
                <div class="stat-num">${{ number_format($stats['revenue'], 0) }}</div>
                <div class="stat-label">Revenue</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dbeafe;">
                <i class="bi bi-box-seam" style="color:#2563eb;"></i>
            </div>
            <div>
                <div class="stat-num">{{ $stats['products'] }}</div>
                <div class="stat-label">Products</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fce7f3;">
                <i class="bi bi-clock-history" style="color:#db2777;"></i>
            </div>
            <div>
                <div class="stat-num">{{ $stats['pending'] }}</div>
                <div class="stat-label">Pending Orders</div>
            </div>
        </div>
    </div>
</div>

{{-- Recent Orders --}}
<div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="serif fw-bold mb-0">Recent Orders</h5>
        <a href="{{ route('admin.orders.index') }}" class="btn-ae-outline btn">View All</a>
    </div>

    @if($recentOrders->isEmpty())
        <p class="text-muted text-center py-4">No orders yet.</p>
    @else
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr>
                    <td class="fw-semibold text-dark">{{ $order->order_number }}</td>
                    <td>{{ $order->full_name }}<br><span class="text-muted" style="font-size:.75rem;">{{ $order->email }}</span></td>
                    <td>{{ $order->items->count() }} item(s)</td>
                    <td class="fw-semibold">${{ number_format($order->total, 2) }}</td>
                    <td>
                        <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td class="text-muted" style="font-size:.78rem;">{{ $order->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-light btn-sm border" style="font-size:.75rem;">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@endsection
