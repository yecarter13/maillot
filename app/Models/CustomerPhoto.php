<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPhoto extends Model
{
    protected $fillable = [
        'customer_name', 'location', 'message', 'image', 'is_active', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) return null;
        if (str_starts_with($this->image, 'http')) return $this->image;
        if (str_starts_with($this->image, '//')) return $this->image;
        if (str_starts_with($this->image, '/')) return asset($this->image);
        return asset('images/' . $this->image);
    }
}
