@extends('layouts.admin')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('topbar-actions')
    <a href="{{ route('admin.products.index') }}" class="btn btn-light btn-sm border">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
@endsection

@section('content')
<div class="row justify-content-center">
<div class="col-lg-9">

    @if($errors->any())
    <div class="alert alert-danger py-2 mb-4" style="font-size:.83rem;border-radius:6px;">
        <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    {{-- ── SAVE FORM ── --}}
    <div class="admin-card mb-3">
        <form id="editForm" action="{{ route('admin.products.update', $product) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Product Name *</label>
                        <input type="text" name="name" class="form-control rounded-1"
                               value="{{ old('name', $product->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Short Description</label>
                        <input type="text" name="short_description" class="form-control rounded-1"
                               value="{{ old('short_description', $product->short_description) }}" maxlength="500">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Full Description</label>
                        <textarea name="description" class="form-control rounded-1" rows="5">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image URL</label>
                        <input type="url" name="image" class="form-control rounded-1"
                               value="{{ old('image', $product->image) }}" placeholder="https://...">
                        @if($product->image)
                            <img src="{{ $product->image }}" class="mt-2 rounded-1"
                                 style="height:80px;object-fit:cover;border:1px solid #e5e7eb;" alt="">
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Category *</label>
                        <select name="category_id" class="form-select rounded-1" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Regular Price ($) *</label>
                        <input type="number" name="price" class="form-control rounded-1" step="0.01" min="0"
                               value="{{ old('price', $product->price) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sale Price ($) <span class="text-muted fw-normal">(optional)</span></label>
                        <input type="number" name="sale_price" class="form-control rounded-1" step="0.01" min="0"
                               value="{{ old('sale_price', $product->sale_price) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock Quantity *</label>
                        <input type="number" name="stock" class="form-control rounded-1" min="0"
                               value="{{ old('stock', $product->stock) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select rounded-1">
                            <option value="active"   {{ old('status', $product->status) == 'active'   ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <div class="form-check">
                            <input type="checkbox" name="featured" id="featured" class="form-check-input"
                                   {{ old('featured', $product->featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured" style="font-size:.85rem;">Mark as Featured</label>
                        </div>
                    </div>

                    <button type="submit" class="btn-ae-gold btn w-100">
                        <i class="bi bi-check-lg me-1"></i> Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- ── DELETE FORM — completely separate, outside the save form ── --}}
    <div class="admin-card" style="border-color:#fee2e2;">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <div class="fw-semibold text-danger" style="font-size:.88rem;">Delete Product</div>
                <div class="text-muted" style="font-size:.78rem;">This action is permanent and cannot be undone.</div>
            </div>
            <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                  onsubmit="return confirm('Permanently delete \'{{ $product->name }}\'? This cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm px-3" style="font-size:.8rem;">
                    <i class="bi bi-trash3 me-1"></i> Delete Product
                </button>
            </form>
        </div>
    </div>

</div>
</div>
@endsection
