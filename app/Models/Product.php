<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'desc', 'price', 'original_price',
        'badge', 'stock', 'discount_label', 'review_count',
        'is_active', 'highlight', 'sort_order',
    ];

    protected $casts = [
        'price'          => 'float',
        'original_price' => 'float',
        'stock'          => 'integer',
        'review_count'   => 'integer',
        'is_active'      => 'boolean',
        'highlight'      => 'boolean',
        'sort_order'     => 'integer',
    ];

    protected $appends = ['thumbnail_url', 'image_urls', 'discount_percent'];

    // ─── Scopes ────────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ─── Relations ─────────────────────────────────────────────────────────────

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function tags(): HasMany
    {
        return $this->hasMany(ProductTag::class)->orderBy('sort_order');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // ─── Accessors ─────────────────────────────────────────────────────────────

    /**
     * Returns the URL of the primary image, or the first image, or the default fallback.
     */
    public function getThumbnailUrlAttribute(): string
    {
        $primary = $this->orderedImages()->first();

        if ($primary) {
            return ImageService::url($primary->image_path)
                ?? asset('images/product-d.png');
        }

        return asset('images/product-d.png');
    }

    /**
     * Returns an array of all image URLs; falls back to default image if none exist.
     */
    public function getImageUrlsAttribute(): array
    {
        $ordered = $this->orderedImages();

        if ($ordered->isEmpty()) {
            return [asset('images/product-d.png')];
        }

        return $ordered->map(fn ($img) =>
            ImageService::url($img->image_path) ?? asset('images/product-d.png')
        )->toArray();
    }

    /**
     * Computed discount percentage based on price vs original_price.
     */
    public function getDiscountPercentAttribute(): int
    {
        if ($this->original_price <= 0) return 0;
        return (int) round((1 - $this->price / $this->original_price) * 100);
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────

    /**
     * Returns the structured array used by the frontend (Inertia props).
     */
    public function toFrontendArray(): array
    {
        return [
            'id'             => $this->id,
            'slug'           => $this->slug,
            'name'           => $this->name,
            'desc'           => $this->desc,
            'price'          => $this->price,
            'original_price' => $this->original_price,
            'badge'          => $this->badge,
            'stock'          => $this->stock,
            'discount_label' => $this->discount_label,
            'review_count'   => $this->review_count,
            'highlight'      => $this->highlight,
            'image'          => $this->thumbnail_url,
            'images'         => $this->image_urls,
            'tags'           => $this->tags->map(fn ($t) => [
                'label' => $t->label,
                'color' => $t->color,
            ])->toArray(),
        ];
    }

    /**
     * Frontend display order:
     * 1) Primary image first
     * 2) Remaining images by admin-defined sort_order
     * 3) Stable tie-breaker by id
     */
    private function orderedImages(): EloquentCollection
    {
        $images = $this->relationLoaded('images')
            ? $this->images
            : $this->images()->get();

        return $images
            ->sort(function ($a, $b) {
                if ((bool) $a->is_primary !== (bool) $b->is_primary) {
                    return $a->is_primary ? -1 : 1;
                }

                $sortA = (int) ($a->sort_order ?? 0);
                $sortB = (int) ($b->sort_order ?? 0);
                if ($sortA !== $sortB) {
                    return $sortA <=> $sortB;
                }

                return (int) $a->id <=> (int) $b->id;
            })
            ->values();
    }
}
