@extends('layouts.admin')

@section('title', 'Products')
@section('page-title', 'Products')

@section('topbar-actions')
    <a href="{{ route('admin.products.create') }}" class="btn-ae-gold btn">
        <i class="bi bi-plus-lg me-1"></i> Add Product
    </a>
@endsection

@section('content')
<div class="admin-card">
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th width="60">Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th width="120">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        <img src="{{ $product->image ?? 'https://picsum.photos/seed/a'.$product->id.'/60/60' }}"
                             style="width:46px;height:46px;object-fit:cover;border-radius:6px;border:1px solid #e5e7eb;"
                             alt="{{ $product->name }}">
                    </td>
                    <td>
                        <div class="fw-semibold text-dark" style="font-size:.85rem;">{{ $product->name }}</div>
                        <div class="text-muted" style="font-size:.72rem;">{{ $product->slug }}</div>
                    </td>
                    <td><span style="font-size:.8rem;">{{ $product->category->name }}</span></td>
                    <td>
                        <div class="fw-semibold" style="font-size:.85rem;">${{ number_format($product->current_price, 2) }}</div>
                        @if($product->is_on_sale)
                            <div class="text-muted" style="font-size:.72rem;text-decoration:line-through;">${{ number_format($product->price, 2) }}</div>
                        @endif
                    </td>
                    <td>
                        <span class="{{ $product->stock > 0 ? 'text-success' : 'text-danger' }} fw-semibold" style="font-size:.83rem;">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td>
                        <span class="status-badge {{ $product->status === 'active' ? 'status-delivered' : 'status-cancelled' }}">
                            {{ ucfirst($product->status) }}
                        </span>
                    </td>
                    <td>
                        @if($product->featured)
                            <i class="bi bi-star-fill" style="color:var(--ae-gold);"></i>
                        @else
                            <i class="bi bi-star text-muted"></i>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.products.edit', $product) }}"
                               class="btn btn-sm btn-light border" title="Edit" style="font-size:.75rem;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                  onsubmit="return confirm('Delete this product?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border text-danger" title="Delete" style="font-size:.75rem;">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center py-4 text-muted">No products yet. <a href="{{ route('admin.products.create') }}">Add one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
