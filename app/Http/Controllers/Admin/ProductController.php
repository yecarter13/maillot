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
        $products = Product::with('championship')
            ->when(request('search'), function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('club', 'like', "%{$search}%")
                        ->orWhere('season', 'like', "%{$search}%")
                        ->orWhere('sizes', 'like', "%{$search}%")
                        ->orWhereHas('championship', fn ($c) => $c->where('name', 'like', "%{$search}%"));
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();
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
            'gallery_images' => 'nullable|string',
            'is_new' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $data['is_new'] = $request->boolean('is_new');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $name = Str::random(20) . '.' . $request->file('image_file')->extension();
            $request->file('image_file')->move($this->uploadDir(), $name);
            $data['image'] = '/uploads/products/' . $name;
        }
        $data['gallery_images'] = $this->buildGalleryJson($data['gallery_images'] ?? '', $request->hasFile('gallery_files') ? $request->file('gallery_files') : []);

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Maillot ajouté avec succès.');
    }

    public function edit(Product $product)
    {
        $championships = Championship::orderBy('name')->get();
        $storedGallery = json_decode($product->getRawOriginal('gallery_images') ?? '[]', true);
        $galleryLinks = is_array($storedGallery) ? implode("\n", $storedGallery) : '';
        return view('admin.products.form', compact('championships', 'product', 'storedGallery', 'galleryLinks'));
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
            'gallery_images' => 'nullable|string',
            'is_new' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $data['is_new'] = $request->boolean('is_new');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $name = Str::random(20) . '.' . $request->file('image_file')->extension();
            $request->file('image_file')->move($this->uploadDir(), $name);
            $data['image'] = '/uploads/products/' . $name;
        } elseif ($request->boolean('remove_image')) {
            $data['image'] = null;
        }

        $existingGallery = json_decode($product->getRawOriginal('gallery_images') ?? '[]', true);
        if (!is_array($existingGallery)) {
            $existingGallery = [];
        }
        $removeGallery = $request->input('remove_gallery_images', []);
        if (!is_array($removeGallery)) {
            $removeGallery = [$removeGallery];
        }
        $existingGallery = array_values(array_filter($existingGallery, function ($url) use ($removeGallery) {
            return $url !== null && !in_array((string) $url, array_map('strval', $removeGallery), true);
        }));
        $data['gallery_images'] = $this->buildGalleryJson($data['gallery_images'] ?? '', $request->hasFile('gallery_files') ? $request->file('gallery_files') : [], $existingGallery ? json_encode($existingGallery) : null);

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

    protected function uploadDir(): string
    {
        $dir = dirname(base_path()) . '/uploads/products';
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        return $dir;
    }

    protected function buildGalleryJson(string $input, array $files = [], ?string $existing = null): ?string
    {
        $urls = $this->parseGalleryInput($input);

        foreach ($files as $file) {
            if (!$file) continue;
            $name = Str::random(20) . '.' . $file->extension();
            $file->move($this->uploadDir(), $name);
            $urls[] = '/uploads/products/' . $name;
        }

        if (!empty($existing)) {
            $existingUrls = json_decode($existing, true);
            if (is_array($existingUrls)) {
                $urls = array_merge($urls, $existingUrls);
            }
        }

        $urls = array_values(array_unique(array_filter(array_map(
            fn ($url) => $this->normalizeImagePath((string) $url),
            $urls
        ))));

        return $urls ? json_encode($urls) : null;
    }

    protected function parseGalleryInput(string $input): array
    {
        $input = trim($input);
        if ($input === '') return [];

        $decoded = json_decode($input, true);
        if (is_array($decoded)) {
            return array_values(array_filter(array_map('strval', $decoded)));
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $input))));
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
