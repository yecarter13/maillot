@extends('admin.layouts.master')

@section('title', 'Photothèque | ' . $globalSite->name)

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-lg font-bold text-pitch-900">Photothèque — Clients satisfaits</h2>
        <p class="text-sm text-pitch-500">Postez les photos de vos clients satisfaits pour rassurer vos visiteurs.</p>
    </div>
    <a href="{{ route('admin.customer-photos.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-grass-600 hover:bg-grass-500 text-white text-sm font-semibold rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Ajouter une photo
    </a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse ($photos as $photo)
    <div class="bg-white rounded-2xl border border-pitch-100 overflow-hidden hover:shadow-lg transition-shadow">
        <div class="relative aspect-[4/3] bg-pitch-50 overflow-hidden">
            @if ($photo->image_url)
            <img src="{{ $photo->image_url }}" alt="{{ $photo->customer_name }}" class="w-full h-full object-cover">
            @endif
            <span class="absolute top-3 right-3 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $photo->is_active ? 'bg-grass-500 text-white' : 'bg-pitch-500 text-pitch-200' }}">
                {{ $photo->is_active ? 'Visible' : 'Masquée' }}
            </span>
        </div>
        <div class="p-4">
            <h3 class="font-semibold text-pitch-900">{{ $photo->customer_name }}</h3>
            @if ($photo->location)
            <p class="text-xs text-pitch-400">{{ $photo->location }}</p>
            @endif
            @if ($photo->message)
            <p class="mt-2 text-sm text-pitch-600 line-clamp-3">« {{ $photo->message }} »</p>
            @endif
            <div class="mt-4 flex items-center justify-between gap-2">
                <form action="{{ route('admin.customer-photos.toggle', $photo) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xs font-semibold text-pitch-500 hover:text-grass-600 px-3 py-1.5 bg-pitch-50 hover:bg-grass-50 rounded-lg transition-colors">
                        {{ $photo->is_active ? 'Masquer' : 'Activer' }}
                    </button>
                </form>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.customer-photos.edit', $photo) }}" class="p-2 text-pitch-500 hover:text-grass-600 hover:bg-grass-50 rounded-lg transition-colors" title="Modifier">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </a>
                    <form action="{{ route('admin.customer-photos.destroy', $photo) }}" method="POST" onsubmit="return confirm('Supprimer cette photo ?');">
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
        <svg class="w-10 h-10 mx-auto text-pitch-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        <p class="mt-3 text-pitch-500">Aucune photo pour le moment.</p>
        <a href="{{ route('admin.customer-photos.create') }}" class="inline-block mt-3 text-sm font-semibold text-grass-600 hover:text-grass-700">Ajouter votre première photo →</a>
    </div>
    @endforelse
</div>

@if ($photos->hasPages())
<div class="mt-6">
    {{ $photos->links() }}
</div>
@endif
@endsection
