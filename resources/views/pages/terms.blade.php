@extends('layouts.guest')

@section('title', 'TaskFlow - Terms of Service')

@section('content')
<div class="w-full max-w-3xl mx-auto space-y-8 py-8">
    <div class="space-y-2">
        <h1 class="text-3xl font-bold text-white tracking-tight">Terms of Service</h1>
        <p class="text-xs text-zinc-400">Last updated: November 2026</p>
    </div>

    <div class="space-y-6 text-sm text-zinc-300 leading-relaxed bg-zinc-900 border border-zinc-800 p-8 rounded-2xl">
        <div class="space-y-2">
            <h2 class="text-base font-semibold text-white">1. Acceptance of Terms</h2>
            <p class="text-xs text-zinc-400">By accessing or using TaskFlow, you agree to be bound by these Terms of Service. If you do not agree to all terms, you may not access or use the application.</p>
        </div>

        <div class="space-y-2">
            <h2 class="text-base font-semibold text-white">2. Workspace Accounts & Security</h2>
            <p class="text-xs text-zinc-400">You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your workspace membership.</p>
        </div>

        <div class="space-y-2">
            <h2 class="text-base font-semibold text-white">3. Acceptable Use</h2>
            <p class="text-xs text-zinc-400">You agree not to misuse the TaskFlow platform, attempt unauthorized access to other tenant workspaces, or upload malicious code.</p>
        </div>

        <div class="space-y-2">
            <h2 class="text-base font-semibold text-white">4. Modifications</h2>
            <p class="text-xs text-zinc-400">We reserve the right to modify these terms at any time. Continued use of TaskFlow following updates constitutes your acceptance of the revised terms.</p>
        </div>
    </div>
</div>
@endsection