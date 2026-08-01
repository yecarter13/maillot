<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Championship extends Model
{
    protected $fillable = [
        'name', 'slug', 'country', 'description', 'image', 'icon', 'is_active', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) return null;
        if (str_starts_with($this->image, 'http')) return $this->image;
        if (str_starts_with($this->image, '//')) return $this->image;
        if (str_starts_with($this->image, '/')) return asset($this->image);
        return asset('images/' . $this->image);
    }

    protected static function booted(): void
    {
        static::creating(function (self $championship) {
            if (empty($championship->slug)) {
                $base = Str::slug($championship->name);
                $slug = $base;
                $i = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $base . '-' . $i++;
                }
                $championship->slug = $slug;
            }
        });
    }
}
