@extends('layouts.admin')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')

@section('topbar-actions')
    <a href="{{ route('admin.categories.index') }}" class="btn btn-light btn-sm border">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
@endsection

@section('content')
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="admin-card">
    @if($errors->any())
    <div class="alert alert-danger py-2 mb-4" style="font-size:.83rem;border-radius:6px;">
        <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Category Name *</label>
            <input type="text" name="name" class="form-control rounded-1" value="{{ old('name', $category->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Image URL</label>
            <input type="url" name="image" class="form-control rounded-1" value="{{ old('image', $category->image) }}">
            @if($category->image)
            <img src="{{ $category->image }}" class="mt-2 rounded-1" style="height:80px;object-fit:cover;border:1px solid #e5e7eb;" alt="">
            @endif
        </div>
        <div class="mb-4">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control rounded-1" rows="3">{{ old('description', $category->description) }}</textarea>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn-ae-gold btn flex-grow-1">
                <i class="bi bi-check-lg me-1"></i> Save Changes
            </button>
            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                  onsubmit="return confirm('Delete this category?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-light border text-danger" style="font-size:.82rem;">
                    <i class="bi bi-trash3"></i>
                </button>
            </form>
        </div>
    </form>
</div>
</div>
</div>
@endsection
