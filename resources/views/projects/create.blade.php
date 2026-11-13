@extends('layouts.app')

@section('title', 'Create Project - ' . $workspace->name . ' - TaskFlow')

@section('content')
<div class="max-w-xl mx-auto space-y-6">
    <div>
        <div class="flex items-center gap-2 text-xs text-zinc-400 mb-1 font-mono">
            <a href="{{ route('workspaces.show', $workspace) }}" class="hover:underline">{{ $workspace->name }}</a>
            <span>/</span>
            <span>New Project</span>
        </div>
        <h1 class="text-xl font-bold tracking-tight text-white">Create Project</h1>
        <p class="text-xs text-zinc-400 mt-0.5">Add a new project to organize tasks and workflows.</p>
    </div>

    <div class="bg-zinc-900/60 border border-zinc-800 rounded-xl p-6 shadow-sm">
        <form action="{{ route('workspaces.projects.store', $workspace) }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1">Project Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" autofocus
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-md px-3 py-2 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition"
                    placeholder="e.g. Q1 Redesign, API V2">
                @error('name')
                    <p class="text-xs text-red-400 mt-1.5 flex items-center gap-1.5 font-mono">
                        <span class="w-1 h-1 rounded-full bg-red-400 shrink-0"></span>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1">Description (Optional)</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-md px-3 py-2 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition resize-none"
                    placeholder="Brief overview of the project goals...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-xs text-red-400 mt-1.5 flex items-center gap-1.5 font-mono">
                        <span class="w-1 h-1 rounded-full bg-red-400 shrink-0"></span>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-zinc-800/80">
                <a href="{{ route('workspaces.show', $workspace) }}" class="px-4 py-2 bg-zinc-900 border border-zinc-800 text-zinc-300 rounded-md text-xs font-medium hover:bg-zinc-800 transition">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-white text-black rounded-md text-xs font-medium hover:bg-zinc-200 transition">Create Project</button>
            </div>
        </form>
    </div>
</div>
@endsection