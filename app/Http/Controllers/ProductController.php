<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::with('championship')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $related = Product::with('championship')
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->when($product->championship_id, fn ($q) => $q->where('championship_id', $product->championship_id))
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('pages.product', compact('product', 'related'));
    }
}
