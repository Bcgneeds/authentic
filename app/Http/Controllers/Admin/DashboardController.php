<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'orders'     => Order::count(),
            'products'   => Product::count(),
            'categories' => Category::count(),
            'users'      => User::where('is_admin', false)->count(),
            'revenue'    => Order::whereIn('status', ['delivered', 'processing', 'shipped'])->sum('total'),
            'pending'    => Order::where('status', 'pending')->count(),
        ];

        $recentOrders = Order::with('items')->latest()->take(8)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
