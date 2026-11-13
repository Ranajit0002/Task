@extends('layouts.app')

@section('title', 'Create Task - ' . $project->name . ' - TaskFlow')

@section('content')
<div class="max-w-xl mx-auto space-y-6">
    <div class="flex items-center justify-between border-b border-zinc-800 pb-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-zinc-400 mb-1 font-mono">
                <a href="{{ route('workspaces.show', $workspace) }}" class="hover:underline">{{ $workspace->name }}</a>
                <span>/</span>
                <a href="{{ route('workspaces.projects.show', [$workspace, $project]) }}" class="hover:underline">{{ $project->name }}</a>
                <span>/</span>
                <span>New Task</span>
            </div>
            <h1 class="text-xl font-bold tracking-tight text-white">Create New Task</h1>
        </div>
        <a href="{{ route('workspaces.projects.show', [$workspace, $project]) }}" class="px-3 py-1.5 bg-zinc-900 border border-zinc-800 text-zinc-300 text-xs rounded-md hover:bg-zinc-800 transition">&larr; Cancel</a>
    </div>

    <div class="bg-zinc-900/60 border border-zinc-800 rounded-xl p-6 shadow-sm">
        <form action="{{ route('projects.tasks.store', $project) }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" autofocus placeholder="e.g. Implement auth middleware"
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-md px-3 py-2 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition">
                @error('title') 
                    <p class="text-xs text-red-400 mt-1.5 flex items-center gap-1.5 font-mono">
                        <span class="w-1 h-1 rounded-full bg-red-400 shrink-0"></span>
                        <span>{{ $message }}</span>
                    </p> 
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1">Description</label>
                <textarea name="description" rows="4" placeholder="Task details, instructions, or scope..."
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-md px-3 py-2 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition resize-none">{{ old('description') }}</textarea>
                @error('description') 
                    <p class="text-xs text-red-400 mt-1.5 flex items-center gap-1.5 font-mono">
                        <span class="w-1 h-1 rounded-full bg-red-400 shrink-0"></span>
                        <span>{{ $message }}</span>
                    </p> 
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1">Status</label>
                    <select name="status" class="w-full bg-zinc-950 border border-zinc-800 rounded-md px-3 py-2 text-sm text-white focus:outline-none focus:border-zinc-500 transition">
                        <option value="backlog" {{ old('status') === 'backlog' ? 'selected' : '' }}>Backlog</option>
                        <option value="todo" {{ old('status', 'todo') === 'todo' ? 'selected' : '' }}>To Do</option>
                        <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="in_review" {{ old('status') === 'in_review' ? 'selected' : '' }}>In Review</option>
                        <option value="done" {{ old('status') === 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1">Priority</label>
                    <select name="priority" class="w-full bg-zinc-950 border border-zinc-800 rounded-md px-3 py-2 text-sm text-white focus:outline-none focus:border-zinc-500 transition">
                        <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority', 'medium') === 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High</option>
                        <option value="urgent" {{ old('priority') === 'urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1">Assignee</label>
                    <select name="assigned_to" class="w-full bg-zinc-950 border border-zinc-800 rounded-md px-3 py-2 text-sm text-white focus:outline-none focus:border-zinc-500 transition">
                        <option value="">Unassigned</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ old('assigned_to') == $member->id ? 'selected' : '' }}>
                                {{ $member->name }} {{ $member->id === $workspace->user_id ? '(Owner)' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1">Due Date</label>
                    <input type="date" name="due_date" value="{{ old('due_date') }}"
                        class="w-full bg-zinc-950 border border-zinc-800 rounded-md px-3 py-2 text-sm text-white focus:outline-none focus:border-zinc-500 transition">
                </div>
            </div>

            <div class="pt-4 border-t border-zinc-800/80">
                <button type="submit" class="w-full py-2 bg-white text-black font-medium text-xs rounded-md hover:bg-zinc-200 transition">
                    Create Task
                </button>
            </div>
        </form>
    </div>
</div>
@endsection