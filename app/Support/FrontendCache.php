<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

class FrontendCache
{
    public const SITE_SETTINGS_KEY = 'site_settings_v1';
    public const ACTIVE_PRODUCTS_KEY = 'active_products_v3';

    // Product catalog changes are relatively rare, so a medium TTL is a good balance.
    public const ACTIVE_PRODUCTS_TTL_SECONDS = 1800; // 30 minutes
    public const SITE_SETTINGS_TTL_SECONDS = 86400; // 24 hours

    public static function flushProducts(): void
    {
        Cache::forget(self::ACTIVE_PRODUCTS_KEY);
    }

    public static function flushSiteSettings(): void
    {
        Cache::forget(self::SITE_SETTINGS_KEY);
    }
}
