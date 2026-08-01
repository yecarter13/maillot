@extends('admin.layouts.master')

@section('title', 'Championnats | ' . $globalSite->name)

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-lg font-bold text-pitch-900">Gestion des championnats</h2>
        <p class="text-sm text-pitch-500">Ligue 1, Premier League, Liga, Serie A, etc.</p>
    </div>
    <a href="{{ route('admin.championships.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-grass-600 hover:bg-grass-500 text-white text-sm font-semibold rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Ajouter un championnat
    </a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse ($championships as $champ)
    <div class="bg-white rounded-2xl border border-pitch-100 overflow-hidden hover:shadow-lg transition-shadow">
        <div class="h-28 bg-pitch-900 relative overflow-hidden">
            @if ($champ->image_url)
            <img src="{{ $champ->image_url }}" alt="{{ $champ->name }}" class="w-full h-full object-cover opacity-80">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-pitch-950/80 to-transparent"></div>
            <div class="absolute bottom-3 left-4 right-4 flex items-end justify-between">
                <div>
                    <h3 class="text-white font-bold leading-tight">{{ $champ->name }}</h3>
                    <p class="text-xs text-pitch-300">{{ $champ->country ?? '' }} · {{ $champ->products_count }} maillot{{ $champ->products_count > 1 ? 's' : '' }}</p>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $champ->is_active ? 'bg-grass-500 text-white' : 'bg-pitch-500 text-pitch-200' }}">
                    {{ $champ->is_active ? 'Actif' : 'Masqué' }}
                </span>
            </div>
        </div>
        <div class="p-4">
            @if ($champ->description)
            <p class="text-sm text-pitch-600 line-clamp-2">{{ $champ->description }}</p>
            @endif
            <div class="mt-4 flex items-center justify-between gap-2">
                <form action="{{ route('admin.championships.toggle', $champ) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xs font-semibold text-pitch-500 hover:text-grass-600 px-3 py-1.5 bg-pitch-50 hover:bg-grass-50 rounded-lg transition-colors">
                        {{ $champ->is_active ? 'Masquer' : 'Activer' }}
                    </button>
                </form>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.championships.edit', $champ) }}" class="p-2 text-pitch-500 hover:text-grass-600 hover:bg-grass-50 rounded-lg transition-colors" title="Modifier">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </a>
                    <form action="{{ route('admin.championships.destroy', $champ) }}" method="POST" onsubmit="return confirm('Supprimer ce championnat ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-pitch-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Supprimer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="sm:col-span-2 lg:col-span-3 bg-white rounded-2xl border border-dashed border-pitch-200 p-12 text-center">
        <svg class="w-10 h-10 mx-auto text-pitch-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
        <p class="mt-3 text-pitch-500">Aucun championnat pour le moment.</p>
        <a href="{{ route('admin.championships.create') }}" class="inline-block mt-3 text-sm font-semibold text-grass-600 hover:text-grass-700">Ajouter votre premier championnat →</a>
    </div>
    @endforelse
</div>
@endsection
