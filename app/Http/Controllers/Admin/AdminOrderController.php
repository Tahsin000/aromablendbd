<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(15);
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

        return view('admin.ecommerce.orders', compact('orders', 'statuses'));
    }

    public function create()
    {
        $products = config('products');
        return view('admin.ecommerce.order-create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'city' => 'required|string|in:dhaka,chittagong,outside',
            'payment_method' => 'required|string|in:cod,bkash,nagad',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'coupon_code' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:500',
        ]);

        $products = config('products');
        $deliveryCharge = in_array($validated['city'], ['dhaka', 'chittagong']) ? 60 : 120;

        $subtotal = 0;
        $orderItems = [];
        foreach ($validated['items'] as $item) {
            $product = $products[$item['product_id']] ?? null;
            if (!$product) continue;

            $unitPrice = $product['price'];
            $lineTotal = $unitPrice * $item['quantity'];
            $subtotal += $lineTotal;

            $orderItems[] = [
                'product_name' => $product['name'],
                'quantity' => $item['quantity'],
                'unit_price' => $unitPrice,
                'original_price' => $product['original_price'],
                'line_total' => $lineTotal,
            ];
        }

        if (empty($orderItems)) {
            return back()->withErrors(['items' => 'At least one valid product is required.']);
        }

        $discount = 0;
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

        foreach ($orderItems as $itemData) {
            $order->items()->create($itemData);
        }

        return redirect()->route('admin.ecommerce.orders')
            ->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        $order->load('items');
        return view('admin.ecommerce.order-show', compact('order'));
    }

    public function edit(Order $order)
    {
        $order->load('items');
        $products = config('products');
        return view('admin.ecommerce.order-edit', compact('order', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'city' => 'required|string|in:dhaka,chittagong,outside',
            'payment_method' => 'required|string|in:cod,bkash,nagad',
            'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
            'coupon_code' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:500',
        ]);

        $deliveryCharge = in_array($validated['city'], ['dhaka', 'chittagong']) ? 60 : 120;

        $order->update(array_merge($validated, [
            'delivery_charge' => $deliveryCharge,
        ]));

        return redirect()->route('admin.ecommerce.orders')
            ->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.ecommerce.orders')
            ->with('success', 'Order deleted successfully.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Order status updated to ' . $validated['status']);
    }
}
