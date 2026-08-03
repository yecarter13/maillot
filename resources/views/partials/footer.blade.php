<footer id="contact" class="bg-pitch-950 text-pitch-300 border-t border-pitch-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-xl mx-auto text-center">
            <div class="flex items-center justify-center gap-2">
                <div class="w-8 h-8 bg-grass-500 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 4h10a3 3 0 013 3v2.5c-2.4 1.6-4 4.2-4 7 0 2.8 1.6 5.4 4 7V26a3 3 0 01-3 3H7a3 3 0 01-3-3v-2.5c2.4-1.6 4-4.2 4-7 0-2.8-1.6-5.4-4-7V7a3 3 0 013-3zm4 9a1 1 0 100 2 1 1 0 000-2zm2 0a1 1 0 100 2 1 1 0 000-2z"/>
                    </svg>
                </div>
                <span class="text-lg font-bold text-white">{{ $globalSite->name }}</span>
            </div>
            @if ($globalSite->slogan)
            <p class="mt-1 text-sm font-semibold text-grass-400 italic">« {{ $globalSite->slogan }} »</p>
            @endif
            <p class="mt-4 text-sm leading-relaxed">
                La boutique de référence au Cameroun pour les maillots de football et tenues de sport.
                Qualité premium, prix abordables en FCFA et {{ strtolower($globalSite->deliveryInfo) }}.
            </p>
        </div>

        <div class="mt-10 pt-6 border-t border-pitch-800 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-pitch-500">&copy; {{ date('Y') }} {{ $globalSite->name }} — Tous droits réservés.</p>
            <p class="text-xs text-pitch-500">Maillots &amp; tenues de sport · Cameroun 🇨🇲</p>
        </div>
    </div>
</footer>
