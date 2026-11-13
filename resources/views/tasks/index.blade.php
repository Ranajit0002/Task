@extends('layouts.app')

@section('title', 'All Tasks - TaskFlow')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div class="flex items-center justify-between border-b border-zinc-800/80 pb-5">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white">All Tasks Directory</h1>
            <p class="text-xs text-zinc-400 mt-1">Complete master list of tasks across all accessible workspaces and projects.</p>
        </div>
        <span class="text-xs font-mono bg-zinc-900 border border-zinc-800 text-zinc-400 px-3 py-1 rounded-md">
            {{ $tasks->count() }} Total Tasks
        </span>
    </div>

    <div class="bg-zinc-950/80 border border-zinc-800/80 rounded-xl p-5 shadow-sm space-y-3">
        <div class="space-y-2">
            @forelse($tasks as $task)
                <div class="bg-zinc-900/40 hover:bg-zinc-900/90 border border-zinc-800/70 rounded-lg p-4 flex flex-col md:flex-row md:items-center justify-between gap-4 transition">
                    <div class="space-y-1.5 flex-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-[10px] font-mono text-zinc-400 uppercase bg-zinc-950 px-2 py-0.5 rounded border border-zinc-800">
                                {{ $task->project->workspace->name }} / {{ $task->project->name }}
                            </span>
                            <span class="text-[10px] uppercase font-mono px-2 py-0.5 rounded bg-zinc-950 border border-zinc-800 text-zinc-400">
                                {{ $task->priority->value ?? $task->priority }}
                            </span>
                            @if($task->assignee)
                                <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-zinc-950 border border-zinc-800 text-zinc-300">
                                    Assignee: {{ $task->assignee->name }}
                                </span>
                            @endif
                        </div>
                        <a href="{{ route('workspaces.projects.tasks.show', [$task->project->workspace, $task->project, $task]) }}" 
                           class="text-sm font-medium text-white hover:underline block leading-snug">
                            {{ $task->title }}
                        </a>
                    </div>

                    <div class="flex items-center gap-4 self-end md:self-auto text-xs shrink-0">
                        @if($task->due_date)
                            <span class="text-xs text-zinc-400 font-mono">Due {{ $task->due_date->format('M d') }}</span>
                        @endif
                        <span class="px-3 py-1 rounded-md text-[10px] font-mono uppercase tracking-wider border border-zinc-800 bg-zinc-950 text-zinc-300">
                            {{ str_replace('_', ' ', $task->status->value ?? $task->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 space-y-2 border border-dashed border-zinc-900 rounded-lg">
                    <p class="text-xs font-medium text-zinc-400">No tasks found across your workspaces.</p>
                    <p class="text-[11px] text-zinc-600">Create a project inside any workspace to start adding tasks.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection