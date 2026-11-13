<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WorkspaceMemberController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| TaskFlow Web Routes - Public Pages, Authentication, Workspaces, Projects, Tasks, and Collaboration.
|
*/

// Public Front-End Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');

// Contact Form Routes (GET to show form, POST to submit form)
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'storeContact'])->name('contact.store');

Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');

// Authenticated Dashboard & Module Routes
Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Profile Management Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Workspaces Resource Routes
    Route::resource('workspaces', WorkspaceController::class);

    // Workspace Member Management Routes
    Route::post('workspaces/{workspace}/members', [WorkspaceMemberController::class, 'store'])->name('workspaces.members.store');
    Route::delete('workspaces/{workspace}/members/{user}', [WorkspaceMemberController::class, 'destroy'])->name('workspaces.members.destroy');

    // Global Projects Index Route
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

    // Nested Project Resource Routes
    Route::resource('workspaces.projects', ProjectController::class)->except(['index', 'edit', 'update']);

    // Global Tasks Index Route
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

    // Simplified/Direct Project-Level Task Routes for Creation
    Route::get('/projects/{project}/tasks/create', [TaskController::class, 'create'])->name('projects.tasks.create');
    Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])->name('projects.tasks.store');

    // Nested Task Resource Routes (for show, destroy, etc.)
    Route::resource('workspaces.projects.tasks', TaskController::class)->except(['index', 'create', 'store', 'edit', 'update']);
    
    // Task Status Update Route
    Route::patch('workspaces/{workspace}/projects/{project}/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('workspaces.projects.tasks.status');

    // Task Comments Store Route
    Route::post('workspaces/{workspace}/projects/{project}/tasks/{task}/comments', [CommentController::class, 'store'])->name('workspaces.projects.tasks.comments.store');

    // Notification Action Routes
    Route::post('/notifications/{id}/read', function ($id) {
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        return back();
    })->name('notifications.read');

    Route::post('/notifications/read-all', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.readAll');
});

require __DIR__.'/auth.php';