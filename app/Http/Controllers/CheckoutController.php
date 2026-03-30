<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $shipping = $subtotal >= 100 ? 0 : 10;
        $total = $subtotal + $shipping;

        return view('checkout.index', compact('cart', 'subtotal', 'shipping', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'     => 'required|string|max:100',
            'last_name'      => 'required|string|max:100',
            'email'          => 'required|email',
            'phone'          => 'nullable|string|max:20',
            'address'        => 'required|string',
            'city'           => 'required|string|max:100',
            'state'          => 'nullable|string|max:100',
            'zip'            => 'nullable|string|max:20',
            'payment_method' => 'required|in:cod,bank_transfer',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $shipping = $subtotal >= 100 ? 0 : 10;
        $total = $subtotal + $shipping;

        $order = Order::create([
            'user_id'        => auth()->id(),
            'order_number'   => 'AE-' . strtoupper(Str::random(8)),
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'city'           => $request->city,
            'state'          => $request->state,
            'zip'            => $request->zip,
            'country'        => $request->get('country', 'Nigeria'),
            'subtotal'       => $subtotal,
            'shipping'       => $shipping,
            'total'          => $total,
            'payment_method' => $request->payment_method,
            'notes'          => $request->notes,
            'status'         => 'pending',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $item['id'],
                'product_name' => $item['name'],
                'price'        => $item['price'],
                'quantity'     => $item['quantity'],
                'total'        => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('checkout.confirmation', $order->order_number);
    }

    public function confirmation($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items')->firstOrFail();

        return view('checkout.confirmation', compact('order'));
    }
}
