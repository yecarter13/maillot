@extends('layouts.master')

@section('title', ($activeChampionship ? $activeChampionship->name . ' — ' : '') . 'Boutique de Maillots | ' . $globalSite->name)
@section('meta_description', 'Découvrez tous nos maillots de football des plus grands championnats. Prix en FCFA, commande sur WhatsApp, livraison partout au Cameroun.')

@section('content')

<section class="bg-pitch-950 py-10 lg:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-xs text-pitch-400 mb-3">
            <a href="{{ route('home') }}" class="hover:text-grass-400 transition-colors">Accueil</a>
            <span class="mx-2">/</span>
            <span class="text-pitch-300">Boutique</span>
            @if ($activeChampionship)
            <span class="mx-2">/</span>
            <span class="text-grass-400 font-semibold">{{ $activeChampionship->name }}</span>
            @endif
        </nav>
        <h1 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">
            {{ $activeChampionship ? $activeChampionship->name : 'Tous les maillots' }}
        </h1>
        <p class="mt-2 text-sm text-pitch-300">{{ $products->total() }} maillot{{ $products->total() > 1 ? 's' : '' }} disponible{{ $products->total() > 1 ? 's' : '' }}</p>
    </div>
</section>

<section class="py-10 lg:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- FILTRES --}}
            <aside class="lg:col-span-1">
                <div class="lg:sticky lg:top-24 bg-white rounded-2xl border border-pitch-100 p-5">
                    <h2 class="font-semibold text-pitch-900 text-sm uppercase tracking-wider">Championnats</h2>
                    <div class="mt-3 flex flex-wrap lg:flex-col gap-2">
                        <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ !request('championship') ? 'bg-grass-500 text-white' : 'bg-pitch-50 text-pitch-700 hover:bg-pitch-100' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            Tous
                        </a>
                        @foreach ($championships as $champ)
                        <a href="{{ route('shop.championship', $champ->slug) }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request('championship') === $champ->slug ? 'bg-grass-500 text-white' : 'bg-pitch-50 text-pitch-700 hover:bg-pitch-100' }}">
                            {{ $champ->name }}
                        </a>
                        @endforeach
                    </div>

                    @if ($globalSite->whatsapp)
                    <div class="mt-6 pt-5 border-t border-pitch-100">
                        <a href="{{ wa_link('Bonjour ' . $globalSite->name . ' ! Je souhaite passer une commande.') }}" target="_blank" rel="noopener" class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-grass-500 hover:bg-grass-600 text-white text-sm font-semibold rounded-xl transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 004.74 1.21c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.86 9.86 0 0012.04 2zm5.83 14.12c-.25.7-1.45 1.33-2.02 1.42-.52.08-1.17.11-1.89-.12-.44-.14-1-.32-1.71-.63-3.02-1.3-4.99-4.34-5.14-4.54-.15-.2-1.23-1.63-1.23-3.11 0-1.48.78-2.21 1.05-2.51.27-.3.59-.38.79-.38.2 0 .39 0 .57.01.18.01.43-.07.67.51.25.6.85 2.07.92 2.22.08.15.13.33.03.53-.1.2-.15.32-.3.5-.15.18-.32.4-.45.53-.15.15-.31.32-.13.63.18.3.8 1.32 1.72 2.14 1.18 1.06 2.18 1.39 2.49 1.55.31.16.49.13.67-.08.18-.2.78-.91.98-1.22.2-.31.41-.26.69-.16.28.1 1.78.84 2.09.99.31.15.51.23.59.35.08.13.08.73-.17 1.43z"/></svg>
                            Commander
                        </a>
                    </div>
                    @endif
                </div>
            </aside>

            {{-- PRODUITS --}}
            <div class="lg:col-span-3">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-6">
                    @if (request('search'))
                    <p class="text-sm text-pitch-600">Résultats pour « <span class="font-semibold">{{ request('search') }}</span> »</p>
                    @else
                    <p></p>
                    @endif
                    <form action="{{ route('shop') }}" method="GET" class="flex items-center gap-2">
                        @if (request('championship'))
                        <input type="hidden" name="championship" value="{{ request('championship') }}">
                        @endif
                        @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <label for="sort" class="text-sm text-pitch-500 whitespace-nowrap">Trier :</label>
                        <select name="sort" id="sort" onchange="this.form.submit()" class="text-sm border border-pitch-200 rounded-lg px-3 py-2 bg-white text-pitch-800 focus:outline-none focus:border-grass-500">
                            <option value="newest" {{ request('sort') === 'newest' || !request('sort') ? 'selected' : '' }}>Nouveautés</option>
                            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                        </select>
                    </form>
                </div>

                @if ($products->isNotEmpty())
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                    @foreach ($products as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
                @else
                <div class="bg-white rounded-2xl border border-dashed border-pitch-200 p-12 text-center">
                    <svg class="w-12 h-12 mx-auto text-pitch-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <h3 class="mt-4 font-semibold text-pitch-900">Aucun maillot trouvé</h3>
                    <p class="mt-1 text-sm text-pitch-500">Essayez un autre club, championnat ou mot-clé.</p>
                    <a href="{{ route('shop') }}" class="inline-block mt-5 px-5 py-2.5 bg-pitch-950 text-white text-sm font-semibold rounded-lg hover:bg-pitch-800 transition-colors">Voir tous les maillots</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
