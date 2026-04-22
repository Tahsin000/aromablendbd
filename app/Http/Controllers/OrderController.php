<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $products = $this->getProducts();
        $cartItems = [];

        // Support single product or cart array
        if ($request->filled('product_id')) {
            $product = $products[$request->input('product_id')] ?? null;
            if ($product) {
                $qty = max(1, (int) $request->input('quantity', 1));
                $cartItems[] = [
                    ...$product,
                    'quantity' => $qty,
                    'line_total' => $product['price'] * $qty,
                ];
            }
        }

        return Inertia::render('Checkout', [
            'products' => $products,
            'cartItems' => $cartItems,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'city' => 'required|string|in:chittagong,outside',
            'payment_method' => 'required|string|in:cod,bkash,nagad',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'coupon_code' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:500',
        ]);

        $deliveryCharge = $validated['city'] === 'chittagong' ? 60 : 120;

        $subtotal = collect($validated['items'])->sum(function ($item) {
            return $item['unit_price'] * $item['quantity'];
        });

        // First order 20% discount
        $discount = $subtotal * 0.20;
        $total = $subtotal - $discount + $deliveryCharge;

        $order = Order::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'address' => $validated['address'],
            'city' => $validated['city'],
            'delivery_charge' => $deliveryCharge,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
            'coupon_code' => $validated['coupon_code'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        $products = $this->getProducts();

        foreach ($validated['items'] as $item) {
            $product = $products[$item['product_id']] ?? null;
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $product ? $product['name'] : $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'original_price' => $product ? $product['original_price'] : $item['unit_price'],
                'line_total' => $item['unit_price'] * $item['quantity'],
            ]);
        }

        return redirect()->route('landing')->with('success', 'অর্ডার সফলভাবে সম্পন্ন হয়েছে!');
    }

    private function getProducts(): array
    {
        return config('products');
    }
}
