@extends('layouts.master')

@section('title', $globalSite->name . ' — Maillots de Foot & Sportifs au Cameroun')
@section('meta_description', 'Achetez vos maillots de football des plus grands championnats : Ligue 1, Premier League, Liga, Serie A, et plus. Paiement à la livraison, commande sur WhatsApp, livraison partout au Cameroun.')

@section('content')

{{-- HERO --}}
<section class="relative bg-pitch-950 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ $heroImage }}" alt="" class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0 bg-gradient-to-r from-pitch-950 via-pitch-950/80 to-pitch-950/40"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
        <div class="max-w-2xl animate-fade-in">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-grass-500/15 text-grass-400 text-xs font-semibold border border-grass-500/30">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l1.9 5.7L20 8l-4.5 3.9 1.4 5.6L12 14.4 7.1 17.5l1.4-5.6L4 8l6.1-.3z"/></svg>
                Paiement à la livraison · Livraison partout au Cameroun
            </span>
            <h1 class="mt-5 text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
                {{ $heroTitle }}
            </h1>
            @if ($globalSite->slogan)
            <p class="mt-3 inline-flex items-center gap-2 text-lg sm:text-xl font-bold text-flame italic">
                <svg class="w-5 h-5 text-grass-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l1.9 5.7L20 8l-4.5 3.9 1.4 5.6L12 14.4 7.1 17.5l1.4-5.6L4 8l6.1-.3z"/></svg>
                {{ $globalSite->slogan }}
            </p>
            @endif
            <p class="mt-4 text-base sm:text-lg text-pitch-300 leading-relaxed max-w-xl">
                {{ $heroSubtitle }}
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-grass-500 hover:bg-grass-600 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 shadow-lg shadow-grass-500/25">
                    Voir la boutique
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="#championnats" class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl transition-colors border border-white/20">
                    Par championnat
                </a>
            </div>
        </div>
    </div>
</section>

{{-- CHAMPIONNATS --}}
<section id="championnats" class="py-16 lg:py-20 bg-pitch-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-grass-600 uppercase tracking-widest">Nos Championnats</p>
                <h2 class="mt-1 text-2xl sm:text-3xl font-bold text-pitch-900 tracking-tight">Choisissez votre championnat</h2>
            </div>
            <a href="{{ route('shop') }}" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold text-pitch-600 hover:text-grass-600 transition-colors">
                Tout voir <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        @if ($championships->isNotEmpty())
        <div class="mt-8 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($championships as $champ)
            <a href="{{ route('shop.championship', $champ->slug) }}" class="group bg-white rounded-2xl border border-pitch-100 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 text-center">
                <div class="aspect-square bg-pitch-50 flex items-center justify-center p-4">
                    @if ($champ->image_url)
                    <img src="{{ $champ->image_url }}" alt="{{ $champ->name }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-pitch-300">
                        <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="p-3 border-t border-pitch-100">
                    <p class="text-sm font-bold text-pitch-900 group-hover:text-grass-600 transition-colors">{{ $champ->name }}</p>
                    <p class="text-xs text-pitch-400 mt-0.5">{{ $champ->products_count }} maillot{{ $champ->products_count > 1 ? 's' : '' }}</p>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="mt-8 bg-white rounded-2xl border border-dashed border-pitch-200 p-10 text-center">
            <p class="text-pitch-500">Aucun championnat pour le moment. Revenez bientôt !</p>
        </div>
        @endif
    </div>
</section>

{{-- NOUVEAUTES --}}
@if ($newArrivals->isNotEmpty())
<section class="py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-grass-600 uppercase tracking-widest">Fraîchement arrivés</p>
                <h2 class="mt-1 text-2xl sm:text-3xl font-bold text-pitch-900 tracking-tight">Nouveaux maillots</h2>
            </div>
            <a href="{{ route('shop') }}" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold text-pitch-600 hover:text-grass-600 transition-colors">
                Tout voir <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        <div class="mt-8 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach ($newArrivals as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- AVANTAGES --}}
<section class="py-16 bg-pitch-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex gap-4">
                <div class="w-12 h-12 shrink-0 bg-grass-500/15 border border-grass-500/30 rounded-xl flex items-center justify-center text-grass-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <div>
                    <h3 class="text-white font-semibold">Commande via WhatsApp</h3>
                    <p class="mt-1 text-sm text-pitch-300">Un clic et votre commande est prête. Discutez directement avec notre équipe sur WhatsApp.</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="w-12 h-12 shrink-0 bg-grass-500/15 border border-grass-500/30 rounded-xl flex items-center justify-center text-grass-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <h3 class="text-white font-semibold">Paiement à la livraison</h3>
                    <p class="mt-1 text-sm text-pitch-300">Payez en FCFA à la réception. Mobile Money (MTN, Orange) et espèces acceptés.</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="w-12 h-12 shrink-0 bg-grass-500/15 border border-grass-500/30 rounded-xl flex items-center justify-center text-grass-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div>
                    <h3 class="text-white font-semibold">{{ $globalSite->deliveryInfo }}</h3>
                    <p class="mt-1 text-sm text-pitch-300">Expédition rapide sous 24-48h vers toutes les villes : Douala, Yaoundé, Bafoussam, Garoua…</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PHOTOTHEQUE --}}
@php
    $photoCount = $customerPhotos->count();
@endphp
@if ($photoCount > 0)
<section id="phototheque" class="py-16 lg:py-20 bg-pitch-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-sm font-semibold text-grass-600 uppercase tracking-widest">Photothèque</p>
            <h2 class="mt-1 text-2xl sm:text-3xl font-bold text-pitch-900 tracking-tight">Ils nous ont fait confiance</h2>
        </div>

        {{-- CARROUSEL DEFILANT --}}
        <div class="mt-10 overflow-hidden">
            <div class="flex w-max animate-marquee">
                <div class="flex gap-4 sm:gap-5">
                    @foreach ($customerPhotos as $photo)
                    <figure data-gallery="phototheque" data-src="{{ $photo->image_url }}" data-caption="{{ $photo->customer_name }}{{ $photo->location ? ' · ' . $photo->location : '' }}" class="relative shrink-0 w-40 sm:w-56 lg:w-72 rounded-2xl overflow-hidden bg-pitch-900 shadow-md cursor-pointer">
                        @if ($photo->image_url)
                        <img src="{{ $photo->image_url }}" alt="Client satisfait : {{ $photo->customer_name }}" loading="lazy" class="w-full h-40 sm:h-48 lg:h-56 object-cover">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-pitch-950/80 via-pitch-950/10 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-3 text-left">
                            <p class="text-white font-semibold text-sm leading-tight">{{ $photo->customer_name }}</p>
                            @if ($photo->location)
                            <p class="text-pitch-300 text-xs">{{ $photo->location }}</p>
                            @endif
                        </div>
                    </figure>
                    @endforeach
                </div>
                <div class="flex gap-4 sm:gap-5" aria-hidden="true">
                    @foreach ($customerPhotos as $photo)
                    <figure data-gallery="phototheque" data-src="{{ $photo->image_url }}" data-caption="{{ $photo->customer_name }}{{ $photo->location ? ' · ' . $photo->location : '' }}" class="relative shrink-0 w-40 sm:w-56 lg:w-72 rounded-2xl overflow-hidden bg-pitch-900 shadow-md cursor-pointer">
                        @if ($photo->image_url)
                        <img src="{{ $photo->image_url }}" alt="" loading="lazy" class="w-full h-40 sm:h-48 lg:h-56 object-cover">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-pitch-950/80 via-pitch-950/10 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-3 text-left">
                            <p class="text-white font-semibold text-sm leading-tight">{{ $photo->customer_name }}</p>
                            @if ($photo->location)
                            <p class="text-pitch-300 text-xs">{{ $photo->location }}</p>
                            @endif
                        </div>
                    </figure>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-pitch-950 hover:bg-pitch-800 text-white font-semibold rounded-xl transition-colors">
                Voir toutes les photothèques
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

{{-- FAQ --}}
<section id="faq" class="py-16 lg:py-20 bg-pitch-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-sm font-semibold text-grass-600 uppercase tracking-widest">Questions fréquentes</p>
            <h2 class="mt-1 text-2xl sm:text-3xl font-bold text-pitch-900 tracking-tight">FAQ</h2>
            <p class="mt-3 text-sm text-pitch-500">Tout ce qu'il faut savoir avant de commander.</p>
        </div>
        <div class="mt-10 space-y-3">
            @php
                $faqs = [
                    ['q' => 'Comment passer une commande ?', 'a' => 'Sélectionnez vos maillots, puis cliquez sur « Commander sur WhatsApp » ou contactez-nous directement sur WhatsApp. Confirmez vos tailles et votre adresse de livraison, et c\'est tout !'],
                    ['q' => 'Quels sont les moyens de paiement ?', 'a' => 'Nous acceptons le paiement à la livraison en espèces ainsi que Mobile Money (MTN Mobile Money et Orange Money).'],
                    ['q' => 'Livrez-vous partout au Cameroun ?', 'a' => 'Oui, nous livrons dans toutes les villes du Cameroun : Douala, Yaoundé, Bafoussam, Garoua, Limbé, Kribi, etc.'],
                    ['q' => 'Combien de temps prend la livraison ?', 'a' => 'La livraison prend généralement 24 à 48 heures après confirmation de votre commande.'],
                    ['q' => 'Les maillots sont-ils de bonne qualité ?', 'a' => 'Nos maillots sont en tissu respirant et confortable, avec une impression haute qualité, fidèles aux photos présentées.'],
                    ['q' => 'Puis-je personnaliser mon maillot (nom, numéro) ?', 'a' => 'Oui, la personnalisation (flocage nom et numéro) est disponible sur demande via WhatsApp.'],
                    ['q' => 'Comment choisir ma taille ?', 'a' => 'Nos tailles sont fidèles au standard (S à XXL). Si vous hésitez entre deux tailles, choisissez la plus grande, ou demandez-nous conseil sur WhatsApp.'],
                ];
            @endphp
            @foreach ($faqs as $i => $faq)
            <details class="group bg-white rounded-2xl border border-pitch-100 shadow-sm open:shadow-md transition-shadow" {{ $i === 0 ? 'open' : '' }}>
                <summary class="flex items-center justify-between gap-4 cursor-pointer list-none px-5 py-4">
                    <span class="text-sm sm:text-base font-semibold text-pitch-900">{{ $faq['q'] }}</span>
                    <svg class="w-5 h-5 shrink-0 text-grass-600 transition-transform duration-300 group-open:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </summary>
                <div class="px-5 pb-5">
                    <p class="text-sm text-pitch-600 leading-relaxed">{{ $faq['a'] }}</p>
                </div>
            </details>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA FINAL --}}
<section class="py-16 lg:py-20 bg-gradient-to-r from-grass-700 to-grass-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">Prêt à porter les couleurs de votre club ?</h2>
        <p class="mt-3 text-grass-100 max-w-xl mx-auto">Découvrez toute notre collection de maillots authentiques et commandez en quelques secondes sur WhatsApp.</p>
        <div class="mt-7 flex flex-wrap justify-center gap-3">
            <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-white hover:bg-pitch-50 text-grass-700 font-bold rounded-xl transition-all duration-300 hover:scale-105 shadow-xl">
                Parcourir la boutique
            </a>
            @if ($globalSite->whatsapp)
            <a href="{{ wa_link('Bonjour ' . $globalSite->name . ' ! Je souhaite passer une commande.') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-7 py-3.5 bg-pitch-950 hover:bg-pitch-900 text-white font-bold rounded-xl transition-all duration-300 hover:scale-105 shadow-xl">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 004.74 1.21c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.86 9.86 0 0012.04 2zm5.83 14.12c-.25.7-1.45 1.33-2.02 1.42-.52.08-1.17.11-1.89-.12-.44-.14-1-.32-1.71-.63-3.02-1.3-4.99-4.34-5.14-4.54-.15-.2-1.23-1.63-1.23-3.11 0-1.48.78-2.21 1.05-2.51.27-.3.59-.38.79-.38.2 0 .39 0 .57.01.18.01.43-.07.67.51.25.6.85 2.07.92 2.22.08.15.13.33.03.53-.1.2-.15.32-.3.5-.15.18-.32.4-.45.53-.15.15-.31.32-.13.63.18.3.8 1.32 1.72 2.14 1.18 1.06 2.18 1.39 2.49 1.55.31.16.49.13.67-.08.18-.2.78-.91.98-1.22.2-.31.41-.26.69-.16.28.1 1.78.84 2.09.99.31.15.51.23.59.35.08.13.08.73-.17 1.43z"/></svg>
                Commander sur WhatsApp
            </a>
            @endif
        </div>
    </div>
</section>

{{-- AVIS CLIENTS --}}
@if ($testimonials)
<section class="py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-sm font-semibold text-grass-600 uppercase tracking-widest">Ils nous font confiance</p>
            <h2 class="mt-1 text-2xl sm:text-3xl font-bold text-pitch-900 tracking-tight">Ce que disent nos clients</h2>
        </div>
        <div class="mt-10 flex gap-6 overflow-x-auto pb-4 snap-x snap-mandatory md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-6 md:overflow-visible md:pb-0">
            @foreach ($testimonials as $t)
            <div class="bg-white rounded-2xl border border-pitch-100 p-6 shadow-sm flex flex-col shrink-0 w-[85%] sm:w-[60%] md:w-auto snap-center">
                <div class="flex items-center gap-0.5 text-amber-400">
                    @for ($i = 0; $i < 5; $i++)
                    <svg class="w-4 h-4 {{ $i < $t->rating ? '' : 'opacity-25' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.958a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.367 2.446a1 1 0 00-.363 1.118l1.287 3.957c.3.922-.755 1.688-1.539 1.118l-3.366-2.446a1 1 0 00-1.175 0l-3.366 2.446c-.784.57-1.838-.196-1.539-1.118l1.287-3.957a1 1 0 00-.363-1.118L2.05 9.385c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.3-3.958z"/></svg>
                    @endfor
                </div>
                <p class="mt-3 text-sm text-pitch-700 leading-relaxed flex-1">« {{ $t->text }} »</p>
                <div class="mt-4 pt-4 border-t border-pitch-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-pitch-900 text-white flex items-center justify-center text-sm font-bold">{{ strtoupper(substr($t->name, 0, 1)) }}</div>
                    <div>
                        <p class="text-sm font-semibold text-pitch-900">{{ $t->name }}</p>
                        <p class="text-xs text-pitch-400">{{ $t->location }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
