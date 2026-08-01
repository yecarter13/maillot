<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Championship;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChampionshipController extends Controller
{
    public function index()
    {
        $championships = Championship::withCount('products')->orderBy('sort_order')->orderBy('name')->get();
        return view('admin.championships.index', compact('championships'));
    }

    public function create()
    {
        $championship = null;
        return view('admin.championships.form', compact('championship'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $name = Str::random(20) . '.' . $request->file('image_file')->extension();
            $request->file('image_file')->move(base_path('public/images/championships'), $name);
            $data['image'] = '/images/championships/' . $name;
        }

        Championship::create($data);

        return redirect()->route('admin.championships.index')->with('success', 'Championnat ajouté avec succès.');
    }

    public function edit(Championship $championship)
    {
        return view('admin.championships.form', compact('championship'));
    }

    public function update(Request $request, Championship $championship)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $name = Str::random(20) . '.' . $request->file('image_file')->extension();
            $request->file('image_file')->move(base_path('public/images/championships'), $name);
            $data['image'] = '/images/championships/' . $name;
        }

        $championship->update($data);

        return redirect()->route('admin.championships.index')->with('success', 'Championnat mis à jour avec succès.');
    }

    public function destroy(Championship $championship)
    {
        $championship->delete();
        return redirect()->route('admin.championships.index')->with('success', 'Championnat supprimé.');
    }

    public function toggle(Championship $championship)
    {
        $championship->update(['is_active' => !$championship->is_active]);
        return back()->with('success', 'Statut mis à jour.');
    }
}
