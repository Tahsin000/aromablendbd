<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['name', 'location', 'initial', 'image', 'text', 'stars', 'status'];

    protected $casts = [
        'stars' => 'integer',
        'status' => 'boolean',
    ];

    protected $appends = ['image_url'];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        return ImageService::url($this->image);
    }
}
