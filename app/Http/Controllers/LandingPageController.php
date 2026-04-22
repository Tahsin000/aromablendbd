<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class LandingPageController extends Controller
{
    public function index()
    {
        return Inertia::render('LandingPage', [
            'products' => config('products'),
        ]);
    }

    public function product(Request $request)
    {
        $products = config('products');
        $productId = $request->route('productId');
        $product = $products[$productId] ?? abort(404);

        return Inertia::render('ProductDetail', [
            'product' => $product,
            'products' => $products,
        ]);
    }
}
