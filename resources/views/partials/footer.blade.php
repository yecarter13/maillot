<footer id="contact" class="bg-pitch-950 text-pitch-300 border-t border-pitch-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-grass-500 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 4h10a3 3 0 013 3v2.5c-2.4 1.6-4 4.2-4 7 0 2.8 1.6 5.4 4 7V26a3 3 0 01-3 3H7a3 3 0 01-3-3v-2.5c2.4-1.6 4-4.2 4-7 0-2.8-1.6-5.4-4-7V7a3 3 0 013-3zm4 9a1 1 0 100 2 1 1 0 000-2zm2 0a1 1 0 100 2 1 1 0 000-2z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-white">{{ $globalSite->name }}</span>
                </div>
                <p class="mt-4 text-sm leading-relaxed">
                    La boutique de référence au Cameroun pour les maillots de football et tenues de sport.
                    Qualité premium, prix abordables en FCFA et {{ strtolower($globalSite->deliveryInfo) }}.
                </p>
            </div>

            <div>
                <h3 class="text-white font-semibold text-sm uppercase tracking-wider mb-4">Navigation</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-grass-400 transition-colors">Accueil</a></li>
                    <li><a href="{{ route('shop') }}" class="hover:text-grass-400 transition-colors">Boutique</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="hover:text-grass-400 transition-colors">Photothèque</a></li>
                    <li><a href="#championnats" class="hover:text-grass-400 transition-colors">Championnats</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-semibold text-sm uppercase tracking-wider mb-4">Commander</h3>
                @if ($globalSite->whatsapp)
                <a href="{{ wa_link('Bonjour ' . $globalSite->name . ' ! Je souhaite passer une commande.') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-4 py-2.5 bg-grass-600 hover:bg-grass-500 text-white text-sm font-semibold rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 004.74 1.21c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.86 9.86 0 0012.04 2zm5.83 14.12c-.25.7-1.45 1.33-2.02 1.42-.52.08-1.17.11-1.89-.12-.44-.14-1-.32-1.71-.63-3.02-1.3-4.99-4.34-5.14-4.54-.15-.2-1.23-1.63-1.23-3.11 0-1.48.78-2.21 1.05-2.51.27-.3.59-.38.79-.38.2 0 .39 0 .57.01.18.01.43-.07.67.51.25.6.85 2.07.92 2.22.08.15.13.33.03.53-.1.2-.15.32-.3.5-.15.18-.32.4-.45.53-.15.15-.31.32-.13.63.18.3.8 1.32 1.72 2.14 1.18 1.06 2.18 1.39 2.49 1.55.31.16.49.13.67-.08.18-.2.78-.91.98-1.22.2-.31.41-.26.69-.16.28.1 1.78.84 2.09.99.31.15.51.23.59.35.08.13.08.73-.17 1.43z"/>
                    </svg>
                    Commander sur WhatsApp
                </a>
                <p class="mt-4 text-sm">Réponse rapide, paiement à la livraison (Mobile Money, espèces), expédition sous 24-48h.</p>
                @else
                <p class="text-sm">Commandez directement sur WhatsApp — le numéro sera bientôt disponible. Gérez-le depuis l'espace admin (Paramètres).</p>
                @endif
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-pitch-800 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-pitch-500">&copy; {{ date('Y') }} {{ $globalSite->name }} — Tous droits réservés.</p>
            <p class="text-xs text-pitch-500">Maillots &amp; tenues de sport · Cameroun 🇨🇲</p>
        </div>
    </div>
</footer>
