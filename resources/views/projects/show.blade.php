@extends('layouts.app')

@section('title', $project->name . ' - ' . $workspace->name . ' - TaskFlow')

@section('content')
<div class="space-y-6 w-full">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-zinc-800/80 pb-5 gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-zinc-400 mb-1.5 font-mono">
                <a href="{{ route('workspaces.show', $workspace) }}" class="hover:text-white transition">{{ $workspace->name }}</a>
                <span class="text-zinc-600">/</span>
                <span class="text-zinc-300">Project Board</span>
            </div>
            <h1 class="text-2xl font-semibold tracking-tight text-white flex items-center gap-3">
                {{ $project->name }}
                <span class="text-xs px-2 py-0.5 rounded-full bg-zinc-900 text-zinc-400 border border-zinc-800 font-mono font-normal">Active</span>
            </h1>
            <p class="text-xs text-zinc-400 mt-1 max-w-2xl">{{ $project->description ?? 'No description provided.' }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('projects.tasks.create', $project) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white text-zinc-950 text-xs font-medium rounded-md hover:bg-zinc-200 transition shadow-sm">
                <span>+</span> New Task
            </a>
            <a href="{{ route('workspaces.show', $workspace) }}" class="px-3 py-1.5 bg-zinc-900 border border-zinc-800 text-zinc-300 text-xs rounded-md hover:bg-zinc-800 transition">
                &larr; Workspace
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="p-3 rounded-lg bg-emerald-950/40 border border-emerald-900/60 text-xs text-emerald-300 flex items-center gap-2">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
            {{ session('success') }}
        </div>
    @endif

    <!-- Kanban Board Grid (Fully Responsive, w-full, no horizontal scroll) -->
    @php
        $statuses = [
            'backlog' => 'Backlog',
            'todo' => 'To Do',
            'in_progress' => 'In Progress',
            'in_review' => 'In Review',
            'done' => 'Done'
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 w-full pb-6">
        @foreach($statuses as $key => $label)
            <div class="bg-zinc-950/75 border border-zinc-800/80 rounded-xl p-3 flex flex-col shadow-sm w-full">
                <!-- Column Header -->
                <div class="flex items-center justify-between mb-3 pb-2 border-b border-zinc-900/80">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full 
                            {{ $key === 'done' ? 'bg-emerald-500' : ($key === 'in_progress' ? 'bg-amber-500' : ($key === 'in_review' ? 'bg-purple-500' : 'bg-zinc-600')) }}">
                        </span>
                        <h3 class="text-xs font-semibold uppercase tracking-wider text-zinc-300">{{ $label }}</h3>
                    </div>
                    <span class="text-[11px] font-mono bg-zinc-900 text-zinc-400 px-2 py-0.5 rounded-full border border-zinc-800">
                        {{ $project->tasks->where('status', $key)->count() }}
                    </span>
                </div>

                <!-- Tasks Container -->
                <div class="space-y-2.5 flex-1">
                    @forelse($project->tasks->where('status', $key) as $task)
                        <div class="bg-zinc-900/60 hover:bg-zinc-900 border border-zinc-800/80 hover:border-zinc-700 rounded-lg p-3 space-y-2.5 transition group shadow-sm">
                            <div class="flex items-start justify-between gap-2">
                                <a href="{{ route('workspaces.projects.tasks.show', [$workspace, $project, $task]) }}" class="text-xs font-medium text-white hover:text-zinc-200 transition leading-snug">
                                    {{ $task->title }}
                                </a>
                                <form action="{{ route('workspaces.projects.tasks.destroy', [$workspace, $project, $task]) }}" method="POST" onsubmit="return confirm('Delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-zinc-600 hover:text-red-400 text-sm opacity-0 group-hover:opacity-100 transition px-1" title="Delete Task">&times;</button>
                                </form>
                            </div>

                            @if($task->description)
                                <p class="text-[11px] text-zinc-400 line-clamp-2 leading-relaxed">{{ $task->description }}</p>
                            @endif

                            <div class="flex items-center justify-between pt-2 border-t border-zinc-800/50 text-[10px]">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="uppercase px-1.5 py-0.5 rounded bg-zinc-950 text-zinc-400 border border-zinc-800 font-mono font-medium">
                                        {{ $task->priority->value ?? $task->priority }}
                                    </span>
                                    @if($task->assignee)
                                        <span class="text-zinc-300 bg-zinc-950 px-1.5 py-0.5 rounded border border-zinc-800 font-medium truncate max-w-[100px]" title="Assigned to {{ $task->assignee->name }}">
                                            {{ explode(' ', $task->assignee->name)[0] }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Quick Status Switcher -->
                                <form action="{{ route('workspaces.projects.tasks.status', [$workspace, $project, $task]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="bg-zinc-950 text-zinc-300 border border-zinc-800 rounded text-[10px] px-1.5 py-0.5 focus:outline-none focus:border-zinc-600 cursor-pointer">
                                        @foreach($statuses as $sKey => $sLabel)
                                            <option value="{{ $sKey }}" {{ ($task->status->value ?? $task->status) === $sKey ? 'selected' : '' }}>{{ $sLabel }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-zinc-600 text-xs border border-dashed border-zinc-900 rounded-lg">
                            No tasks
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection