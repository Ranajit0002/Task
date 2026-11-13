@extends('layouts.app')

@section('title', $task->title . ' - ' . $project->name . ' - TaskFlow')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between border-b border-zinc-800 pb-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-zinc-400 mb-1 font-mono">
                <a href="{{ route('workspaces.show', $workspace) }}" class="hover:underline">{{ $workspace->name }}</a>
                <span>/</span>
                <a href="{{ route('workspaces.projects.show', [$workspace, $project]) }}" class="hover:underline">{{ $project->name }}</a>
                <span>/</span>
                <span>Task</span>
            </div>
            <h1 class="text-xl font-bold tracking-tight text-white">{{ $task->title }}</h1>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('workspaces.projects.show', [$workspace, $project]) }}" class="px-3 py-1.5 bg-zinc-900 border border-zinc-800 text-zinc-300 text-xs rounded-md hover:bg-zinc-800 transition">&larr; Back to Board</a>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-950/40 border border-emerald-900/50 text-xs text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Details & Comments -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-zinc-900/60 border border-zinc-800 rounded-xl p-6 space-y-3 shadow-sm">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Description</h3>
                <p class="text-sm text-zinc-200 whitespace-pre-line leading-relaxed">{{ $task->description ?? 'No description provided for this task.' }}</p>
            </div>

            <!-- Comments Section -->
            <div class="bg-zinc-900/60 border border-zinc-800 rounded-xl p-6 space-y-6 shadow-sm">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Activity & Comments</h3>

                <!-- Comment Form -->
                <form action="{{ route('workspaces.projects.tasks.comments.store', [$workspace, $project, $task]) }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <textarea name="body" rows="3" placeholder="Leave a comment or update..."
                            class="w-full bg-zinc-950 border border-zinc-800 rounded-md p-3 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition resize-none">{{ old('body') }}</textarea>
                        @error('body')
                            <p class="text-xs text-red-400 mt-1.5 flex items-center gap-1.5 font-mono">
                                <span class="w-1 h-1 rounded-full bg-red-400 shrink-0"></span>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-white text-black text-xs font-medium rounded-md hover:bg-zinc-200 transition">
                            Post Comment
                        </button>
                    </div>
                </form>

                <!-- Comments List -->
                <div class="space-y-4 pt-4 border-t border-zinc-800/80">
                    @forelse($task->comments()->with('user')->get() as $comment)
                        <div class="bg-zinc-950 border border-zinc-800/80 rounded-lg p-4 space-y-2">
                            <div class="flex items-center justify-between text-xs font-mono">
                                <span class="font-semibold text-white">{{ $comment->user->name }}</span>
                                <span class="text-zinc-500 text-[11px]">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-zinc-300 whitespace-pre-line">{{ $comment->body }}</p>
                        </div>
                    @empty
                        <p class="text-xs text-zinc-500 text-center py-4 font-mono">No comments yet. Start the conversation!</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar Metadata -->
        <div class="space-y-4">
            <div class="bg-zinc-900/60 border border-zinc-800 rounded-xl p-5 space-y-4 text-xs shadow-sm">
                <div>
                    <span class="text-zinc-500 block mb-1 font-mono uppercase tracking-wider text-[10px]">Status</span>
                    <span class="px-2 py-1 rounded bg-zinc-950 text-zinc-300 border border-zinc-800 uppercase font-mono font-medium inline-block">
                        {{ str_replace('_', ' ', $task->status->value ?? $task->status) }}
                    </span>
                </div>

                <div>
                    <span class="text-zinc-500 block mb-1 font-mono uppercase tracking-wider text-[10px]">Priority</span>
                    <span class="px-2 py-1 rounded bg-zinc-950 text-zinc-300 border border-zinc-800 uppercase font-mono font-medium inline-block">
                        {{ $task->priority->value ?? $task->priority }}
                    </span>
                </div>

                <div>
                    <span class="text-zinc-500 block mb-1 font-mono uppercase tracking-wider text-[10px]">Assignee</span>
                    <span class="text-white font-medium">
                        {{ $task->assignee->name ?? 'Unassigned' }}
                    </span>
                </div>

                <div>
                    <span class="text-zinc-500 block mb-1 font-mono uppercase tracking-wider text-[10px]">Due Date</span>
                    <span class="text-white font-medium">
                        {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}
                    </span>
                </div>

                <div>
                    <span class="text-zinc-500 block mb-1 font-mono uppercase tracking-wider text-[10px]">Created By</span>
                    <span class="text-white font-medium">{{ $task->user->name ?? 'Unknown' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection