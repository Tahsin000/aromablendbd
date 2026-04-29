<?php

namespace App\Observers;

use App\Models\User;
use App\Support\FrontendCache;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class UserObserver implements ShouldHandleEventsAfterCommit
{
    public function created(User $user): void
    {
        if ($user->is_admin) {
            FrontendCache::flushSiteSettings();
        }
    }

    public function updated(User $user): void
    {
        if (!$user->is_admin && !$user->wasChanged('is_admin')) {
            return;
        }

        if ($user->wasChanged('settings') || $user->wasChanged('is_admin')) {
            FrontendCache::flushSiteSettings();
        }
    }

    public function deleted(User $user): void
    {
        if ($user->is_admin) {
            FrontendCache::flushSiteSettings();
        }
    }

    public function restored(User $user): void
    {
        if ($user->is_admin) {
            FrontendCache::flushSiteSettings();
        }
    }

    public function forceDeleted(User $user): void
    {
        if ($user->is_admin) {
            FrontendCache::flushSiteSettings();
        }
    }
}
