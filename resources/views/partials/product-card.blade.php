@php
    $card = $product ?? $p ?? null;
@endphp
@if ($card)
<a href="{{ route('product.show', $card->slug) }}" class="group bg-white rounded-2xl overflow-hidden border border-pitch-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 flex flex-col">
    <div class="relative aspect-[4/5] overflow-hidden bg-pitch-50">
        @if ($card->image_url)
        <img src="{{ $card->image_url }}" alt="{{ $card->name }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
        <div class="w-full h-full flex items-center justify-center text-pitch-300">
            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        @endif
        <div class="absolute top-3 left-3 flex flex-col gap-1.5">
            @if ($card->is_new)
            <span class="bg-grass-500 text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full shadow">Nouveau</span>
            @endif
            @if ($card->old_price)
            <span class="bg-flame text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full shadow">Promo</span>
            @endif
        </div>
        @if ($card->championship)
        <span class="absolute bottom-3 left-3 bg-pitch-950/80 backdrop-blur text-white text-[11px] font-semibold px-2.5 py-1 rounded-full">{{ $card->championship->name }}</span>
        @endif
    </div>
    <div class="p-4 flex flex-col flex-1">
        @if ($card->club)
        <p class="text-xs font-semibold text-grass-600 uppercase tracking-wide">{{ $card->club }}</p>
        @endif
        <h3 class="mt-0.5 text-sm font-semibold text-pitch-900 group-hover:text-pitch-600 transition-colors line-clamp-2">{{ $card->name }}</h3>
        @if ($card->season)
        <p class="text-xs text-pitch-400 mt-0.5">{{ $card->season }}</p>
        @endif
        <div class="mt-3 pt-3 border-t border-pitch-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2.5 sm:gap-2">
            <div class="sm:flex-none">
                @if ($card->old_price)
                <p class="text-xs text-pitch-400 line-through">{{ $card->formatOldPrice() }}</p>
                @endif
                <p class="font-bold text-pitch-900 {{ $card->old_price ? 'text-grass-600' : '' }}">{{ $card->formatPrice() }}</p>
            </div>
            <span class="inline-flex items-center justify-center gap-1.5 w-full sm:w-auto px-3 py-2 bg-pitch-950 hover:bg-grass-600 text-white text-xs font-semibold rounded-lg transition-colors">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 004.74 1.21c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.86 9.86 0 0012.04 2zm5.83 14.12c-.25.7-1.45 1.33-2.02 1.42-.52.08-1.17.11-1.89-.12-.44-.14-1-.32-1.71-.63-3.02-1.3-4.99-4.34-5.14-4.54-.15-.2-1.23-1.63-1.23-3.11 0-1.48.78-2.21 1.05-2.51.27-.3.59-.38.79-.38.2 0 .39 0 .57.01.18.01.43-.07.67.51.25.6.85 2.07.92 2.22.08.15.13.33.03.53-.1.2-.15.32-.3.5-.15.18-.32.4-.45.53-.15.15-.31.32-.13.63.18.3.8 1.32 1.72 2.14 1.18 1.06 2.18 1.39 2.49 1.55.31.16.49.13.67-.08.18-.2.78-.91.98-1.22.2-.31.41-.26.69-.16.28.1 1.78.84 2.09.99.31.15.51.23.59.35.08.13.08.73-.17 1.43z"/></svg>
                WhatsApp
            </span>
        </div>
    </div>
</a>
@endif
