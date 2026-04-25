<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LandingPageController extends Controller
{
    public function index()
    {
        $reviews = Review::active()
            ->inRandomOrder()
            ->get()
            ->map(fn ($r) => [
                'name'     => $r->name,
                'location' => $r->location,
                'initial'  => $r->initial ?? mb_substr($r->name, 0, 2),
                'image'    => $r->image_url,
                'text'     => $r->text,
                'stars'    => $r->stars,
            ]);

        return Inertia::render('LandingPage', [
            'products' => config('products'),
            'reviews'  => $reviews,
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
