<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion Admin | {{ $globalSite->name }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-pitch-950 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <a href="{{ route('home') }}" class="flex items-center justify-center gap-2.5 mb-8 group">
            <div class="w-10 h-10 bg-grass-500 rounded-xl flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 4h10a3 3 0 013 3v2.5c-2.4 1.6-4 4.2-4 7 0 2.8 1.6 5.4 4 7V26a3 3 0 01-3 3H7a3 3 0 01-3-3v-2.5c2.4-1.6 4-4.2 4-7 0-2.8-1.6-5.4-4-7V7a3 3 0 013-3zm4 9a1 1 0 100 2 1 1 0 000-2zm2 0a1 1 0 100 2 1 1 0 000-2z"/>
                </svg>
            </div>
            <span class="text-2xl font-bold text-white tracking-tight">{{ $globalSite->name }}</span>
        </a>

        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h1 class="text-xl font-bold text-pitch-900">Espace Administrateur</h1>
            <p class="mt-1 text-sm text-pitch-500">Connectez-vous pour gérer la boutique.</p>

            @if ($errors->any())
            <div class="mt-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg px-4 py-3">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login.attempt') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-pitch-800 mb-1.5">Adresse e-mail</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-pitch-800 mb-1.5">Mot de passe</label>
                    <input type="password" name="password" id="password" required
                           class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-pitch-600">
                        <input type="checkbox" name="remember" class="rounded border-pitch-300 text-grass-500 focus:ring-grass-500">
                        Se souvenir de moi
                    </label>
                    <a href="{{ route('home') }}" class="text-sm text-grass-600 hover:text-grass-700 font-medium">← Retour au site</a>
                </div>
                <button type="submit"
                        class="w-full py-3 bg-pitch-950 hover:bg-pitch-800 text-white font-semibold rounded-xl transition-colors">
                    Se connecter
                </button>
            </form>
        </div>
    </div>

</body>
</html>
