@extends('layouts.admin')

@section('title', 'Add Product')
@section('page-title', 'Add Product')

@section('topbar-actions')
    <a href="{{ route('admin.products.index') }}" class="btn btn-light btn-sm border">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
@endsection

@section('content')
<div class="row justify-content-center">
<div class="col-lg-9">
<div class="admin-card">
    @if($errors->any())
    <div class="alert alert-danger py-2 mb-4" style="font-size:.83rem;border-radius:6px;">
        <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Product Name *</label>
                    <input type="text" name="name" class="form-control rounded-1" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Short Description</label>
                    <input type="text" name="short_description" class="form-control rounded-1"
                           value="{{ old('short_description') }}" maxlength="500" placeholder="One-line summary">
                </div>
                <div class="mb-3">
                    <label class="form-label">Full Description</label>
                    <textarea name="description" class="form-control rounded-1" rows="5"
                              placeholder="Detailed product description...">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image URL</label>
                    <input type="url" name="image" class="form-control rounded-1" value="{{ old('image') }}"
                           placeholder="https://...">
                    <div class="form-text" style="font-size:.75rem;">Paste a direct image URL (HTTPS recommended).</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Category *</label>
                    <select name="category_id" class="form-select rounded-1" required>
                        <option value="">Select category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Regular Price ($) *</label>
                    <input type="number" name="price" class="form-control rounded-1" step="0.01" min="0"
                           value="{{ old('price') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sale Price ($) <span class="text-muted fw-normal">(optional)</span></label>
                    <input type="number" name="sale_price" class="form-control rounded-1" step="0.01" min="0"
                           value="{{ old('sale_price') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Stock Quantity *</label>
                    <input type="number" name="stock" class="form-control rounded-1" min="0"
                           value="{{ old('stock', 0) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select rounded-1">
                        <option value="active" {{ old('status','active')=='active'?'selected':'' }}>Active</option>
                        <option value="inactive" {{ old('status')=='inactive'?'selected':'' }}>Inactive</option>
                    </select>
                </div>
                <div class="mb-4">
                    <div class="form-check">
                        <input type="checkbox" name="featured" id="featured" class="form-check-input"
                               style="accent-color:var(--ae-gold);" {{ old('featured') ? 'checked' : '' }}>
                        <label class="form-check-label" for="featured" style="font-size:.85rem;">Mark as Featured</label>
                    </div>
                </div>
                <button type="submit" class="btn-ae-gold btn w-100">
                    <i class="bi bi-plus-lg me-1"></i> Create Product
                </button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
@endsection
