<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkspaceMemberController extends Controller
{
    public function store(Request $request, Workspace $workspace)
    {
        // Authorize that the current user owns the workspace
        if ($workspace->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        // Check if user is already a member or the owner
        if ($workspace->user_id === $user->id || $workspace->users()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'User is already a member of this workspace.');
        }

        $workspace->users()->attach($user->id);

        return back()->with('success', 'Member added successfully.');
    }

    public function destroy(Workspace $workspace, User $user)
    {
        // Authorize that the current user owns the workspace
        if ($workspace->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.' );
        }

        // Prevent removing the workspace owner
        if ($workspace->user_id === $user->id) {
            return back()->with('error', 'Cannot remove the workspace owner.');
        }

        $workspace->users()->detach($user->id);

        return back()->with('success', 'Member removed successfully.');
    }
}