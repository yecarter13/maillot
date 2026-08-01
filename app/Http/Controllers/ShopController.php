<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('championship')->where('is_active', true);

        if ($request->filled('championship')) {
            $query->whereHas('championship', fn ($q) => $q->where('slug', $request->championship));
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('club', 'like', "%{$search}%")
                    ->orWhere('season', 'like', "%{$search}%")
                    ->orWhereHas('championship', fn ($c) => $c->where('name', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('sort')) {
            $sort = $request->sort;
            if ($sort === 'price_asc') $query->orderBy('price');
            elseif ($sort === 'price_desc') $query->orderByDesc('price');
            elseif ($sort === 'newest') $query->latest();
            else $query->orderByDesc('is_new')->latest();
        } else {
            $query->orderByDesc('is_new')->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $championships = Championship::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get();
        $activeChampionship = $request->championship ? Championship::where('slug', $request->championship)->first() : null;

        return view('pages.shop', compact('products', 'championships', 'activeChampionship'));
    }

    public function suggest(Request $request)
    {
        $q = trim($request->q ?? '');
        if (mb_strlen($q) < 2) {
            return response()->json(['products' => [], 'championships' => []]);
        }

        $products = Product::with('championship')
            ->where('is_active', true)
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('club', 'like', "%{$q}%")
                    ->orWhereHas('championship', fn ($c) => $c->where('name', 'like', "%{$q}%"));
            })
            ->limit(6)
            ->get();

        $championships = Championship::where('is_active', true)
            ->where('name', 'like', "%{$q}%")
            ->limit(4)
            ->get();

        return response()->json([
            'products' => $products->map(fn ($p) => [
                'slug' => $p->slug,
                'name' => $p->name,
                'club' => $p->club,
                'price' => $p->formatPrice(),
                'image' => $p->image_url,
            ]),
            'championships' => $championships->map(fn ($c) => [
                'name' => $c->name,
                'slug' => $c->slug,
            ]),
        ]);
    }
}
