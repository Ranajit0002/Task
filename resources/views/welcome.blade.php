@extends('layouts.guest')

@section('title', 'TaskFlow - Collaborative Project Management')

@section('content')
<div class="w-full mx-auto space-y-24 py-12">

    <!-- 1. HERO SECTION -->
    <section class="text-center space-y-8 pt-6">
        <h1 class="text-4xl sm:text-6xl font-extrabold text-white tracking-tight leading-tight">
            Manage projects, tasks, and team workspaces with zero clutter.
        </h1>

        <p class="text-sm sm:text-base text-zinc-400 max-w-2xl mx-auto leading-relaxed">
            TaskFlow combines high-contrast dark design aesthetics with powerful workspace role hierarchies, instant project tracking, and focused team collaboration.
        </p>

        <div class="flex items-center justify-center gap-4 pt-4">
            @auth
            <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-white text-black font-semibold text-xs sm:text-sm rounded-lg hover:bg-zinc-200 transition">
                Open Dashboard &rarr;
            </a>
            @else
            <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-black font-semibold text-xs sm:text-sm rounded-lg hover:bg-zinc-200 transition">
                Get Started Free
            </a>
            <a href="#pricing" class="px-6 py-3 bg-zinc-900 border border-zinc-800 text-zinc-200 font-semibold text-xs sm:text-sm rounded-lg hover:bg-zinc-800 transition">
                View Pricing
            </a>
            @endauth
        </div>

        <!-- Feature Grid Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left pt-12">
            <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl space-y-2 shadow-sm">
                <h3 class="text-sm font-semibold text-white">Collaborative Workspaces</h3>
                <p class="text-xs text-zinc-400 leading-relaxed">Organize projects by team or client instance with granular role permissions.</p>
            </div>
            <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl space-y-2 shadow-sm">
                <h3 class="text-sm font-semibold text-white">Project Dashboards</h3>
                <p class="text-xs text-zinc-400 leading-relaxed">Track task statuses, assign team members, and monitor deadlines effortlessly.</p>
            </div>
            <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl space-y-2 shadow-sm">
                <h3 class="text-sm font-semibold text-white">High-Speed Execution</h3>
                <p class="text-xs text-zinc-400 leading-relaxed">Built with Tailwind v4 and Alpine.js for zero layout shifting and rapid responsiveness.</p>
            </div>
        </div>
    </section>

    <!-- 2. PRICING SECTION -->
    <section id="pricing" class="space-y-10 pt-12 border-t border-zinc-900 scroll-mt-20">
        <div class="text-center space-y-3">
            <h2 class="text-3xl font-bold text-white tracking-tight">Simple, Transparent Pricing</h2>
            <p class="text-xs sm:text-sm text-zinc-400 max-w-lg mx-auto">Choose a plan tailored for individual developers, growing teams, or enterprise management.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Free Plan -->
            <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl space-y-6 flex flex-col justify-between shadow-sm">
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-zinc-300">Starter</h3>
                    <div class="text-3xl font-bold text-white">$0 <span class="text-xs text-zinc-500 font-normal">/ month</span></div>
                    <ul class="text-xs text-zinc-400 space-y-2">
                        <li>&check; 1 Active Workspace</li>
                        <li>&check; Up to 3 Projects</li>
                        <li>&check; Unlimited Tasks</li>
                        <li>&check; Community Support</li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="w-full text-center py-2.5 bg-zinc-800 hover:bg-zinc-700 text-white text-xs font-medium rounded-lg transition">Start Free</a>
            </div>

            <!-- Pro Plan -->
            <div class="bg-zinc-900 border-2 border-white p-6 rounded-xl space-y-6 flex flex-col justify-between relative shadow-lg">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-0.5 bg-white text-black text-[10px] font-extrabold uppercase rounded-full">Most Popular</div>
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-white">Pro Team</h3>
                    <div class="text-3xl font-bold text-white">$12 <span class="text-xs text-zinc-500 font-normal">/ member / mo</span></div>
                    <ul class="text-xs text-zinc-300 space-y-2">
                        <li>&check; Unlimited Workspaces</li>
                        <li>&check; Unlimited Projects</li>
                        <li>&check; Advanced Task Enums & Priority</li>
                        <li>&check; Priority Support</li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="w-full text-center py-2.5 bg-white hover:bg-zinc-200 text-black text-xs font-semibold rounded-lg transition">Upgrade to Pro</a>
            </div>

            <!-- Enterprise Plan -->
            <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl space-y-6 flex flex-col justify-between shadow-sm">
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-zinc-300">Enterprise</h3>
                    <div class="text-3xl font-bold text-white">Custom</div>
                    <ul class="text-xs text-zinc-400 space-y-2">
                        <li>&check; Dedicated Infrastructure</li>
                        <li>&check; Custom Security Controls</li>
                        <li>&check; 99.9% Uptime SLA</li>
                        <li>&check; 24/7 Phone & Email Support</li>
                    </ul>
                </div>
                <a href="#contact" class="w-full text-center py-2.5 bg-zinc-800 hover:bg-zinc-700 text-white text-xs font-medium rounded-lg transition">Contact Sales</a>
            </div>
        </div>
    </section>

    <!-- 3. CONTACT SECTION -->
    <section id="contact" class="max-w-xl mx-auto space-y-6 pt-12 border-t border-zinc-900 scroll-mt-20">
        <div class="text-center space-y-2">
            <h2 class="text-2xl font-bold text-white">Get in Touch</h2>
            <p class="text-xs text-zinc-400">Have questions about TaskFlow? Send us a message below.</p>
        </div>

<!-- Added #contact anchor so the browser maintains scroll position on submit -->
<form action="{{ route('contact') }}#contact" method="POST" novalidate class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl space-y-4 shadow-xl">
    @csrf
    <div>
        <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"
            class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition" />
        @error('name')
            <p class="text-xs text-red-400 mt-1.5 flex items-center gap-1.5 font-mono">
                <span class="w-1 h-1 rounded-full bg-red-400 shrink-0"></span>
                <span>{{ $message }}</span>
            </p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1">Email Address</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}"
            class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition" />
        @error('email')
            <p class="text-xs text-red-400 mt-1.5 flex items-center gap-1.5 font-mono">
                <span class="w-1 h-1 rounded-full bg-red-400 shrink-0"></span>
                <span>{{ $message }}</span>
            </p>
        @enderror
    </div>

    <div>
        <label for="message" class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1">Message</label>
        <textarea id="message" name="message" rows="4"
            class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition resize-none">{{ old('message') }}</textarea>
        @error('message')
            <p class="text-xs text-red-400 mt-1.5 flex items-center gap-1.5 font-mono">
                <span class="w-1 h-1 rounded-full bg-red-400 shrink-0"></span>
                <span>{{ $message }}</span>
            </p>
        @enderror
    </div>

    <button type="submit" class="w-full py-2.5 bg-white text-black font-semibold text-xs rounded-lg hover:bg-zinc-200 transition">
        Send Message
    </button>
</form>
    </section>

</div>
@endsection