@extends('admin.layouts.master')

@section('title', ($product ? 'Modifier' : 'Ajouter') . ' un maillot | ' . $globalSite->name)

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg font-bold text-pitch-900">{{ $product ? 'Modifier le maillot' : 'Ajouter un maillot' }}</h2>
            <p class="text-sm text-pitch-500">Remplissez les informations du maillot.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-sm font-semibold text-pitch-500 hover:text-pitch-700">← Retour</a>
    </div>

    <form action="{{ $product ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-pitch-100 p-6 space-y-5">
        @csrf
        @if ($product)
        @method('PUT')
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="sm:col-span-2">
                <label for="name" class="block text-sm font-medium text-pitch-800 mb-1.5">Nom du maillot *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product?->name) }}" required placeholder="Ex : Maillot domicile Real Madrid 2025/26"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="championship_id" class="block text-sm font-medium text-pitch-800 mb-1.5">Championnat</label>
                <select name="championship_id" id="championship_id" class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 bg-white focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                    <option value="">— Aucun —</option>
                    @foreach ($championships as $champ)
                    <option value="{{ $champ->id }}" {{ old('championship_id', $product?->championship_id) == $champ->id ? 'selected' : '' }}>{{ $champ->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="club" class="block text-sm font-medium text-pitch-800 mb-1.5">Club / Équipe</label>
                <input type="text" name="club" id="club" value="{{ old('club', $product?->club) }}" placeholder="Ex : Real Madrid"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
            </div>

            <div>
                <label for="season" class="block text-sm font-medium text-pitch-800 mb-1.5">Saison</label>
                <input type="text" name="season" id="season" value="{{ old('season', $product?->season) }}" placeholder="Ex : 2025/26"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
            </div>

            <div>
                <label for="sizes" class="block text-sm font-medium text-pitch-800 mb-1.5">Tailles disponibles</label>
                <input type="text" name="sizes" id="sizes" value="{{ old('sizes', $product?->sizes) }}" placeholder="Ex : S, M, L, XL, XXL"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                <p class="mt-1 text-xs text-pitch-400">Séparez par des virgules.</p>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label for="price" class="block text-sm font-medium text-pitch-800 mb-1.5">Prix (FCFA) *</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product?->price) }}" required min="0" step="1" placeholder="15000"
                           class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                </div>
                <div>
                    <label for="old_price" class="block text-sm font-medium text-pitch-800 mb-1.5">Ancien prix (FCFA)</label>
                    <input type="number" name="old_price" id="old_price" value="{{ old('old_price', $product?->old_price) }}" min="0" step="1" placeholder="20000"
                           class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                    <p class="mt-1 text-xs text-pitch-400">Optionnel — affiche une promotion.</p>
                </div>
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-pitch-800 mb-1.5">Description</label>
            <textarea name="description" id="description" rows="4" placeholder="Décrivez le maillot : matière, qualité, détails..."
                      class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">{{ old('description', $product?->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="image_file" class="block text-sm font-medium text-pitch-800 mb-1.5">Image du maillot</label>
                <input type="file" name="image_file" id="image_file" accept="image/*"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-grass-50 file:text-grass-700 file:text-xs file:font-semibold hover:file:bg-grass-100">
                <p class="mt-1 text-xs text-pitch-400">Ou collez un lien d'image ci-dessous.</p>
                <input type="text" name="image" id="image" value="{{ old('image', $product?->getRawOriginal('image')) }}" placeholder="https://... ou /images/products/..."
                       class="mt-2 w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                @if ($product?->image_url)
                <img src="{{ $product->image_url }}" alt="" class="mt-3 w-24 h-28 object-cover rounded-lg border border-pitch-100">
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium text-pitch-800 mb-1.5">Galerie d'images (liens)</label>
                <textarea name="gallery_images" id="gallery_images" rows="4" placeholder="Un lien par ligne (JSON ou lignes)"
                          class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">{{ old('gallery_images', isset($storedGallery) ? json_encode($storedGallery, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '') }}</textarea>
                <p class="mt-1 text-xs text-pitch-400">Optionnel.</p>
            </div>
        </div>

        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2 text-sm text-pitch-800">
                <input type="checkbox" name="is_new" value="1" class="rounded border-pitch-300 text-grass-500 focus:ring-grass-500" {{ old('is_new', $product?->is_new) ? 'checked' : '' }}>
                Nouveau maillot
            </label>
            <label class="flex items-center gap-2 text-sm text-pitch-800">
                <input type="checkbox" name="is_active" value="1" class="rounded border-pitch-300 text-grass-500 focus:ring-grass-500" {{ old('is_active', $product?->is_active ?? true) ? 'checked' : '' }}>
                Visible en ligne
            </label>
        </div>

        <div class="pt-4 border-t border-pitch-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 text-sm font-semibold text-pitch-600 hover:text-pitch-800 rounded-lg">Annuler</a>
            <button type="submit" class="px-6 py-2.5 bg-grass-600 hover:bg-grass-500 text-white text-sm font-semibold rounded-lg transition-colors">
                {{ $product ? 'Enregistrer les modifications' : 'Ajouter le maillot' }}
            </button>
        </div>
    </form>
</div>
@endsection
