<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="format-detection" content="telephone=no">
    <title>@yield('title', $globalSite->name . ' — Maillots de Foot & Sportifs au Cameroun')</title>
    <meta name="description" content="@yield('meta_description', 'Achetez vos maillots de football et tenues de sport préférés. Paiement à la livraison. Livraison partout au Cameroun. Commandez facilement sur WhatsApp.')">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    @yield('seo_head')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-pitch-900">

    @include('partials.header')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('partials.footer')

    @include('partials.floating-whatsapp')

    <script>
    function initSearchSuggest(inputId, suggestId) {
        const input = document.getElementById(inputId);
        const box = document.getElementById(suggestId);
        if (!input || !box) return;
        let timer;

        input.addEventListener('input', function() {
            clearTimeout(timer);
            const q = this.value.trim();
            if (q.length < 2) { box.classList.add('hidden'); return; }
            box.innerHTML = '<div class="flex items-center justify-center gap-2 px-4 py-3 text-pitch-400 text-sm"><svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Recherche...</div>';
            box.classList.remove('hidden');
            timer = setTimeout(() => {
                fetch('/shop/suggest?q=' + encodeURIComponent(q))
                    .then(r => r.json())
                    .then(d => {
                        if (!d.products?.length && !d.championships?.length) {
                            box.innerHTML = '<div class="px-4 py-3 text-sm text-pitch-400 text-center">Aucun maillot trouvé — essayez un autre nom</div><a href="/shop?search=' + encodeURIComponent(q) + '" onmousedown="window.location=this.href" class="block px-3 py-2 text-center text-xs font-medium text-grass-600 hover:bg-pitch-50 transition-colors border-t border-pitch-100">Voir tous les résultats →</a>';
                            box.classList.remove('hidden');
                            return;
                        }
                        let html = '';
                        if (d.championships?.length) {
                            html += '<div class="px-3 py-2 text-[11px] font-semibold text-pitch-400 uppercase tracking-wider bg-pitch-50">Championnats</div>';
                            d.championships.forEach(c => {
                                html += '<a href="/shop?championship=' + encodeURIComponent(c.slug) + '" onmousedown="window.location=this.href" class="flex items-center gap-2 px-3 py-2 text-sm text-pitch-700 hover:bg-pitch-50 transition-colors"><svg class="w-3.5 h-3.5 text-pitch-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>' + c.name + '</a>';
                            });
                        }
                        if (d.products?.length) {
                            html += '<div class="px-3 py-2 text-[11px] font-semibold text-pitch-400 uppercase tracking-wider bg-pitch-50 border-t border-pitch-100">Maillots</div>';
                            d.products.forEach(p => {
                                html += '<a href="/maillot/' + p.slug + '" onmousedown="window.location=this.href" class="flex items-center gap-3 px-3 py-2 hover:bg-pitch-50 transition-colors"><div class="w-8 h-8 bg-pitch-100 rounded-lg flex-shrink-0 overflow-hidden">' + (p.image ? '<img src="' + p.image + '" alt="" class="w-full h-full object-cover">' : '') + '</div><div class="flex-1 min-w-0"><p class="text-sm font-medium text-pitch-900 truncate">' + p.name + '</p><p class="text-xs text-pitch-400">' + (p.club ? p.club + ' · ' : '') + p.price + '</p></div></a>';
                            });
                        }
                        html += '<a href="/shop?search=' + encodeURIComponent(q) + '" class="block px-3 py-2 text-center text-xs font-medium text-grass-600 hover:bg-pitch-50 transition-colors border-t border-pitch-100" onmousedown="window.location=this.href">Voir tous les résultats →</a>';
                        box.innerHTML = html;
                        box.classList.remove('hidden');
                    });
            }, 300);
        });
        input.addEventListener('blur', function() {
            setTimeout(() => box.classList.add('hidden'), 200);
        });
        input.addEventListener('focus', function() {
            if (box.children.length) box.classList.remove('hidden');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        initSearchSuggest('search-desktop', 'suggest-desktop');
        initSearchSuggest('search-navbar-mobile', 'suggest-navbar-mobile');
    });
    </script>

    @stack('scripts')
</body>
</html>
