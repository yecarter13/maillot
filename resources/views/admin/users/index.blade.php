@extends('admin.layouts.master')

@section('title', 'Administrateurs | ' . $globalSite->name)

@section('content')
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-lg font-bold text-pitch-900">Gestion des administrateurs</h2>
        <p class="text-sm text-pitch-500">Créez des comptes pour gérer la boutique.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-grass-600 hover:bg-grass-500 text-white text-sm font-semibold rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Créer un administrateur
    </a>
</div>

<div class="bg-white rounded-2xl border border-pitch-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-xs text-pitch-400 uppercase tracking-wider bg-pitch-50">
                    <th class="px-6 py-3 font-semibold">Nom</th>
                    <th class="px-6 py-3 font-semibold">E-mail</th>
                    <th class="px-6 py-3 font-semibold">Rôle</th>
                    <th class="px-6 py-3 font-semibold">Créé le</th>
                    <th class="px-6 py-3 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-pitch-100">
                @foreach ($users as $user)
                <tr class="hover:bg-pitch-50/50 transition-colors">
                    <td class="px-6 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-pitch-900 text-white flex items-center justify-center text-xs font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                            <span class="font-medium text-pitch-900">{{ $user->name }}</span>
                            @if ($user->id === auth()->id())
                            <span class="text-[10px] font-bold text-grass-600 uppercase">Vous</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-3 text-pitch-600">{{ $user->email }}</td>
                    <td class="px-6 py-3">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 {{ $user->is_admin ? 'bg-grass-50 text-grass-700' : 'bg-pitch-100 text-pitch-600' }} text-xs font-semibold rounded-full">
                            {{ $user->is_admin ? 'Administrateur' : 'Simple utilisateur' }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-pitch-500">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="p-2 text-pitch-500 hover:text-grass-600 hover:bg-grass-50 rounded-lg transition-colors" title="Modifier">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            @if ($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Supprimer ce compte ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-pitch-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Supprimer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($users->hasPages())
    <div class="px-6 py-4 border-t border-pitch-100">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
