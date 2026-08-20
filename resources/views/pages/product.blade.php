@extends('layouts.master')

@section('title', $product->name . ' | ' . $globalSite->name)
@section('meta_description', Str::limit($product->description ?? ($product->name . ' — commandez sur WhatsApp. Livraison partout au Cameroun.'), 160))

@section('content')

<section class="py-10 lg:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-xs text-pitch-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-grass-600 transition-colors">Accueil</a>
            <span class="mx-2">/</span>
            <a href="{{ route('shop') }}" class="hover:text-grass-600 transition-colors">Boutique</a>
            @if ($product->championship)
            <span class="mx-2">/</span>
            <a href="{{ route('shop.championship', $product->championship->slug) }}" class="hover:text-grass-600 transition-colors">{{ $product->championship->name }}</a>
            @endif
            <span class="mx-2">/</span>
            <span class="text-pitch-600 font-medium">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            {{-- IMAGE --}}
            <div class="animate-fade-in">
                @php
                    $lightboxItems = collect(array_merge([$product->image_url], $product->gallery_url))
                        ->filter()
                        ->map(fn ($src) => ['src' => $src, 'caption' => $product->name, 'alt' => $product->name])
                        ->values();
                @endphp
                <div class="relative bg-pitch-50 rounded-3xl overflow-hidden border border-pitch-100">
                    @if ($product->image_url)
                    <button type="button" data-gallery="product-{{ $product->id }}" data-gallery-items="{{ $lightboxItems->toJson() }}" data-src="{{ $product->image_url }}" data-caption="{{ $product->name }}" data-alt="{{ $product->name }}" aria-label="Agrandir la photo" class="relative block w-full group">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full aspect-[4/5] object-cover transition-transform duration-500 group-hover:scale-105">
                        <span class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-pitch-950/20">
                            <span class="bg-black/50 text-white text-xs font-semibold px-3 py-1.5 rounded-full backdrop-blur flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                                Agrandir
                            </span>
                        </span>
                    </button>
                    @else
                    <div class="w-full aspect-[4/5] flex items-center justify-center text-pitch-300">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    @endif
                    <div class="absolute top-4 left-4 flex flex-col gap-2">
                        @if ($product->is_new)
                        <span class="bg-grass-500 text-white text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full shadow">Nouveau</span>
                        @endif
                        @if ($product->old_price)
                        <span class="bg-flame text-white text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full shadow">Promo</span>
                        @endif
                    </div>
                </div>

                @if (count($product->gallery_url))
                <div class="mt-4 grid grid-cols-4 gap-3">
                    @foreach ($product->gallery_url as $img)
                    <button type="button" class="gallery-thumb rounded-xl overflow-hidden border-2 border-transparent hover:border-grass-500 transition-colors bg-pitch-50" aria-label="Voir cette photo">
                        <img src="{{ $img }}" alt="{{ $product->name }}" class="w-full aspect-square object-cover">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- INFOS --}}
            <div class="animate-slide-right">
                @if ($product->championship)
                <a href="{{ route('shop.championship', $product->championship->slug) }}" class="inline-flex items-center gap-1.5 px-3 py-1 bg-grass-50 text-grass-700 text-xs font-semibold rounded-full border border-grass-200 hover:bg-grass-100 transition-colors">
                    {{ $product->championship->name }}
                </a>
                @endif

                <h1 class="mt-3 text-2xl sm:text-3xl font-bold text-pitch-900 tracking-tight">{{ $product->name }}</h1>

                @if ($product->club || $product->season)
                <p class="mt-2 text-sm text-pitch-500">
                    @if ($product->club)<span class="font-semibold text-pitch-800">Club : {{ $product->club }}</span>@endif
                    @if ($product->season) · Saison {{ $product->season }} @endif
                </p>
                @endif

                <div class="mt-5 flex items-end gap-3">
                    <p class="text-3xl font-extrabold {{ $product->old_price ? 'text-grass-600' : 'text-pitch-900' }}">{{ $product->formatPrice() }}</p>
                    @if ($product->old_price)
                    <p class="text-lg text-pitch-400 line-through mb-1">{{ $product->formatOldPrice() }}</p>
                    <span class="mb-1.5 bg-flame/10 text-flame text-xs font-bold px-2 py-1 rounded-md">
                        -{{ round((1 - $product->price / $product->old_price) * 100) }}%
                    </span>
                    @endif
                </div>

                @if ($product->sizes)
                <div class="mt-6">
                    <p class="text-sm font-semibold text-pitch-800 mb-2">Tailles disponibles</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach (explode(',', $product->sizes) as $size)
                        <button type="button" data-size="{{ trim($size) }}" class="size-option px-4 py-2 border border-pitch-200 rounded-lg text-sm font-semibold text-pitch-700 hover:border-grass-500 hover:text-grass-600 transition-colors">{{ trim($size) }}</button>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="mt-8 space-y-3">
                    <button type="button" id="whatsapp-order-btn" class="w-full flex items-center justify-center gap-3 px-6 py-4 bg-grass-500 hover:bg-grass-600 text-white font-bold rounded-xl transition-all duration-300 hover:scale-[1.02] shadow-lg shadow-grass-500/25 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 004.74 1.21c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.86 9.86 0 0012.04 2zm5.83 14.12c-.25.7-1.45 1.33-2.02 1.42-.52.08-1.17.11-1.89-.12-.44-.14-1-.32-1.71-.63-3.02-1.3-4.99-4.34-5.14-4.54-.15-.2-1.23-1.63-1.23-3.11 0-1.48.78-2.21 1.05-2.51.27-.3.59-.38.79-.38.2 0 .39 0 .57.01.18.01.43-.07.67.51.25.6.85 2.07.92 2.22.08.15.13.33.03.53-.1.2-.15.32-.3.5-.15.18-.32.4-.45.53-.15.15-.31.32-.13.63.18.3.8 1.32 1.72 2.14 1.18 1.06 2.18 1.39 2.49 1.55.31.16.49.13.67-.08.18-.2.78-.91.98-1.22.2-.31.41-.26.69-.16.28.1 1.78.84 2.09.99.31.15.51.23.59.35.08.13.08.73-.17 1.43z"/></svg>
                        Commander sur WhatsApp
                    </button>
                    <p class="text-center text-xs text-pitch-500">
                        {{ $globalSite->deliveryInfo }} · Paiement à la livraison (Mobile Money / espèces) · Prix en FCFA
                    </p>
                </div>

                @if ($product->description)
                <div class="mt-8">
                    <h2 class="text-lg font-bold text-pitch-900">Description</h2>
                    <div class="mt-2 prose prose-sm prose-pitch max-w-none text-pitch-700 leading-relaxed whitespace-pre-line">{{ $product->description }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@if ($related->isNotEmpty())
<section class="pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-grass-600 uppercase tracking-widest">À découvrir</p>
                <h2 class="mt-1 text-2xl font-bold text-pitch-900 tracking-tight">Maillots similaires</h2>
            </div>
        </div>
        <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            @foreach ($related as $relatedProduct)
                @include('partials.product-card', ['product' => $relatedProduct])
            @endforeach
        </div>
    </div>
</section>
@endif

@push('scripts')
<script>
(function() {
    const btn = document.getElementById('whatsapp-order-btn');
    const whatsappNumber = '{{ wa_number() }}';
    const productName = @json($product->name);
    const productClub = @json($product->club);
    const productSeason = @json($product->season);
    const productPrice = '{{ $product->formatPrice() }}';
    const productUrl = '{{ url()->current() }}';
    let selectedSize = null;

    document.querySelectorAll('.size-option').forEach(function(el) {
        el.addEventListener('click', function() {
            document.querySelectorAll('.size-option').forEach(function(x) {
                x.classList.remove('border-grass-500', 'text-grass-600', 'bg-grass-50');
            });
            el.classList.add('border-grass-500', 'text-grass-600', 'bg-grass-50');
            selectedSize = el.dataset.size;
        });
    });

    document.querySelectorAll('.gallery-thumb').forEach(function(el) {
        el.addEventListener('click', function() {
            const main = document.querySelector('.aspect-\\[4\\/5\\]');
            document.querySelectorAll('.gallery-thumb').forEach(function(x) {
                x.classList.remove('border-grass-500');
            });
            el.classList.add('border-grass-500');
            const img = el.querySelector('img');
            if (img && main && main.tagName === 'IMG') {
                main.src = img.src;
            }
        });
    });

    if (btn) {
        btn.addEventListener('click', function() {
            if (!whatsappNumber) {
                alert('Le numéro WhatsApp n\'est pas encore configuré. Contactez l\'administrateur du site.');
                return;
            }
            const message = 'Bonjour ' + @json($globalSite->name) + ' ! Je souhaite commander :' +
                '\n- Produit : ' + productName +
                (productClub ? '\n- Club : ' + productClub : '') +
                (productSeason ? '\n- Saison : ' + productSeason : '') +
                (selectedSize ? '\n- Taille : ' + selectedSize : '') +
                '\n- Prix : ' + productPrice +
                '\n- Lien : ' + productUrl;
            window.open('https://wa.me/' + whatsappNumber + '?text=' + encodeURIComponent(message), '_blank');
        });
    }
})();
</script>
@endpush

@endsection
