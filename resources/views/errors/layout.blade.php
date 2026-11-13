@extends('layouts.guest')

@section('title')
    @yield('code') - @yield('title') | TaskFlow
@endsection

@section('content')
<div class="w-full max-w-md mx-auto text-center space-y-6 py-16">
    <div class="space-y-3">
        <span class="inline-block text-xs font-mono px-3 py-1 rounded-full bg-zinc-900 border border-zinc-800 text-zinc-400 font-semibold uppercase tracking-wider">
            @yield('code') ERROR
        </span>
        <h1 class="text-3xl font-bold text-white tracking-tight">
            @yield('title')
        </h1>
        <p class="text-xs sm:text-sm text-zinc-400 max-w-sm mx-auto leading-relaxed">
            @yield('message')
        </p>
    </div>

    <div class="pt-2">
        @auth
            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-white text-black text-xs font-semibold rounded-lg hover:bg-zinc-200 transition">
                Go to Dashboard &rarr;
            </a>
        @else
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-white text-black text-xs font-semibold rounded-lg hover:bg-zinc-200 transition">
                Back to Home
            </a>
        @endauth
    </div>
</div>
@endsection