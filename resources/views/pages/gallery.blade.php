@extends('layouts.master')

@section('title', 'Photothèque — Clients satisfaits | ' . $globalSite->name)
@section('meta_description', 'Découvrez les photos de nos clients satisfaits partout au Cameroun. Commandez vos maillots sur WhatsApp et rejoignez la famille ' . $globalSite->name . ' !')

@section('content')

<section class="bg-pitch-950 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-grass-500/15 text-grass-400 text-xs font-semibold border border-grass-500/30">
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l1.9 5.7L20 8l-4.5 3.9 1.4 5.6L12 14.4 7.1 17.5l1.4-5.6L4 8l6.1-.3z"/></svg>
            Plus de 500 clients satisfaits
        </span>
        <h1 class="mt-4 text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Photothèque de nos clients</h1>
        <p class="mt-3 text-pitch-300 max-w-2xl mx-auto">
            Des maillots livrés aux quatre coins du Cameroun. Regardez : ces sourires en disent long sur la qualité de nos produits et notre service.
        </p>
        @if ($globalSite->whatsapp)
        <a href="{{ wa_link('Bonjour ' . $globalSite->name . ' ! Je souhaite passer une commande.') }}" target="_blank" rel="noopener" class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-grass-500 hover:bg-grass-600 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 shadow-lg shadow-grass-500/25">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 004.74 1.21c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.86 9.86 0 0012.04 2zm5.83 14.12c-.25.7-1.45 1.33-2.02 1.42-.52.08-1.17.11-1.89-.12-.44-.14-1-.32-1.71-.63-3.02-1.3-4.99-4.34-5.14-4.54-.15-.2-1.23-1.63-1.23-3.11 0-1.48.78-2.21 1.05-2.51.27-.3.59-.38.79-.38.2 0 .39 0 .57.01.18.01.43-.07.67.51.25.6.85 2.07.92 2.22.08.15.13.33.03.53-.1.2-.15.32-.3.5-.15.18-.32.4-.45.53-.15.15-.31.32-.13.63.18.3.8 1.32 1.72 2.14 1.18 1.06 2.18 1.39 2.49 1.55.31.16.49.13.67-.08.18-.2.78-.91.98-1.22.2-.31.41-.26.69-.16.28.1 1.78.84 2.09.99.31.15.51.23.59.35.08.13.08.73-.17 1.43z"/></svg>
            Commander sur WhatsApp
        </a>
        @endif
    </div>
</section>

<section class="py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($photos->isNotEmpty())
        <div class="columns-1 sm:columns-2 lg:columns-3 gap-4 sm:gap-5 [column-fill:_balance]">
            @foreach ($photos as $photo)
            <figure class="group relative mb-4 sm:mb-5 break-inside-avoid bg-white rounded-2xl overflow-hidden border border-pitch-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="relative overflow-hidden bg-pitch-50">
                    @if ($photo->image_url)
                    <img src="{{ $photo->image_url }}" alt="Client satisfait : {{ $photo->customer_name }}" loading="lazy" class="w-full object-cover group-hover:scale-105 transition-transform duration-500 {{ $loop->index % 3 === 0 ? 'aspect-[4/5]' : ($loop->index % 3 === 1 ? 'aspect-square' : 'aspect-[4/3]') }}">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-pitch-950/70 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <div class="flex items-center gap-2">
                            <div class="w-9 h-9 rounded-full bg-grass-500 text-white flex items-center justify-center text-xs font-bold shrink-0">{{ strtoupper(substr($photo->customer_name, 0, 1)) }}</div>
                            <div>
                                <p class="text-white font-semibold text-sm leading-tight">{{ $photo->customer_name }}</p>
                                @if ($photo->location)
                                <p class="text-pitch-300 text-xs">{{ $photo->location }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if ($photo->message)
                <figcaption class="p-4">
                    <p class="text-sm text-pitch-700 leading-relaxed">« {{ $photo->message }} »</p>
                </figcaption>
                @endif
            </figure>
            @endforeach
        </div>
        <div class="mt-10">
            {{ $photos->links() }}
        </div>
        @else
        <div class="bg-white rounded-2xl border border-dashed border-pitch-200 p-14 text-center">
            <svg class="w-12 h-12 mx-auto text-pitch-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <h3 class="mt-4 font-semibold text-pitch-900">La photothèque arrive bientôt</h3>
            <p class="mt-1 text-sm text-pitch-500">Bientôt des photos de nos clients satisfaits.</p>
        </div>
        @endif
    </div>
</section>

@endsection
