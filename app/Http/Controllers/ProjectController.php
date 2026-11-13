<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $workspaceIds = Workspace::where('user_id', $userId)
            ->orWhereHas('users', fn($q) => $q->where('users.id', $userId))
            ->pluck('id');

        $projects = Project::with(['workspace', 'tasks'])
            ->whereIn('workspace_id', $workspaceIds)
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    public function create(Workspace $workspace)
    {
        $this->authorizeAccess($workspace);

        return view('projects.create', compact('workspace'));
    }

    public function store(Request $request, Workspace $workspace)
    {
        $this->authorizeAccess($workspace);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $workspace->projects()->create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . Str::random(5),
            'description' => $validated['description'],
        ]);

        return redirect()->route('workspaces.show', $workspace)
            ->with('success', 'Project created successfully.');
    }

    public function show(Workspace $workspace, Project $project)
    {
        $this->authorizeAccess($workspace);

        if ($project->workspace_id !== $workspace->id) {
            abort(404);
        }

        $project->load('tasks.assignee', 'tasks.user');

        return view('projects.show', compact('workspace', 'project'));
    }

    public function destroy(Workspace $workspace, Project $project)
    {
        $this->authorizeAccess($workspace);

        if ($project->workspace_id !== $workspace->id) {
            abort(404);
        }

        $project->delete();

        return redirect()->route('workspaces.show', $workspace)
            ->with('success', 'Project deleted successfully.');
    }

    private function authorizeAccess(Workspace $workspace)
    {
        $isOwner = $workspace->user_id === Auth::id();
        $isMember = $workspace->users()->where('user_id', Auth::id())->exists();

        if (!$isOwner && !$isMember) {
            abort(403, 'Unauthorized action.');
        }
    }
}