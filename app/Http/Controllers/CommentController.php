<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Workspace $workspace, Project $project, Task $task)
    {
        $this->authorizeAccess($workspace);

        if ($task->project_id !== $project->id) {
            abort(404);
        }

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $task->comments()->create([
            'user_id' => Auth::id(),
            'body' => $validated['body'],
        ]);

        return back()->with('success', 'Comment added successfully.');
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