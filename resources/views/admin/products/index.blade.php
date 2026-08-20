@extends('admin.layouts.master')

@section('title', 'Maillots | ' . $globalSite->name)

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-lg font-bold text-pitch-900">Gestion des maillots</h2>
        <p class="text-sm text-pitch-500">{{ $products->total() }} maillot{{ $products->total() > 1 ? 's' : '' }}</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-grass-600 hover:bg-grass-500 text-white text-sm font-semibold rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Ajouter un maillot
    </a>
</div>

<form action="{{ route('admin.products.index') }}" method="GET" class="mb-4 flex items-center gap-2">
    <div class="relative flex-1">
        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-pitch-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un maillot, club, championnat, saison…"
               class="w-full pl-10 pr-10 py-2.5 border border-pitch-200 rounded-lg text-sm text-pitch-900 placeholder-pitch-400 focus:outline-none focus:border-grass-500 focus:ring-1 focus:ring-grass-500">
        @if (request('search'))
        <a href="{{ route('admin.products.index') }}" class="absolute right-2.5 top-1/2 -translate-y-1/2 p-1 text-pitch-400 hover:text-pitch-600" title="Effacer la recherche">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </a>
        @endif
    </div>
    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 bg-pitch-900 hover:bg-pitch-800 text-white text-sm font-semibold rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        Rechercher
    </button>
</form>

<div class="bg-white rounded-2xl border border-pitch-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-xs text-pitch-400 uppercase tracking-wider bg-pitch-50">
                    <th class="px-6 py-3 font-semibold">Maillot</th>
                    <th class="px-6 py-3 font-semibold">Championnat</th>
                    <th class="px-6 py-3 font-semibold">Club</th>
                    <th class="px-6 py-3 font-semibold">Prix</th>
                    <th class="px-6 py-3 font-semibold">Statut</th>
                    <th class="px-6 py-3 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-pitch-100">
                @forelse ($products as $product)
                <tr class="hover:bg-pitch-50/50 transition-colors">
                    <td class="px-6 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-lg bg-pitch-50 overflow-hidden flex-shrink-0">
                                @if ($product->image_url)
                                <img src="{{ $product->image_url }}" alt="" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('admin.products.edit', $product) }}" class="font-medium text-pitch-900 hover:text-grass-600">{{ $product->name }}</a>
                                @if ($product->is_new)
                                <span class="text-[10px] font-bold text-grass-600 uppercase">Nouveau</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-pitch-600">{{ $product->championship?->name ?? '—' }}</td>
                    <td class="px-6 py-3 text-pitch-600">{{ $product->club ?? '—' }}</td>
                    <td class="px-6 py-3">
                        <p class="font-semibold text-pitch-900">{{ $product->formatPrice() }}</p>
                        @if ($product->old_price)
                        <p class="text-xs text-pitch-400 line-through">{{ $product->formatOldPrice() }}</p>
                        @endif
                    </td>
                    <td class="px-6 py-3">
                        <form action="{{ route('admin.products.toggle', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="{{ $product->is_active ? 'bg-grass-50 text-grass-700' : 'bg-pitch-100 text-pitch-600' }} px-2.5 py-1 text-xs font-semibold rounded-full hover:opacity-80 transition-opacity">
                                {{ $product->is_active ? 'En ligne' : 'Masqué' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('product.show', $product->slug) }}" target="_blank" class="p-2 text-pitch-500 hover:text-grass-600 hover:bg-grass-50 rounded-lg transition-colors" title="Voir sur le site">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="p-2 text-pitch-500 hover:text-grass-600 hover:bg-grass-50 rounded-lg transition-colors" title="Modifier">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Supprimer ce maillot ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-pitch-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Supprimer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <svg class="w-10 h-10 mx-auto text-pitch-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3l6 0 3 3v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6l3-3zm-2 3h10"/></svg>
                        <p class="mt-3 text-pitch-500">Aucun maillot pour le moment.</p>
                        <a href="{{ route('admin.products.create') }}" class="inline-block mt-3 text-sm font-semibold text-grass-600 hover:text-grass-700">Ajouter votre premier maillot →</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($products->hasPages())
    <div class="px-6 py-4 border-t border-pitch-100">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
