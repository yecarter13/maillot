<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'championship_id', 'name', 'slug', 'club', 'season', 'sizes', 'description',
        'price', 'old_price', 'image', 'gallery_images', 'is_new', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_new' => 'boolean',
            'is_active' => 'boolean',
            'price' => 'decimal:0',
            'old_price' => 'decimal:0',
        ];
    }

    public function championship()
    {
        return $this->belongsTo(Championship::class);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) return null;
        if (str_starts_with($this->image, 'http')) return $this->image;
        if (str_starts_with($this->image, '//')) return $this->image;
        if (str_starts_with($this->image, '/')) return asset($this->image);
        return asset('images/' . $this->image);
    }

    public function getGalleryUrlAttribute()
    {
        $images = json_decode($this->getRawOriginal('gallery_images') ?? '[]', true);
        if (!is_array($images)) return [];
        return array_map(function ($url) {
            if (!$url) return null;
            if (str_starts_with($url, 'http')) return $url;
            if (str_starts_with($url, '//')) return $url;
            if (str_starts_with($url, '/')) return asset($url);
            return asset('images/' . $url);
        }, $images);
    }

    public function formatPrice(): string
    {
        return number_format($this->price, 0, ',', ' ') . ' FCFA';
    }

    public function formatOldPrice(): ?string
    {
        return $this->old_price ? number_format($this->old_price, 0, ',', ' ') . ' FCFA' : null;
    }

    protected static function booted(): void
    {
        static::creating(function (self $product) {
            if (empty($product->slug)) {
                $base = Str::slug($product->name);
                $slug = $base;
                $i = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $base . '-' . $i++;
                }
                $product->slug = $slug;
            }
        });
    }
}
