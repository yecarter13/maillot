@extends('admin.layouts.master')

@section('title', ($customerPhoto ?? null) ? 'Modifier la photo | ' . $globalSite->name : 'Ajouter une photo | ' . $globalSite->name)

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg font-bold text-pitch-900">{{ $customerPhoto ? 'Modifier la photo' : 'Ajouter une photo' }}</h2>
            <p class="text-sm text-pitch-500">Photo d'un client satisfait à afficher dans la photothèque.</p>
        </div>
        <a href="{{ route('admin.customer-photos.index') }}" class="text-sm font-semibold text-pitch-500 hover:text-pitch-700">← Retour</a>
    </div>

    <form action="{{ $customerPhoto ? route('admin.customer-photos.update', $customerPhoto) : route('admin.customer-photos.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-pitch-100 p-6 space-y-5">
        @csrf
        @if ($customerPhoto)
        @method('PUT')
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="customer_name" class="block text-sm font-medium text-pitch-800 mb-1.5">Nom du client *</label>
                <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $customerPhoto?->customer_name) }}" required placeholder="Ex : Jean-Pierre Ndongo"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                @error('customer_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="location" class="block text-sm font-medium text-pitch-800 mb-1.5">Ville</label>
                <input type="text" name="location" id="location" value="{{ old('location', $customerPhoto?->location) }}" placeholder="Ex : Douala"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
            </div>
        </div>

        <div>
            <label for="message" class="block text-sm font-medium text-pitch-800 mb-1.5">Message du client</label>
            <textarea name="message" id="message" rows="3" placeholder="Ex : Très satisfait de mon maillot, livraison rapide !"
                      class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">{{ old('message', $customerPhoto?->message) }}</textarea>
            <p class="mt-1 text-xs text-pitch-400">Optionnel.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="image_file" class="block text-sm font-medium text-pitch-800 mb-1.5">Photo du client *</label>
                <input type="file" name="image_file" id="image_file" accept="image/*"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-grass-50 file:text-grass-700 file:text-xs file:font-semibold hover:file:bg-grass-100">
                <p class="mt-1 text-xs text-pitch-400">Ou collez un lien d'image ci-dessous.</p>
                <input type="text" name="image" id="image" value="{{ old('image', $customerPhoto?->getRawOriginal('image')) }}" placeholder="https://..."
                       class="mt-2 w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                @error('image')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                @if ($customerPhoto?->image_url)
                <img src="{{ $customerPhoto->image_url }}" alt="" class="mt-3 w-32 h-24 object-cover rounded-lg border border-pitch-100">
                @endif
            </div>
            <div>
                <label for="sort_order" class="block text-sm font-medium text-pitch-800 mb-1.5">Ordre d'affichage</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $customerPhoto?->sort_order ?? 0) }}" min="0"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                <label class="flex items-center gap-2 mt-3 text-sm text-pitch-800">
                    <input type="checkbox" name="is_active" value="1" class="rounded border-pitch-300 text-grass-500 focus:ring-grass-500" {{ old('is_active', $customerPhoto?->is_active ?? true) ? 'checked' : '' }}>
                    Photo visible sur le site
                </label>
            </div>
        </div>

        <div class="pt-4 border-t border-pitch-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.customer-photos.index') }}" class="px-5 py-2.5 text-sm font-semibold text-pitch-600 hover:text-pitch-800 rounded-lg">Annuler</a>
            <button type="submit" class="px-6 py-2.5 bg-grass-600 hover:bg-grass-500 text-white text-sm font-semibold rounded-lg transition-colors">
                {{ $customerPhoto ? 'Enregistrer les modifications' : 'Ajouter la photo' }}
            </button>
        </div>
    </form>
</div>
@endsection
