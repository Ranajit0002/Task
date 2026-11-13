<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use App\Enums\WorkspaceRoleEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class WorkspaceController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $workspaces = $user->workspaces()->withPivot('role')->get()
            ->merge($user->ownedWorkspaces)
            ->unique('id');

        return view('workspaces.index', compact('workspaces'));
    }

    public function create()
    {
        return view('workspaces.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s\-_]+$/'],
        ], [
            'name.regex' => 'The workspace name may only contain letters, numbers, spaces, hyphens, and underscores.',
        ]);

        $workspace = Workspace::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . Str::random(5),
            'user_id' => Auth::id(),
        ]);

        $workspace->users()->attach(Auth::id(), [
            'role' => WorkspaceRoleEnum::OWNER->value
        ]);

        return redirect()->route('workspaces.index')
            ->with('success', 'Workspace created successfully.');
    }

    public function show(Workspace $workspace)
    {
        $this->authorizeAccess($workspace);
        $workspace->load('projects', 'users');

        return view('workspaces.show', compact('workspace'));
    }

    public function edit(Workspace $workspace)
    {
        $this->authorizeAccess($workspace);

        return view('workspaces.edit', compact('workspace'));
    }

    public function update(Request $request, Workspace $workspace)
    {
        $this->authorizeAccess($workspace);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s\-_]+$/'],
        ], [
            'name.regex' => 'The workspace name may only contain letters, numbers, spaces, hyphens, and underscores.',
        ]);

        $updateData = ['name' => $validated['name']];

        if ($workspace->name !== $validated['name']) {
            $updateData['slug'] = Str::slug($validated['name']) . '-' . Str::random(5);
        }

        $workspace->update($updateData);

        return redirect()->route('workspaces.index')
            ->with('success', 'Workspace updated successfully.');
    }

    public function destroy(Workspace $workspace)
    {
        if ($workspace->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $workspace->delete();

        return redirect()->route('workspaces.index')
            ->with('success', 'Workspace deleted successfully.');
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