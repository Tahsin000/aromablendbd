<?php

namespace App\Observers;

use App\Models\Product;
use App\Support\FrontendCache;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class ProductObserver implements ShouldHandleEventsAfterCommit
{
    public function created(Product $product): void
    {
        FrontendCache::flushProducts();
    }

    public function updated(Product $product): void
    {
        FrontendCache::flushProducts();
    }

    public function deleted(Product $product): void
    {
        FrontendCache::flushProducts();
    }

    public function restored(Product $product): void
    {
        FrontendCache::flushProducts();
    }

    public function forceDeleted(Product $product): void
    {
        FrontendCache::flushProducts();
    }
}

