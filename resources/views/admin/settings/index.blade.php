@extends('admin.layouts.master')

@section('title', 'Paramètres | ' . $globalSite->name)

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <h2 class="text-lg font-bold text-pitch-900">Paramètres du site</h2>
        <p class="text-sm text-pitch-500">Configurez le nom, le numéro WhatsApp et les textes de la boutique.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf

        <div class="bg-white rounded-2xl border border-pitch-100 p-6 space-y-5">
            <h3 class="text-sm font-bold text-pitch-900 uppercase tracking-wider text-grass-700">Identité</h3>
            <div>
                <label for="site_name" class="block text-sm font-medium text-pitch-800 mb-1.5">Nom de la boutique *</label>
                <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $settings['site_name']) }}" required
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
            </div>
            <div>
                <label for="slogan" class="block text-sm font-medium text-pitch-800 mb-1.5">Slogan</label>
                <input type="text" name="slogan" id="slogan" value="{{ old('slogan', $settings['slogan']) }}" placeholder="Ex : Porte ta passion."
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                <p class="mt-1.5 text-xs text-pitch-400">Affiché dans l'en-tête, le pied de page, le bandeau principal et la page de connexion.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-pitch-100 p-6 space-y-5">
            <h3 class="text-sm font-bold text-pitch-900 uppercase tracking-wider text-grass-700">Commandes WhatsApp</h3>
            <div>
                <label for="whatsapp_number" class="block text-sm font-medium text-pitch-800 mb-1.5">Numéro WhatsApp (commandes) *</label>
                <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" placeholder="Ex : 237690000000 (format international, sans +)"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                <p class="mt-1.5 text-xs text-pitch-400">
                    C'est le numéro qui reçoit les commandes. Format : code pays + numéro, sans espaces ni +. 
                    @if ($settings['whatsapp_number'])
                    <a href="{{ wa_link('Bonjour, test de commande ' . $globalSite->name) }}" target="_blank" class="text-grass-600 font-semibold hover:underline">Tester le lien →</a>
                    @endif
                </p>
                @if (!$settings['whatsapp_number'])
                <div class="mt-3 bg-amber-50 border border-amber-200 text-amber-800 text-xs rounded-lg px-3 py-2">
                    ⚠ Le bouton « Commander sur WhatsApp » n'apparaît pas tant que ce numéro n'est pas configuré.
                </div>
                @endif
            </div>
            <div>
                <label for="delivery_info" class="block text-sm font-medium text-pitch-800 mb-1.5">Informations de livraison</label>
                <input type="text" name="delivery_info" id="delivery_info" value="{{ old('delivery_info', $settings['delivery_info']) }}"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-pitch-100 p-6 space-y-5">
            <h3 class="text-sm font-bold text-pitch-900 uppercase tracking-wider text-grass-700">Page d'accueil</h3>
            <div>
                <label for="hero_title" class="block text-sm font-medium text-pitch-800 mb-1.5">Titre principal</label>
                <input type="text" name="hero_title" id="hero_title" value="{{ old('hero_title', $settings['hero_title']) }}"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
            </div>
            <div>
                <label for="hero_subtitle" class="block text-sm font-medium text-pitch-800 mb-1.5">Sous-titre principal</label>
                <textarea name="hero_subtitle" id="hero_subtitle" rows="2"
                          class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">{{ old('hero_subtitle', $settings['hero_subtitle']) }}</textarea>
            </div>
            <div>
                <label for="hero_image" class="block text-sm font-medium text-pitch-800 mb-1.5">Image de fond (URL)</label>
                <input type="text" name="hero_image" id="hero_image" value="{{ old('hero_image', $settings['hero_image']) }}" placeholder="https://..."
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <button type="submit" class="px-6 py-2.5 bg-grass-600 hover:bg-grass-500 text-white text-sm font-semibold rounded-lg transition-colors">
                Enregistrer les paramètres
            </button>
        </div>
    </form>
</div>
@endsection
