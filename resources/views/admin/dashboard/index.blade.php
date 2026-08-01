@extends('admin.layouts.master')

@section('title', 'Tableau de bord | ' . $globalSite->name)

@section('content')
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    <a href="{{ route('admin.products.index') }}" class="bg-white rounded-2xl border border-pitch-100 p-5 hover:shadow-lg transition-shadow">
        <div class="w-10 h-10 bg-grass-100 text-grass-700 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3l6 0 3 3v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6l3-3zm-2 3h10m-6 5a2 2 0 100 4 2 2 0 000-4z"/></svg>
        </div>
        <p class="mt-3 text-2xl font-extrabold text-pitch-900">{{ $stats['products'] }}</p>
        <p class="text-sm text-pitch-500">Maillots au total</p>
    </a>
    <a href="{{ route('admin.products.index') }}" class="bg-white rounded-2xl border border-pitch-100 p-5 hover:shadow-lg transition-shadow">
        <div class="w-10 h-10 bg-grass-100 text-grass-700 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <p class="mt-3 text-2xl font-extrabold text-pitch-900">{{ $stats['activeProducts'] }}</p>
        <p class="text-sm text-pitch-500">Maillots en ligne</p>
    </a>
    <a href="{{ route('admin.championships.index') }}" class="bg-white rounded-2xl border border-pitch-100 p-5 hover:shadow-lg transition-shadow">
        <div class="w-10 h-10 bg-grass-100 text-grass-700 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
        </div>
        <p class="mt-3 text-2xl font-extrabold text-pitch-900">{{ $stats['championships'] }}</p>
        <p class="text-sm text-pitch-500">Championnats</p>
    </a>
    <a href="{{ route('admin.users.index') }}" class="bg-white rounded-2xl border border-pitch-100 p-5 hover:shadow-lg transition-shadow">
        <div class="w-10 h-10 bg-grass-100 text-grass-700 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <p class="mt-3 text-2xl font-extrabold text-pitch-900">{{ $stats['admins'] }}</p>
        <p class="text-sm text-pitch-500">Administrateurs</p>
    </a>
</div>

<div class="mt-8 bg-white rounded-2xl border border-pitch-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-pitch-100 flex items-center justify-between">
        <h2 class="font-semibold text-pitch-900">Derniers maillots ajoutés</h2>
        <a href="{{ route('admin.products.create') }}" class="text-sm font-semibold text-grass-600 hover:text-grass-700">+ Ajouter</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-xs text-pitch-400 uppercase tracking-wider bg-pitch-50">
                    <th class="px-6 py-3 font-semibold">Maillot</th>
                    <th class="px-6 py-3 font-semibold">Championnat</th>
                    <th class="px-6 py-3 font-semibold">Club</th>
                    <th class="px-6 py-3 font-semibold">Prix</th>
                    <th class="px-6 py-3 font-semibold">Statut</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-pitch-100">
                @forelse ($recentProducts as $product)
                <tr class="hover:bg-pitch-50/50 transition-colors">
                    <td class="px-6 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-pitch-50 overflow-hidden flex-shrink-0">
                                @if ($product->image_url)
                                <img src="{{ $product->image_url }}" alt="" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <a href="{{ route('admin.products.edit', $product) }}" class="font-medium text-pitch-900 hover:text-grass-600">{{ $product->name }}</a>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-pitch-600">{{ $product->championship?->name ?? '—' }}</td>
                    <td class="px-6 py-3 text-pitch-600">{{ $product->club ?? '—' }}</td>
                    <td class="px-6 py-3 font-semibold text-pitch-900">{{ $product->formatPrice() }}</td>
                    <td class="px-6 py-3">
                        @if ($product->is_active)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-grass-50 text-grass-700 text-xs font-semibold rounded-full">En ligne</span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-pitch-100 text-pitch-600 text-xs font-semibold rounded-full">Masqué</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-pitch-400">Aucun maillot pour le moment.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
