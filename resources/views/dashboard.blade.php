@extends('layouts.app')

@section('title', 'Dashboard - TaskFlow')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    <!-- Header Greeting -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white">Dashboard Overview</h1>
            <p class="text-xs sm:text-sm text-zinc-400">Monitor your workspace analytics, team metrics, and assigned tasks.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('workspaces.create') }}" class="px-4 py-2 bg-white text-black text-xs font-semibold rounded-lg hover:bg-zinc-200 transition">
                + New Workspace
            </a>
        </div>
    </div>

    <!-- Analytics Stat Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Workspaces -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 space-y-2 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Workspaces</span>
                <span class="p-2 bg-zinc-950 rounded-lg text-zinc-300 border border-zinc-800 font-mono text-xs">ENV</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-bold text-white tracking-tight">{{ $totalWorkspaces }}</span>
                <span class="text-[11px] text-emerald-400 font-medium">Active tenants</span>
            </div>
        </div>

        <!-- Total Projects -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 space-y-2 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Projects</span>
                <span class="p-2 bg-zinc-950 rounded-lg text-zinc-300 border border-zinc-800 font-mono text-xs">PRJ</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-bold text-white tracking-tight">{{ $totalProjects }}</span>
                <span class="text-[11px] text-zinc-400 font-medium">Across workspaces</span>
            </div>
        </div>

        <!-- Total Tasks -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 space-y-2 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Total Tasks</span>
                <span class="p-2 bg-zinc-950 rounded-lg text-zinc-300 border border-zinc-800 font-mono text-xs">TSK</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-bold text-white tracking-tight">{{ $totalTasks }}</span>
                <span class="text-[11px] text-amber-400 font-medium">{{ $pendingTasks }} pending</span>
            </div>
        </div>

        <!-- Completion Rate Progress Bar Card -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 space-y-3 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Completion Rate</span>
                <span class="text-xs font-mono text-white font-semibold">{{ $completionRate }}%</span>
            </div>
            <div class="w-full bg-zinc-950 rounded-full h-2 border border-zinc-800 overflow-hidden">
                <div class="bg-white h-full rounded-full transition-all duration-500" style="width: {{ $completionRate }}%"></div>
            </div>
            <p class="text-[10px] text-zinc-500">{{ $completedTasks }} of {{ $totalTasks }} tasks marked as done</p>
        </div>
    </div>

    <!-- Secondary Split Section: Assigned Tasks & Quick Workspaces -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Assigned Tasks Table (Spans 2 Cols) -->
        <div class="lg:col-span-2 bg-zinc-900 border border-zinc-800 rounded-xl p-6 space-y-4 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold text-white uppercase tracking-wider">Tasks Assigned to You</h2>
                <a href="{{ route('tasks.index') }}" class="text-xs text-zinc-400 hover:text-white transition">View all &rarr;</a>
            </div>

            <div class="divide-y divide-zinc-800/80">
                @forelse($assignedTasks as $task)
                    <div class="py-3 flex items-center justify-between gap-4 first:pt-0 last:pb-0">
                        <div class="space-y-0.5 truncate">
                            <a href="{{ route('workspaces.projects.tasks.show', [$task->project->workspace_id, $task->project_id, $task]) }}" class="text-xs font-semibold text-white hover:underline truncate block">
                                {{ $task->title }}
                            </a>
                            <p class="text-[11px] text-zinc-400 truncate">{{ $task->project->workspace->name }} &bull; {{ $task->project->name }}</p>
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-zinc-950 border border-zinc-800 uppercase font-mono text-zinc-300">
                                {{ str_replace('_', ' ', is_object($task->status) ? $task->status->value : $task->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-xs text-zinc-500">
                        No tasks currently assigned to you.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Active Workspaces List (Spans 1 Col) -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6 space-y-4 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold text-white uppercase tracking-wider">Your Workspaces</h2>
                <a href="{{ route('workspaces.index') }}" class="text-xs text-zinc-400 hover:text-white transition">Manage &rarr;</a>
            </div>

            <div class="space-y-3">
                @forelse($workspaces->take(4) as $ws)
                    <a href="{{ route('workspaces.show', $ws) }}" class="block p-3 rounded-lg bg-zinc-950 border border-zinc-800 hover:border-zinc-700 transition">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-medium text-white truncate">{{ $ws->name }}</span>
                            <span class="text-[10px] text-zinc-500 font-mono">{{ $ws->projects->count() }} projects</span>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-8 text-xs text-zinc-500">
                        No workspaces found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection