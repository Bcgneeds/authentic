@extends('layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('topbar-actions')
    <a href="{{ route('admin.categories.create') }}" class="btn-ae-gold btn">
        <i class="bi bi-plus-lg me-1"></i> Add Category
    </a>
@endsection

@section('content')
<div class="admin-card">
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th width="70">Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Products</th>
                    <th>Description</th>
                    <th width="120">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>
                        <img src="{{ $category->image ?? 'https://picsum.photos/seed/cat'.$category->id.'/60/60' }}"
                             style="width:46px;height:46px;object-fit:cover;border-radius:6px;border:1px solid #e5e7eb;"
                             alt="{{ $category->name }}">
                    </td>
                    <td class="fw-semibold text-dark" style="font-size:.85rem;">{{ $category->name }}</td>
                    <td class="text-muted" style="font-size:.78rem;">{{ $category->slug }}</td>
                    <td>
                        <span class="badge" style="background:#dbeafe;color:#2563eb;font-size:.72rem;">
                            {{ $category->products_count }} products
                        </span>
                    </td>
                    <td class="text-muted" style="font-size:.8rem;">{{ Str::limit($category->description, 60) }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="btn btn-sm btn-light border" style="font-size:.75rem;" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                  onsubmit="return confirm('Delete this category? All products will also be deleted.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border text-danger" style="font-size:.75rem;" title="Delete">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">No categories yet. <a href="{{ route('admin.categories.create') }}">Add one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
