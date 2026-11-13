@extends('layouts.app')

@section('title', $workspace->name . ' - TaskFlow')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <!-- Top Header Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-zinc-800 pb-4">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-bold tracking-tight text-white">{{ $workspace->name }}</h1>
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-zinc-900 text-zinc-300 border border-zinc-800 uppercase font-mono tracking-wider">
                    Workspace
                </span>
            </div>
            <p class="text-xs text-zinc-500 font-mono mt-1">slug: {{ $workspace->slug }}</p>
        </div>
        <div>
            <a href="{{ route('workspaces.index') }}" class="inline-flex items-center px-3 py-1.5 bg-zinc-900 border border-zinc-800 text-zinc-300 text-xs font-medium rounded-lg hover:bg-zinc-800 transition">
                &larr; Back to Workspaces
            </a>
        </div>
    </div>

    <!-- Success Message Banner -->
    @if(session('success'))
        <div class="p-4 rounded-lg bg-emerald-950/40 border border-emerald-900/50 text-xs text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Validation Banner -->
    @if($errors->any() && !$errors->has('email'))
        <div class="p-4 rounded-lg bg-red-950/40 border border-red-900/50 text-xs text-red-300">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Grid for Projects and Members -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Projects Section (Spans 2 Columns) -->
        <div class="md:col-span-2 space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold text-white uppercase tracking-wider">Projects</h2>
                <a href="{{ route('workspaces.projects.create', $workspace) }}" class="inline-flex items-center px-3 py-1.5 bg-white text-black text-xs font-semibold rounded-lg hover:bg-zinc-200 transition">
                    + New Project
                </a>
            </div>

            <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6 space-y-4 shadow-sm">
                @forelse($workspace->projects as $project)
                    <div class="py-3 border-b border-zinc-800/80 last:border-0 flex items-center justify-between gap-4">
                        <div class="space-y-0.5 truncate">
                            <a href="{{ route('workspaces.projects.show', [$workspace, $project]) }}" class="text-sm font-medium text-white hover:underline truncate block">
                                {{ $project->name }}
                            </a>
                            <p class="text-xs text-zinc-400 truncate">{{ Str::limit($project->description ?? '', 80) }}</p>
                        </div>
                        <div class="flex items-center gap-4 shrink-0">
                            <a href="{{ route('workspaces.projects.show', [$workspace, $project]) }}" class="text-xs text-zinc-300 hover:text-white font-medium">
                                View &rarr;
                            </a>
                            <form action="{{ route('workspaces.projects.destroy', [$workspace, $project]) }}" method="POST" onsubmit="return confirm('Delete this project? All associated tasks will be removed.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-400 hover:text-red-300 transition">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 space-y-2">
                        <p class="text-xs text-zinc-400">No projects in this workspace yet.</p>
                        <a href="{{ route('workspaces.projects.create', $workspace) }}" class="inline-block text-xs text-white font-medium hover:underline">Create your first project &rarr;</a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Members Section (Spans 1 Column) -->
        <div class="space-y-6">
            <!-- Members List Card -->
            <div class="space-y-4">
                <h2 class="text-sm font-semibold text-white uppercase tracking-wider">Members</h2>
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 space-y-4 shadow-sm">
                    <!-- Owner Info -->
                    <div class="flex items-center justify-between text-xs">
                        <div class="truncate">
                            <span class="text-white font-semibold block truncate">{{ $workspace->owner->name }}</span>
                            <span class="text-[11px] text-zinc-400 truncate block">{{ $workspace->owner->email }}</span>
                        </div>
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-zinc-950 text-zinc-300 border border-zinc-800 uppercase font-mono tracking-wider shrink-0">Owner</span>
                    </div>

                    <!-- Shared Members -->
                    @foreach($workspace->users as $member)
                        @if($member->id !== $workspace->user_id)
                            <div class="flex items-center justify-between text-xs pt-3 border-t border-zinc-800/80">
                                <div class="truncate">
                                    <span class="text-zinc-200 font-medium block truncate">{{ $member->name }}</span>
                                    <span class="text-[11px] text-zinc-400 truncate block">{{ $member->email }}</span>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-zinc-950 text-zinc-400 border border-zinc-800 uppercase font-mono tracking-wider">
                                        {{ $member->pivot->role }}
                                    </span>
                                    <form action="{{ route('workspaces.members.destroy', [$workspace, $member]) }}" method="POST" onsubmit="return confirm('Remove member from workspace?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-zinc-500 hover:text-red-400 text-sm font-bold px-1 transition" title="Remove Member">&times;</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Invite Form Card -->
            <div class="space-y-4">
                <h2 class="text-sm font-semibold text-white uppercase tracking-wider">Invite Member</h2>
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 shadow-sm">
                    <form action="{{ route('workspaces.members.store', $workspace) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1">User Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-xs text-zinc-100 placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition"
                                placeholder="colleague@example.com">
                            @error('email')
                                <p class="text-xs text-red-400 mt-1.5 flex items-center gap-1.5 font-mono">
                                    <span class="w-1 h-1 rounded-full bg-red-400 shrink-0"></span>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="role" class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1">Role</label>
                            <select name="role" id="role" class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-xs text-zinc-100 focus:outline-none focus:border-zinc-500 transition">
                                <option value="member" {{ old('role') === 'member' ? 'selected' : '' }}>Member</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="viewer" {{ old('role') === 'viewer' ? 'selected' : '' }}>Viewer</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full py-2 bg-white text-black text-xs font-semibold rounded-lg hover:bg-zinc-200 transition">
                            Invite User
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection