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
                <input type="hidden" name="remove_image" id="remove_image" value="0">
                <div id="main-image-preview" class="mt-3 flex flex-wrap gap-3 items-start">
                    @if ($product?->image_url)
                    <div class="relative" data-main-preview data-src="{{ $product->image_url }}">
                        <img src="{{ $product->image_url }}" alt="" class="w-24 h-28 object-cover rounded-lg border border-pitch-100">
                        <button type="button" data-remove-main class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-600 hover:bg-red-700 text-white text-sm font-bold leading-none flex items-center justify-center shadow" title="Supprimer cette image" aria-label="Supprimer l'image principale">×</button>
                    </div>
                    @endif
                    <div id="main-image-new" class="relative hidden" data-main-new>
                        <img src="" alt="" class="w-24 h-28 object-cover rounded-lg border border-pitch-100">
                        <button type="button" data-clear-main class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-600 hover:bg-red-700 text-white text-sm font-bold leading-none flex items-center justify-center shadow" title="Retirer cette image" aria-label="Retirer l'image choisie">×</button>
                    </div>
                </div>
                <p id="main-image-removed" class="mt-2 hidden text-xs font-semibold text-red-600">Image principale supprimée — réutilisez la croix pour annuler.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-pitch-800 mb-1.5">Photos du maillot (galerie)</label>
                <input type="file" name="gallery_files[]" id="gallery_files" accept="image/*" multiple
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-grass-50 file:text-grass-700 file:text-xs file:font-semibold hover:file:bg-grass-100">
                <p class="mt-1 text-xs text-pitch-400">Sélectionnez plusieurs photos pour les détails du maillot (en plus de l'image principale).</p>

                <label class="block text-sm font-medium text-pitch-800 mt-4 mb-1.5">Galerie existante</label>
                <div id="gallery-existing" class="flex flex-wrap gap-2 mb-3">
                    @php
                        $previewGallery = $product?->gallery_url ?? [];
                        $rawGallery = $storedGallery ?? json_decode($product?->getRawOriginal('gallery_images') ?? '[]', true) ?? [];
                    @endphp
                    @if (!empty($previewGallery))
                        @foreach ($previewGallery as $gUrl)
                            @php $gRaw = $rawGallery[$loop->index] ?? $gUrl; @endphp
                            <div class="relative" data-gallery-preview data-raw="{{ $gRaw }}">
                                <img src="{{ $gUrl }}" alt="" class="w-16 h-16 object-cover rounded-lg border border-pitch-100">
                                <button type="button" data-remove-gallery class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-600 hover:bg-red-700 text-white text-sm font-bold leading-none flex items-center justify-center shadow" title="Supprimer cette photo" aria-label="Supprimer cette photo">×</button>
                            </div>
                        @endforeach
                    @else
                        <p class="text-xs text-pitch-400">Aucune photo de galerie pour le moment.</p>
                    @endif
                </div>

                <label class="block text-sm font-medium text-pitch-800 mb-1.5">Nouvelles photos choisies</label>
                <div id="gallery-new" class="flex flex-wrap gap-2 mb-3 text-xs text-pitch-400"></div>

                <label class="block text-sm font-medium text-pitch-800 mb-1.5">Ou collez des liens d'images (un par ligne)</label>
                <textarea name="gallery_images" id="gallery_images" rows="4" placeholder="https://example.com/photo1.jpg"
                          class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">{{ old('gallery_images', $galleryLinks ?? '') }}</textarea>
                <p class="mt-1 text-xs text-pitch-400">Vous pouvez combiner photos téléversées et liens.</p>
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

@push('scripts')
<script>
(function () {
    const removeMain = document.getElementById('remove_image');
    const mainInput = document.getElementById('image_file');
    const mainNew = document.getElementById('main-image-new');
    const mainNewImg = mainNew ? mainNew.querySelector('img') : null;
    const mainExisting = document.querySelector('[data-main-preview]');
    const mainRemovedNote = document.getElementById('main-image-removed');

    function setRemovedMain() {
        if (!mainExisting) return;
        const img = mainExisting.querySelector('img');
        if (img) img.classList.add('opacity-40', 'grayscale');
        if (mainRemovedNote) mainRemovedNote.classList.remove('hidden');
    }
    function unsetRemovedMain() {
        if (!mainExisting) return;
        const img = mainExisting.querySelector('img');
        if (img) img.classList.remove('opacity-40', 'grayscale');
        if (mainRemovedNote) mainRemovedNote.classList.add('hidden');
    }

    if (mainInput && mainNew && mainNewImg) {
        mainInput.addEventListener('change', function () {
            if (mainInput.files && mainInput.files[0]) {
                mainNew.classList.remove('hidden');
                mainNewImg.src = URL.createObjectURL(mainInput.files[0]);
                if (mainExisting) mainExisting.classList.add('hidden');
                unsetRemovedMain();
                removeMain.value = '0';
            } else {
                mainNew.classList.add('hidden');
                mainNewImg.src = '';
                if (mainExisting) mainExisting.classList.remove('hidden');
            }
        });

        const clearMainBtn = mainNew.querySelector('[data-clear-main]');
        if (clearMainBtn) {
            clearMainBtn.addEventListener('click', function () {
                mainInput.value = '';
                mainNew.classList.add('hidden');
                mainNewImg.src = '';
                if (mainExisting) mainExisting.classList.remove('hidden');
                unsetRemovedMain();
            });
        }
    }

    const removeMainBtn = mainExisting ? mainExisting.querySelector('[data-remove-main]') : null;
    if (removeMainBtn) {
        removeMainBtn.addEventListener('click', function () {
            if (removeMain.value === '1') {
                removeMain.value = '0';
                unsetRemovedMain();
            } else {
                removeMain.value = '1';
                setRemovedMain();
            }
        });
    }

    const galleryInput = document.getElementById('gallery_files');
    const galleryNew = document.getElementById('gallery-new');

    if (galleryInput && galleryNew) {
        function renderNewGallery() {
            galleryNew.innerHTML = '';
            if (!galleryInput.files || !galleryInput.files.length) {
                galleryNew.textContent = 'Aucune photo choisie pour le moment.';
                return;
            }
            Array.from(galleryInput.files).forEach(function (file, i) {
                const wrap = document.createElement('div');
                wrap.className = 'relative';
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = 'w-16 h-16 object-cover rounded-lg border border-pitch-100';
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.textContent = '×';
                btn.className = 'absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-600 hover:bg-red-700 text-white text-sm font-bold leading-none flex items-center justify-center shadow';
                btn.setAttribute('aria-label', 'Retirer cette photo');
                btn.addEventListener('click', function () {
                    const dt = new DataTransfer();
                    Array.from(galleryInput.files).forEach(function (f, j) {
                        if (j !== i) dt.items.add(f);
                    });
                    galleryInput.files = dt.files;
                    renderNewGallery();
                });
                wrap.appendChild(img);
                wrap.appendChild(btn);
                galleryNew.appendChild(wrap);
            });
        }

        galleryInput.addEventListener('change', renderNewGallery);
    }

    document.querySelectorAll('[data-gallery-preview]').forEach(function (wrap) {
        const btn = wrap.querySelector('[data-remove-gallery]');
        const raw = wrap.getAttribute('data-raw');
        if (!btn || !raw) return;
        btn.addEventListener('click', function () {
            const img = wrap.querySelector('img');
            const existing = wrap.querySelector('input[name="remove_gallery_images[]"]');
            if (existing) {
                if (img) img.classList.remove('opacity-40', 'grayscale');
                btn.textContent = '×';
                btn.classList.remove('bg-grass-600', 'hover:bg-grass-700');
                btn.classList.add('bg-red-600', 'hover:bg-red-700');
                existing.remove();
            } else {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'remove_gallery_images[]';
                input.value = raw;
                wrap.appendChild(input);
                if (img) img.classList.add('opacity-40', 'grayscale');
                btn.textContent = '↺';
                btn.classList.remove('bg-red-600', 'hover:bg-red-700');
                btn.classList.add('bg-grass-600', 'hover:bg-grass-700');
            }
        });
    });
})();
</script>
@endpush

@endsection
