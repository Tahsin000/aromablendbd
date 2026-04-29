<?php

namespace App\Observers;

use App\Models\ProductTag;
use App\Support\FrontendCache;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class ProductTagObserver implements ShouldHandleEventsAfterCommit
{
    public function created(ProductTag $productTag): void
    {
        FrontendCache::flushProducts();
    }

    public function updated(ProductTag $productTag): void
    {
        FrontendCache::flushProducts();
    }

    public function deleted(ProductTag $productTag): void
    {
        FrontendCache::flushProducts();
    }

    public function restored(ProductTag $productTag): void
    {
        FrontendCache::flushProducts();
    }

    public function forceDeleted(ProductTag $productTag): void
    {
        FrontendCache::flushProducts();
    }
}

