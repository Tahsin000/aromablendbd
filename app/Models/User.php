<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'is_admin'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'settings' => 'array',
        ];
    }

    public static function getSiteSettings(): array
    {
        $admin = static::where('is_admin', true)->first();
        return $admin?->settings ?? [];
    }

    public function updateSiteSettings(string $section, array $data): void
    {
        $settings = $this->settings ?? [];
        $sectionData = $settings[$section] ?? [];

        // Merge scalar fields
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $sectionData[$key] = is_string($value) ? trim($value) : $value;
            }
        }

        // Merge array fields (stats, features, steps, quick_links, emails) - replace entirely
        foreach (['stats', 'features', 'steps', 'quick_links', 'emails', 'texts', 'timer'] as $arrayKey) {
            if (isset($data[$arrayKey]) && is_array($data[$arrayKey])) {
                $sectionData[$arrayKey] = $data[$arrayKey];
            }
        }

        // Normalize status to boolean
        if (isset($sectionData['status'])) {
            $sectionData['status'] = in_array($sectionData['status'], [true, 'true', '1', 1], true);
        }

        $settings[$section] = $sectionData;

        $encoded = json_encode($settings, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
        if (!json_validate($encoded)) {
            throw new \RuntimeException('Invalid JSON generated for settings');
        }

        $this->settings = $settings;
        $this->save();
    }

    public function getSectionSetting(string $section, mixed $default = null): mixed
    {
        return $this->settings[$section] ?? $default;
    }
}
