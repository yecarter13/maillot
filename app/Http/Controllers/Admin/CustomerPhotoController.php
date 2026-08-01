<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerPhotoController extends Controller
{
    public function index()
    {
        $photos = CustomerPhoto::orderBy('sort_order')->latest()->paginate(15);
        return view('admin.customer-photos.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.customer-photos.form', ['customerPhoto' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:500',
            'image' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $name = Str::random(20) . '.' . $request->file('image_file')->extension();
            $request->file('image_file')->move(base_path('public/images/customer-photos'), $name);
            $data['image'] = '/images/customer-photos/' . $name;
        }

        if (empty($data['image'])) {
            return back()->withErrors(['image' => 'Veuillez choisir une photo ou saisir un lien d\'image.'])->withInput();
        }

        CustomerPhoto::create($data);

        return redirect()->route('admin.customer-photos.index')->with('success', 'Photo ajoutée à la photothèque.');
    }

    public function edit(CustomerPhoto $customerPhoto)
    {
        return view('admin.customer-photos.form', ['customerPhoto' => $customerPhoto]);
    }

    public function update(Request $request, CustomerPhoto $customerPhoto)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:500',
            'image' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $name = Str::random(20) . '.' . $request->file('image_file')->extension();
            $request->file('image_file')->move(base_path('public/images/customer-photos'), $name);
            $data['image'] = '/images/customer-photos/' . $name;
        }

        if (empty($data['image'])) {
            unset($data['image']);
        }

        $customerPhoto->update($data);

        return redirect()->route('admin.customer-photos.index')->with('success', 'Photo mise à jour.');
    }

    public function destroy(CustomerPhoto $customerPhoto)
    {
        $customerPhoto->delete();
        return redirect()->route('admin.customer-photos.index')->with('success', 'Photo supprimée.');
    }

    public function toggle(CustomerPhoto $customerPhoto)
    {
        $customerPhoto->update(['is_active' => !$customerPhoto->is_active]);
        return back()->with('success', 'Statut mis à jour.');
    }
}
