<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\User;
use App\Observers\ProductImageObserver;
use App\Observers\ProductObserver;
use App\Observers\ProductTagObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Product::observe(ProductObserver::class);
        ProductImage::observe(ProductImageObserver::class);
        ProductTag::observe(ProductTagObserver::class);
        User::observe(UserObserver::class);
    }
}
