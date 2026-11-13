@extends('layouts.guest')

@section('title', 'TaskFlow - Privacy Policy')

@section('content')
<div class="w-full max-w-3xl mx-auto space-y-8 py-8">
    <div class="space-y-2">
        <h1 class="text-3xl font-bold text-white tracking-tight">Privacy Policy</h1>
        <p class="text-xs text-zinc-400">Last updated: November 2026</p>
    </div>

    <div class="space-y-6 text-sm text-zinc-300 leading-relaxed bg-zinc-900 border border-zinc-800 p-8 rounded-2xl">
        <div class="space-y-2">
            <h2 class="text-base font-semibold text-white">1. Information We Collect</h2>
            <p class="text-xs text-zinc-400">When you register for TaskFlow, we collect your name, email address, and secure credential hashes. Within your workspaces, we store project data, tasks, comments, and member rosters that you explicitly provide.</p>
        </div>

        <div class="space-y-2">
            <h2 class="text-base font-semibold text-white">2. How We Use Your Information</h2>
            <p class="text-xs text-zinc-400">Your information is used strictly to provide, maintain, and secure your collaborative workspaces, authenticate your user account, and route team notifications.</p>
        </div>

        <div class="space-y-2">
            <h2 class="text-base font-semibold text-white">3. Data Security</h2>
            <p class="text-xs text-zinc-400">We employ industry-standard security measures, including prepared SQL statements, hashed passwords, and granular role authorization checks, to safeguard your data against unauthorized access.</p>
        </div>

        <div class="space-y-2">
            <h2 class="text-base font-semibold text-white">4. Contact Us</h2>
            <p class="text-xs text-zinc-400">If you have any questions about this Privacy Policy, please reach out via our <a href="{{ route('contact') }}" class="text-white underline">Contact page</a>.</p>
        </div>
    </div>
</div>
@endsection