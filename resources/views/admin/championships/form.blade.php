@extends('admin.layouts.master')

@section('title', ($championship ? 'Modifier' : 'Ajouter') . ' un championnat | ' . $globalSite->name)

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg font-bold text-pitch-900">{{ $championship ? 'Modifier le championnat' : 'Ajouter un championnat' }}</h2>
            <p class="text-sm text-pitch-500">Ex : Ligue 1, Premier League, Liga, Serie A, Ligue des Champions…</p>
        </div>
        <a href="{{ route('admin.championships.index') }}" class="text-sm font-semibold text-pitch-500 hover:text-pitch-700">← Retour</a>
    </div>

    <form action="{{ $championship ? route('admin.championships.update', $championship) : route('admin.championships.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-pitch-100 p-6 space-y-5">
        @csrf
        @if ($championship)
        @method('PUT')
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="name" class="block text-sm font-medium text-pitch-800 mb-1.5">Nom du championnat *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $championship?->name) }}" required placeholder="Ex : Ligue 1"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="country" class="block text-sm font-medium text-pitch-800 mb-1.5">Pays</label>
                <input type="text" name="country" id="country" value="{{ old('country', $championship?->country) }}" placeholder="Ex : France"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-pitch-800 mb-1.5">Description</label>
            <textarea name="description" id="description" rows="3" placeholder="Courte description du championnat..."
                      class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">{{ old('description', $championship?->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="image_file" class="block text-sm font-medium text-pitch-800 mb-1.5">Image (logo / visuel)</label>
                <input type="file" name="image_file" id="image_file" accept="image/*"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-grass-50 file:text-grass-700 file:text-xs file:font-semibold hover:file:bg-grass-100">
                <p class="mt-1 text-xs text-pitch-400">Ou collez un lien ci-dessous.</p>
                <input type="text" name="image" id="image" value="{{ old('image', $championship?->getRawOriginal('image')) }}" placeholder="https://..."
                       class="mt-2 w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                @if ($championship?->image_url)
                <img src="{{ $championship->image_url }}" alt="" class="mt-3 w-24 h-24 object-cover rounded-lg border border-pitch-100">
                @endif
            </div>
            <div>
                <label for="sort_order" class="block text-sm font-medium text-pitch-800 mb-1.5">Ordre d'affichage</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $championship?->sort_order ?? 0) }}" min="0"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                <label class="flex items-center gap-2 mt-3 text-sm text-pitch-800">
                    <input type="checkbox" name="is_active" value="1" class="rounded border-pitch-300 text-grass-500 focus:ring-grass-500" {{ old('is_active', $championship?->is_active ?? true) ? 'checked' : '' }}>
                    Championnat actif
                </label>
            </div>
        </div>

        <div class="pt-4 border-t border-pitch-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.championships.index') }}" class="px-5 py-2.5 text-sm font-semibold text-pitch-600 hover:text-pitch-800 rounded-lg">Annuler</a>
            <button type="submit" class="px-6 py-2.5 bg-grass-600 hover:bg-grass-500 text-white text-sm font-semibold rounded-lg transition-colors">
                {{ $championship ? 'Enregistrer les modifications' : 'Ajouter le championnat' }}
            </button>
        </div>
    </form>
</div>
@endsection
