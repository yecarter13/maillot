@extends('admin.layouts.master')

@section('title', ($user ?? null) ? 'Modifier l\'administrateur | ' . $globalSite->name : 'Créer un administrateur | ' . $globalSite->name)

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg font-bold text-pitch-900">{{ isset($user) ? 'Modifier l\'administrateur' : 'Créer un administrateur' }}</h2>
            <p class="text-sm text-pitch-500">Les administrateurs peuvent gérer les maillots, championnats et autres admins.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-pitch-500 hover:text-pitch-700">← Retour</a>
    </div>

    <form action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST" class="bg-white rounded-2xl border border-pitch-100 p-6 space-y-5">
        @csrf
        @if (isset($user))
        @method('PUT')
        @endif

        <div>
            <label for="name" class="block text-sm font-medium text-pitch-800 mb-1.5">Nom complet *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required
                   class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
            @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-pitch-800 mb-1.5">Adresse e-mail *</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required
                   class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
            @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="password" class="block text-sm font-medium text-pitch-800 mb-1.5">{{ isset($user) ? 'Nouveau mot de passe' : 'Mot de passe *' }}</label>
                <input type="password" name="password" id="password" {{ isset($user) ? '' : 'required' }} minlength="8"
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
                @error('password')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-pitch-800 mb-1.5">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" {{ isset($user) ? '' : 'required' }}
                       class="w-full px-4 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
            </div>
        </div>

        <div class="pt-4 border-t border-pitch-100">
            <label class="flex items-center gap-2 text-sm text-pitch-800">
                <input type="checkbox" name="is_admin" value="1" class="rounded border-pitch-300 text-grass-500 focus:ring-grass-500" {{ old('is_admin', $user->is_admin ?? true) ? 'checked' : '' }}>
                Accès administrateur (gestion complète de la boutique)
            </label>
        </div>

        <div class="pt-4 border-t border-pitch-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 text-sm font-semibold text-pitch-600 hover:text-pitch-800 rounded-lg">Annuler</a>
            <button type="submit" class="px-6 py-2.5 bg-grass-600 hover:bg-grass-500 text-white text-sm font-semibold rounded-lg transition-colors">
                {{ isset($user) ? 'Enregistrer les modifications' : 'Créer l\'administrateur' }}
            </button>
        </div>
    </form>
</div>
@endsection
