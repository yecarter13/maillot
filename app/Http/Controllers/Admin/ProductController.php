<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Championship;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('championship')->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $championships = Championship::orderBy('name')->get();
        $product = null;
        return view('admin.products.form', compact('championships', 'product'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'championship_id' => 'nullable|exists:championships,id',
            'name' => 'required|string|max:255',
            'club' => 'nullable|string|max:255',
            'season' => 'nullable|string|max:100',
            'sizes' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0|gt:0',
            'image' => 'nullable|string|max:500',
            'gallery_images' => 'nullable|json',
            'is_new' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $data['is_new'] = $request->boolean('is_new');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $name = Str::random(20) . '.' . $request->file('image_file')->extension();
            $request->file('image_file')->move(base_path('public/images/products'), $name);
            $data['image'] = '/images/products/' . $name;
        }
        if (!empty($data['gallery_images'])) {
            $data['gallery_images'] = $this->normalizeGalleryJson($data['gallery_images']);
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Maillot ajouté avec succès.');
    }

    public function edit(Product $product)
    {
        $championships = Championship::orderBy('name')->get();
        $storedGallery = json_decode($product->getRawOriginal('gallery_images') ?? '[]', true);
        return view('admin.products.form', compact('championships', 'product', 'storedGallery'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'championship_id' => 'nullable|exists:championships,id',
            'name' => 'required|string|max:255',
            'club' => 'nullable|string|max:255',
            'season' => 'nullable|string|max:100',
            'sizes' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0|gt:0',
            'image' => 'nullable|string|max:500',
            'gallery_images' => 'nullable|json',
            'is_new' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $data['is_new'] = $request->boolean('is_new');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $name = Str::random(20) . '.' . $request->file('image_file')->extension();
            $request->file('image_file')->move(base_path('public/images/products'), $name);
            $data['image'] = '/images/products/' . $name;
        }
        if (!empty($data['gallery_images'])) {
            $data['gallery_images'] = $this->normalizeGalleryJson($data['gallery_images']);
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Maillot mis à jour avec succès.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Maillot supprimé.');
    }

    public function toggle(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        return back()->with('success', 'Statut mis à jour.');
    }

    protected function normalizeGalleryJson(string $json): string
    {
        $urls = json_decode($json, true);
        if (!is_array($urls)) return $json;
        $normalized = array_map(fn ($url) => $this->normalizeImagePath((string) $url), $urls);
        return json_encode($normalized);
    }

    protected function normalizeImagePath(string $path): string
    {
        $imagesUrl = url('/images/');
        if (str_starts_with($path, $imagesUrl)) {
            return '/' . ltrim(parse_url($path, PHP_URL_PATH), '/');
        }
        return $path;
    }
}
