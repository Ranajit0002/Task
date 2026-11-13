@extends('layouts.app')

@section('title', 'All Projects - TaskFlow')

@section('content')
<div class="space-y-6 w-full">
    <div class="flex items-center justify-between border-b border-zinc-800/80 pb-5">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white">All Projects Directory</h1>
            <p class="text-xs text-zinc-400 mt-1">Master list of projects across all accessible workspaces.</p>
        </div>
        <span class="text-xs font-mono bg-zinc-900 border border-zinc-800 text-zinc-400 px-3 py-1 rounded-md">
            {{ $projects->count() }} Total Projects
        </span>
    </div>

    <div class="bg-zinc-950/80 border border-zinc-800/80 rounded-xl p-5 shadow-sm space-y-3 w-full">
        <div class="space-y-2.5">
            @forelse($projects as $project)
                <div class="bg-zinc-900/60 hover:bg-zinc-900 border border-zinc-800/80 rounded-lg p-4 flex flex-col md:flex-row md:items-center justify-between gap-4 transition">
                    <div class="space-y-1 flex-1">
                        <span class="text-[10px] font-mono text-zinc-400 uppercase bg-zinc-950 px-2 py-0.5 rounded border border-zinc-800">
                            {{ $project->workspace->name }}
                        </span>
                        <a href="{{ route('workspaces.projects.show', [$project->workspace, $project]) }}" 
                           class="text-sm font-medium text-white hover:underline block leading-snug">
                            {{ $project->name }}
                        </a>
                        @if($project->description)
                            <p class="text-xs text-zinc-400 line-clamp-1">{{ $project->description }}</p>
                        @endif
                    </div>

                    <div class="flex items-center gap-4 self-end md:self-auto text-xs shrink-0">
                        <span class="text-xs text-zinc-400 font-mono">{{ $project->tasks->count() }} task(s)</span>
                        <a href="{{ route('workspaces.projects.show', [$project->workspace, $project]) }}" 
                           class="px-3 py-1.5 bg-white text-zinc-950 text-xs font-medium rounded-md hover:bg-zinc-200 transition">
                            Open Board &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 space-y-2 border border-dashed border-zinc-900 rounded-lg">
                    <p class="text-xs font-medium text-zinc-400">No projects found.</p>
                    <p class="text-[11px] text-zinc-600">Create a workspace and add projects to get started.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection