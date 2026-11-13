<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $userId = Auth::id();

        // Workspaces owned or shared
        $workspaces = Workspace::where('user_id', $userId)
            ->orWhereHas('users', fn($q) => $q->where('users.id', $userId))
            ->with('projects.tasks')
            ->get();

        $workspaceIds = $workspaces->pluck('id');
        $projectIds = Project::whereIn('workspace_id', $workspaceIds)->pluck('id');

        // Analytics Metrics
        $totalWorkspaces = $workspaces->count();
        $totalProjects = Project::whereIn('workspace_id', $workspaceIds)->count();
        
        $tasks = Task::whereIn('project_id', $projectIds)->get();
        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('status', 'done')->count();
        $pendingTasks = $totalTasks - $completedTasks;
        
        $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        // Tasks assigned to current user
        $assignedTasks = Task::where('assigned_to', $userId)
            ->with('project.workspace')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalWorkspaces', 
            'totalProjects', 
            'totalTasks', 
            'completedTasks', 
            'pendingTasks', 
            'completionRate', 
            'assignedTasks',
            'workspaces'
        ));
    }
}