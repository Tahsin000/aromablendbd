<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

        $siteSettings = Cache::remember('site_settings', now()->addHours(24), function () {
            return User::getSiteSettings();
        });

        $activeSettings = [];
        foreach ($siteSettings as $key => $section) {
            if (is_array($section) && isset($section['status'])) {
                // Ribbon always passed through (needed for v-if status check)
                if ($key === 'ribbon') {
                    $activeSettings[$key] = $section;
                    continue;
                }
                if ($section['status'] === true || $section['status'] === 'true' || $section['status'] === 1) {
                    $activeSettings[$key] = $section;
                }
            } elseif (!is_array($section)) {
                $activeSettings[$key] = $section;
            }
        }

        return Inertia::render('LandingPage', [
            'products' => config('products'),
            'reviews'  => $reviews,
            'site'     => $activeSettings,
        ]);
    }

    public function product(Request $request)
    {
        $products = config('products');
        $productId = $request->route('productId');
        $product = $products[$productId] ?? abort(404);

        $siteSettings = Cache::remember('site_settings', now()->addHours(24), function () {
            return User::getSiteSettings();
        });

        return Inertia::render('ProductDetail', [
            'product' => $product,
            'products' => $products,
            'site' => $siteSettings,
        ]);
    }
}
