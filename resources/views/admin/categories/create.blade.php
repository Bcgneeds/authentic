@extends('layouts.admin')

@section('title', 'Add Category')
@section('page-title', 'Add Category')

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

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Category Name *</label>
            <input type="text" name="name" class="form-control rounded-1" value="{{ old('name') }}" required autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label">Image URL</label>
            <input type="url" name="image" class="form-control rounded-1" value="{{ old('image') }}"
                   placeholder="https://...">
        </div>
        <div class="mb-4">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control rounded-1" rows="3"
                      placeholder="Brief category description...">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn-ae-gold btn w-100">
            <i class="bi bi-plus-lg me-1"></i> Create Category
        </button>
    </form>
</div>
</div>
</div>
@endsection
