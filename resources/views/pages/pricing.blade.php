@extends('layouts.guest')

@section('title', 'TaskFlow - Pricing Plans')

@section('content')
<div class="w-full max-w-5xl mx-auto space-y-10 py-6">
    <div class="text-center space-y-3">
        <h1 class="text-3xl font-bold text-white tracking-tight">Simple, Transparent Pricing</h1>
        <p class="text-xs sm:text-sm text-zinc-400 max-w-lg mx-auto">Choose a plan tailored for individual developers, growing teams, or enterprise management.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Free Plan -->
        <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl space-y-6 flex flex-col justify-between">
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
        <div class="bg-zinc-900 border-2 border-white p-6 rounded-xl space-y-6 flex flex-col justify-between relative">
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
        <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl space-y-6 flex flex-col justify-between">
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
            <a href="{{ route('contact') }}" class="w-full text-center py-2.5 bg-zinc-800 hover:bg-zinc-700 text-white text-xs font-medium rounded-lg transition">Contact Sales</a>
        </div>
    </div>
</div>
@endsection