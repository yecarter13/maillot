<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin | ' . $globalSite->name)</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-pitch-50 min-h-screen">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="fixed inset-y-0 left-0 z-40 w-64 bg-pitch-950 hidden lg:flex flex-col">
            <div class="flex items-center gap-2.5 px-5 h-16 border-b border-pitch-800">
                <div class="w-8 h-8 bg-grass-500 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 4h10a3 3 0 013 3v2.5c-2.4 1.6-4 4.2-4 7 0 2.8 1.6 5.4 4 7V26a3 3 0 01-3 3H7a3 3 0 01-3-3v-2.5c2.4-1.6 4-4.2 4-7 0-2.8-1.6-5.4-4-7V7a3 3 0 013-3zm4 9a1 1 0 100 2 1 1 0 000-2zm2 0a1 1 0 100 2 1 1 0 000-2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold leading-tight">{{ $globalSite->name }}</p>
                    <p class="text-[10px] text-pitch-400 uppercase tracking-wider">Espace Admin</p>
                </div>
            </div>
            <nav class="flex-1 py-4 px-3 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-grass-500 text-white' : 'text-pitch-300 hover:bg-pitch-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Tableau de bord
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-grass-500 text-white' : 'text-pitch-300 hover:bg-pitch-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3l6 0 3 3v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6l3-3zm-2 3h10m-6 5a2 2 0 100 4 2 2 0 000-4z"/></svg>
                    Maillots
                </a>
                <a href="{{ route('admin.championships.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.championships.*') ? 'bg-grass-500 text-white' : 'text-pitch-300 hover:bg-pitch-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    Championnats
                </a>
                <a href="{{ route('admin.customer-photos.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.customer-photos.*') ? 'bg-grass-500 text-white' : 'text-pitch-300 hover:bg-pitch-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Photothèque
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-grass-500 text-white' : 'text-pitch-300 hover:bg-pitch-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Administrateurs
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-grass-500 text-white' : 'text-pitch-300 hover:bg-pitch-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Paramètres
                </a>
            </nav>
            <div class="p-4 border-t border-pitch-800">
                <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 text-sm text-pitch-300 hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Voir le site
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 w-full px-3 py-2 text-sm text-pitch-300 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN --}}
        <div class="flex-1 lg:pl-64 flex flex-col min-h-screen">
            <header class="sticky top-0 z-30 bg-white border-b border-pitch-100 shadow-sm">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <button id="admin-sidebar-toggle" class="lg:hidden p-2 text-pitch-600 hover:bg-pitch-100 rounded-lg transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <div>
                            <h1 class="text-base font-bold text-pitch-900 leading-tight">@yield('title', 'Tableau de bord')</h1>
                            <p class="text-xs text-pitch-400 hidden sm:block">Bienvenue, {{ auth()->user()->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.products.create') }}" class="hidden sm:inline-flex items-center gap-2 px-3 py-2 text-sm font-semibold text-white bg-grass-600 border border-grass-600 rounded-lg hover:bg-grass-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Nouveau maillot
                        </a>
                        <div class="w-9 h-9 rounded-full bg-pitch-900 text-white flex items-center justify-center text-sm font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
                <div id="admin-mobile-nav" class="lg:hidden hidden border-t border-pitch-100 bg-white">
                    <nav class="flex flex-col p-3 gap-1">
                        <a href="{{ route('admin.dashboard') }}" class="px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-grass-500 text-white' : 'text-pitch-700 hover:bg-pitch-100' }}">Tableau de bord</a>
                        <a href="{{ route('admin.products.index') }}" class="px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.products.*') ? 'bg-grass-500 text-white' : 'text-pitch-700 hover:bg-pitch-100' }}">Maillots</a>
                        <a href="{{ route('admin.championships.index') }}" class="px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.championships.*') ? 'bg-grass-500 text-white' : 'text-pitch-700 hover:bg-pitch-100' }}">Championnats</a>
                        <a href="{{ route('admin.customer-photos.index') }}" class="px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.customer-photos.*') ? 'bg-grass-500 text-white' : 'text-pitch-700 hover:bg-pitch-100' }}">Photothèque</a>
                        <a href="{{ route('admin.users.index') }}" class="px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-grass-500 text-white' : 'text-pitch-700 hover:bg-pitch-100' }}">Administrateurs</a>
                        <a href="{{ route('admin.settings.index') }}" class="px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.settings.*') ? 'bg-grass-500 text-white' : 'text-pitch-700 hover:bg-pitch-100' }}">Paramètres</a>
                        <a href="{{ route('home') }}" class="px-3 py-2.5 rounded-lg text-sm font-medium text-pitch-700 hover:bg-pitch-100">Voir le site</a>
                    </nav>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if (session('success'))
                <div class="mb-6 bg-grass-50 border border-grass-200 text-grass-800 text-sm rounded-xl px-4 py-3 flex items-center gap-2">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
                @endif
                @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3 flex items-center gap-2">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    {{ $errors->first() }}
                </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')

    <script>
        document.getElementById('admin-sidebar-toggle')?.addEventListener('click', function() {
            document.getElementById('admin-mobile-nav').classList.toggle('hidden');
        });
    </script>
</body>
</html>
