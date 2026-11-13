@extends('layouts.app')

@section('title', 'Workspaces - TaskFlow')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white">Workspaces</h1>
            <p class="text-xs sm:text-sm text-zinc-400">Manage your collaborative workspaces and environments.</p>
        </div>
        <a href="{{ route('workspaces.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white text-black text-xs font-semibold rounded-lg hover:bg-zinc-200 transition">
            + New Workspace
        </a>
    </div>

    <!-- Success Message Banner -->
    @if(session('success'))
        <div class="p-4 rounded-lg bg-emerald-950/40 border border-emerald-900/50 text-xs text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    <!-- Workspace Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($workspaces as $workspace)
            <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6 flex flex-col justify-between hover:border-zinc-700 transition shadow-sm">
                <div class="space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <h3 class="text-sm font-semibold text-white tracking-tight truncate" title="{{ $workspace->name }}">{{ $workspace->name }}</h3>
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-zinc-950 text-zinc-300 border border-zinc-800 uppercase font-mono tracking-wider shrink-0">
                            {{ $workspace->pivot->role ?? 'Owner' }}
                        </span>
                    </div>
                    <p class="text-[11px] text-zinc-500 font-mono truncate">slug: {{ $workspace->slug }}</p>
                </div>

                <div class="mt-8 flex items-center justify-between pt-4 border-t border-zinc-800/80">
                    <a href="{{ route('workspaces.show', $workspace) }}" class="text-xs text-white font-medium hover:underline flex items-center gap-1">
                        View Workspace &rarr;
                    </a>
                    @if($workspace->user_id === Auth::id())
                        <form action="{{ route('workspaces.destroy', $workspace) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this workspace? All associated projects and tasks will be removed.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-400 hover:text-red-300 transition">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-16 bg-zinc-900/50 border border-zinc-800 rounded-xl space-y-3">
                <p class="text-xs text-zinc-400">No workspaces found. Create your first workspace to get started.</p>
                <a href="{{ route('workspaces.create') }}" class="inline-block px-4 py-2 bg-white text-black text-xs font-semibold rounded-lg hover:bg-zinc-200 transition">
                    Create Workspace
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection