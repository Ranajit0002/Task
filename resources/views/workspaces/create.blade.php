@extends('layouts.app')

@section('title', 'Create Workspace - TaskFlow')

@section('content')
<div class="max-w-xl mx-auto space-y-6 py-4">
    <!-- Header -->
    <div class="space-y-1">
        <h1 class="text-xl font-bold text-white tracking-tight">Create New Workspace</h1>
        <p class="text-xs text-zinc-400">Set up a collaborative environment for your team or client projects.</p>
    </div>

    <!-- Form Card -->
    <form action="{{ route('workspaces.store') }}" method="POST" class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl space-y-5 shadow-xl">
        @csrf

        <div>
            <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">Workspace Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" autofocus
                placeholder="e.g. Acme Corp Engineering"
                class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition" />
            
            @error('name')
                <p class="text-xs text-red-400 mt-1.5 flex items-center gap-1.5 font-mono">
                    <span class="w-1 h-1 rounded-full bg-red-400 shrink-0"></span>
                    <span>{{ $message }}</span>
                </p>
            @else
                <p class="text-[10px] text-zinc-500 mt-1.5 font-mono">Letters, numbers, spaces, hyphens, and underscores allowed (max 255 chars).</p>
            @enderror
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-800">
            <a href="{{ route('workspaces.index') }}" class="px-4 py-2 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-xs font-medium rounded-lg transition">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-white text-black text-xs font-semibold rounded-lg hover:bg-zinc-200 transition">
                Create Workspace
            </button>
        </div>
    </form>
</div>
@endsection