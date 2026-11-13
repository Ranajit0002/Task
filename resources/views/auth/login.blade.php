@extends('layouts.guest')

@section('title', 'TaskFlow - Log In')

@section('content')
<div class="w-full max-w-md mx-auto relative bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl space-y-6">
    
    <!-- Close / Back to Home Icon -->
    <a href="{{ route('home') }}" class="absolute top-4 right-4 text-zinc-400 hover:text-white transition p-1.5 rounded-lg hover:bg-zinc-800" title="Back to Home">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </a>

    <!-- Header -->
    <div class="space-y-1 text-center">
        <h1 class="text-xl font-bold text-white tracking-tight">Welcome Back</h1>
        <p class="text-xs text-zinc-400">Enter your credentials to access your workspaces.</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="text-xs font-medium text-emerald-400 bg-emerald-950/50 border border-emerald-900/50 p-3 rounded-lg text-center">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-medium text-zinc-300 mb-1">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 focus:outline-none focus:border-zinc-500 transition" />
            @error('email')
                <span class="text-[11px] text-red-400 mt-1 block">{{ $message }}</span>
            @else
                <span class="text-[10px] text-zinc-500 mt-1 block">Enter your registered email address.</span>
            @enderror
        </div>

        <!-- Password with Eye Toggle -->
        <div x-data="{ showPassword: false }">
            <div class="flex items-center justify-between mb-1">
                <label for="password" class="block text-xs font-medium text-zinc-300">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-[11px] text-zinc-400 hover:text-white transition">Forgot password?</a>
                @endif
            </div>
            <div class="relative">
                <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password" 
                    class="w-full px-3 py-2 pr-10 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 focus:outline-none focus:border-zinc-500 transition" />
                
                <!-- Eye Toggle Button -->
                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-zinc-400 hover:text-zinc-200 focus:outline-none">
                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.03 10.03 0 012.012-3.32m2.42-2.42A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            @error('password')
                <span class="text-[11px] text-red-400 mt-1 block">{{ $message }}</span>
            @else
                <span class="text-[10px] text-zinc-500 mt-1 block">Enter your account password.</span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center pt-1">
            <label for="remember_me" class="flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" class="rounded bg-zinc-950 border-zinc-800 text-zinc-600 focus:ring-0">
                <span class="text-xs text-zinc-400">Remember me</span>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-2.5 bg-white text-black font-semibold text-xs rounded-lg hover:bg-zinc-200 transition mt-2">
            Log In
        </button>
    </form>

    <!-- Footer Switcher -->
    <div class="text-center text-xs text-zinc-500 pt-2 border-t border-zinc-800/60">
        Don't have an account? 
        <a href="{{ route('register') }}" class="text-white font-medium hover:underline ml-1">Sign up</a>
    </div>
</div>
@endsection