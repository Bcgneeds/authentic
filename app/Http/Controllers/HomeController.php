<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $featuredProducts = Product::active()->featured()->with('category')->take(8)->get();
        $latestProducts = Product::active()->with('category')->latest()->take(4)->get();

        return view('home', compact('categories', 'featuredProducts', 'latestProducts'));
    }
}
