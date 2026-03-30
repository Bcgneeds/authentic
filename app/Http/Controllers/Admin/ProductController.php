<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'name'              => 'required|string|max:255',
            'price'             => 'required|numeric|min:0',
            'sale_price'        => 'nullable|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'status'            => 'required|in:active,inactive',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'image'             => 'nullable|string|max:500',
        ]);

        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        Product::create([
            'category_id'       => $request->category_id,
            'name'              => $request->name,
            'slug'              => $slug,
            'price'             => $request->price,
            'sale_price'        => $request->sale_price ?: null,
            'stock'             => $request->stock,
            'featured'          => $request->boolean('featured'),
            'status'            => $request->status,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'image'             => $request->image,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        return redirect()->route('admin.products.edit', $id);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'name'              => 'required|string|max:255',
            'price'             => 'required|numeric|min:0',
            'sale_price'        => 'nullable|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'status'            => 'required|in:active,inactive',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'image'             => 'nullable|string|max:500',
        ]);

        // Generate a unique slug, excluding the current product
        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $counter = 1;
        while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $product->update([
            'category_id'       => $request->category_id,
            'name'              => $request->name,
            'slug'              => $slug,
            'price'             => $request->price,
            'sale_price'        => $request->sale_price ?: null,
            'stock'             => $request->stock,
            'featured'          => $request->boolean('featured'),
            'status'            => $request->status,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'image'             => $request->image ?: null,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }
}
