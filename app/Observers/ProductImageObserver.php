<?php

namespace App\Observers;

use App\Models\ProductImage;
use App\Support\FrontendCache;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class ProductImageObserver implements ShouldHandleEventsAfterCommit
{
    public function created(ProductImage $productImage): void
    {
        FrontendCache::flushProducts();
    }

    public function updated(ProductImage $productImage): void
    {
        FrontendCache::flushProducts();
    }

    public function deleted(ProductImage $productImage): void
    {
        FrontendCache::flushProducts();
    }

    public function restored(ProductImage $productImage): void
    {
        FrontendCache::flushProducts();
    }

    public function forceDeleted(ProductImage $productImage): void
    {
        FrontendCache::flushProducts();
    }
}

