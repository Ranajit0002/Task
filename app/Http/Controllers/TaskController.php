<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Workspace;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssignedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $workspaceIds = Workspace::where('user_id', $userId)
            ->orWhereHas('users', fn($q) => $q->where('users.id', $userId))
            ->pluck('id');

        $projectIds = Project::whereIn('workspace_id', $workspaceIds)->pluck('id');

        $tasks = Task::with(['project.workspace', 'assignee', 'user'])
            ->whereIn('project_id', $projectIds)
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create(Project $project)
    {
        $workspace = $project->workspace;
        $this->authorizeAccess($workspace);

        $members = $workspace->users->push($workspace->owner)->unique('id');

        return view('tasks.create', compact('workspace', 'project', 'members'));
    }

    public function store(Request $request, Project $project)
    {
        $workspace = $project->workspace;
        $this->authorizeAccess($workspace);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['required', 'string', 'in:low,medium,high,urgent'],
            'status' => ['required', 'string', 'in:backlog,todo,in_progress,in_review,done'],
            'assigned_to' => ['nullable', 'exists:users,id'],
            'due_date' => ['nullable', 'date'],
        ]);

        $task = $project->tasks()->create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'status' => $validated['status'],
            'assigned_to' => $validated['assigned_to'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
        ]);

        if (!empty($task->assigned_to) && $task->assigned_to !== Auth::id()) {
            $assignee = User::find($task->assigned_to);
            if ($assignee) {
                $assignee->notify(new TaskAssignedNotification($task));
            }
        }

        return redirect()->route('workspaces.projects.show', [$workspace, $project])
            ->with('success', 'Task created successfully.');
    }

    public function show(Workspace $workspace, Project $project, Task $task)
    {
        $this->authorizeAccess($workspace);

        if ($task->project_id !== $project->id) {
            abort(404);
        }

        $task->load(['assignee', 'user', 'project', 'comments.user']);

        return view('tasks.show', compact('workspace', 'project', 'task'));
    }

    public function updateStatus(Request $request, Workspace $workspace, Project $project, Task $task)
    {
        $this->authorizeAccess($workspace);

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:backlog,todo,in_progress,in_review,done'],
        ]);

        $task->update(['status' => $validated['status']]);

        return back()->with('success', 'Task status updated.');
    }

    public function destroy(Workspace $workspace, Project $project, Task $task)
    {
        $this->authorizeAccess($workspace);

        if ($task->project_id !== $project->id) {
            abort(404);
        }

        $task->delete();

        return redirect()->route('workspaces.projects.show', [$workspace, $project])
            ->with('success', 'Task deleted successfully.');
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