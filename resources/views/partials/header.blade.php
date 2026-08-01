<header class="sticky top-0 z-50 bg-pitch-950 shadow-xl border-b border-pitch-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14 lg:h-20">

            <div class="flex items-center gap-1 sm:gap-2 shrink-0 min-w-0">
                <a href="{{ route('home') }}" class="flex items-center gap-1.5 sm:gap-2.5 group">
                    <div class="w-8 h-8 bg-grass-500 rounded-lg hidden sm:flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 4h10a3 3 0 013 3v2.5c-2.4 1.6-4 4.2-4 7 0 2.8 1.6 5.4 4 7V26a3 3 0 01-3 3H7a3 3 0 01-3-3v-2.5c2.4-1.6 4-4.2 4-7 0-2.8-1.6-5.4-4-7V7a3 3 0 013-3zm4 9a1 1 0 100 2 1 1 0 000-2zm2 0a1 1 0 100 2 1 1 0 000-2z"/>
                        </svg>
                    </div>
                    <span class="flex flex-col leading-tight min-w-0">
                        <span class="text-sm sm:text-lg md:text-xl font-bold text-white tracking-tight whitespace-nowrap">{{ $globalSite->name }}</span>
                        @if ($globalSite->slogan)
                        <span class="hidden sm:block text-[10px] md:text-xs font-medium text-grass-400 tracking-wide">{{ $globalSite->slogan }}</span>
                        @endif
                    </span>
                </a>

                <nav class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-3 py-2 text-sm font-medium text-pitch-200 hover:text-white hover:bg-pitch-800 rounded-lg transition-all duration-200 {{ request()->routeIs('home') ? 'text-white bg-pitch-800' : '' }}">Accueil</a>
                    <a href="{{ route('shop') }}" class="px-3 py-2 text-sm font-medium text-pitch-200 hover:text-white hover:bg-pitch-800 rounded-lg transition-all duration-200 {{ request()->routeIs('shop*') ? 'text-white bg-pitch-800' : '' }}">Boutique</a>
                    <a href="{{ route('gallery.index') }}" class="px-3 py-2 text-sm font-medium text-pitch-200 hover:text-white hover:bg-pitch-800 rounded-lg transition-all duration-200 {{ request()->routeIs('gallery.*') ? 'text-white bg-pitch-800' : '' }}">Photothèque</a>
                    <a href="#championnats" class="px-3 py-2 text-sm font-medium text-pitch-200 hover:text-white hover:bg-pitch-800 rounded-lg transition-all duration-200">Championnats</a>
                    <a href="#contact" class="px-3 py-2 text-sm font-medium text-pitch-200 hover:text-white hover:bg-pitch-800 rounded-lg transition-all duration-200">Contact</a>
                </nav>
            </div>

            <div class="hidden md:flex items-center flex-1 max-w-md mx-4 lg:mx-10">
                <form action="{{ route('shop') }}" method="GET" class="relative w-full" autocomplete="off">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un club, un championnat, une équipe..."
                           class="w-full pl-10 pr-4 py-2 bg-pitch-800 border border-pitch-600 rounded-lg text-sm text-white placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500 transition-all duration-200" id="search-desktop">
                    <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2">
                        <svg class="w-4 h-4 text-pitch-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                    <div id="suggest-desktop" class="absolute top-full left-0 right-0 mt-1 bg-white rounded-xl shadow-xl border border-pitch-100 overflow-hidden hidden z-50"></div>
                </form>
            </div>

            <div class="flex md:hidden flex-1 min-w-0 mx-1">
                <form action="{{ route('shop') }}" method="GET" class="relative w-full" autocomplete="off">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..."
                           class="w-full pl-6 pr-1 py-1 bg-pitch-800 border border-pitch-600 rounded-lg text-[10px] leading-tight text-white placeholder-pitch-400 focus:outline-none focus:border-grass-500 transition-all" id="search-navbar-mobile">
                    <button type="submit" class="absolute left-1 top-1/2 -translate-y-1/2">
                        <svg class="w-3 h-3 text-pitch-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                    <div id="suggest-navbar-mobile" class="fixed top-14 left-0 right-0 bg-white rounded-none shadow-xl border-b border-pitch-100 hidden z-50"></div>
                </form>
            </div>

            <div class="flex items-center gap-0.5 sm:gap-2">
                @if ($globalSite->whatsapp)
                <a href="{{ wa_link('Bonjour ' . $globalSite->name . ' ! Je souhaite passer une commande.') }}" target="_blank" rel="noopener" class="hidden sm:flex p-2 text-grass-400 hover:text-white hover:bg-pitch-800 rounded-lg transition-all duration-200" title="Commander sur WhatsApp">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 004.74 1.21c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.86 9.86 0 0012.04 2zm5.83 14.12c-.25.7-1.45 1.33-2.02 1.42-.52.08-1.17.11-1.89-.12-.44-.14-1-.32-1.71-.63-3.02-1.3-4.99-4.34-5.14-4.54-.15-.2-1.23-1.63-1.23-3.11 0-1.48.78-2.21 1.05-2.51.27-.3.59-.38.79-.38.2 0 .39 0 .57.01.18.01.43-.07.67.51.25.6.85 2.07.92 2.22.08.15.13.33.03.53-.1.2-.15.32-.3.5-.15.18-.32.4-.45.53-.15.15-.31.32-.13.63.18.3.8 1.32 1.72 2.14 1.18 1.06 2.18 1.39 2.49 1.55.31.16.49.13.67-.08.18-.2.78-.91.98-1.22.2-.31.41-.26.69-.16.28.1 1.78.84 2.09.99.31.15.51.23.59.35.08.13.08.73-.17 1.43z"/>
                    </svg>
                </a>
                @endif

                <button id="mobile-menu-toggle" class="lg:hidden p-2 text-pitch-300 hover:text-white hover:bg-pitch-800 rounded-lg transition-all duration-200" title="Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="lg:hidden hidden pb-4 border-t border-pitch-800 mt-2 pt-4">
            <nav class="flex flex-col gap-1">
                <a href="{{ route('home') }}" class="px-4 py-3 text-sm font-medium text-pitch-200 hover:text-white hover:bg-pitch-800 rounded-lg transition-all {{ request()->routeIs('home') ? 'text-white bg-pitch-800' : '' }}">Accueil</a>
                <a href="{{ route('shop') }}" class="px-4 py-3 text-sm font-medium text-pitch-200 hover:text-white hover:bg-pitch-800 rounded-lg transition-all {{ request()->routeIs('shop*') ? 'text-white bg-pitch-800' : '' }}">Boutique</a>
                <a href="{{ route('gallery.index') }}" class="px-4 py-3 text-sm font-medium text-pitch-200 hover:text-white hover:bg-pitch-800 rounded-lg transition-all {{ request()->routeIs('gallery.*') ? 'text-white bg-pitch-800' : '' }}">Photothèque</a>
            </nav>
        </div>
    </div>
</header>

@push('scripts')
<script>
    document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
@endpush
