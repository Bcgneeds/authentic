<?php

namespace App\Http\Controllers;

use App\Models\Order;

class ProfileController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->with('items')
            ->get();

        return view('profile.index', compact('orders'));
    }
}
