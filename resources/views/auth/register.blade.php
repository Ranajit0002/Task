@extends('layouts.guest')

@section('title', 'TaskFlow - Create Account')

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
        <h1 class="text-xl font-bold text-white tracking-tight">Create an Account</h1>
        <p class="text-xs text-zinc-400">Get started managing your workspaces with TaskFlow.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-medium text-zinc-300 mb-1">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                pattern="^[a-zA-Z\s'-]{2,50}$" 
                title="Name should only contain letters, spaces, hyphens, and apostrophes (2-50 characters)."
                class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 focus:outline-none focus:border-zinc-500 transition" />
            @error('name')
                <span class="text-[11px] text-red-400 mt-1 block">{{ $message }}</span>
            @else
                <span class="text-[10px] text-zinc-500 mt-1 block">Letters and spaces only (min 2 chars).</span>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-medium text-zinc-300 mb-1">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                title="Please enter a valid email address."
                class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 focus:outline-none focus:border-zinc-500 transition" />
            @error('email')
                <span class="text-[11px] text-red-400 mt-1 block">{{ $message }}</span>
            @else
                <span class="text-[10px] text-zinc-500 mt-1 block">Must be a valid email format.</span>
            @enderror
        </div>

        <!-- Password with Alpine.js Show/Hide Eye Toggle -->
        <div x-data="{ showPassword: false }">
            <label for="password" class="block text-xs font-medium text-zinc-300 mb-1">Password</label>
            <div class="relative">
                <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="new-password" 
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                    title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters."
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
                <span class="text-[10px] text-zinc-500 mt-1 block">Min 8 chars, 1 uppercase, 1 lowercase, 1 number.</span>
            @enderror
        </div>

        <!-- Confirm Password with Alpine.js Show/Hide Eye Toggle -->
        <div x-data="{ showConfirmPassword: false }">
            <label for="password_confirmation" class="block text-xs font-medium text-zinc-300 mb-1">Confirm Password</label>
            <div class="relative">
                <input id="password_confirmation" :type="showConfirmPassword ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password" 
                    class="w-full px-3 py-2 pr-10 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 focus:outline-none focus:border-zinc-500 transition" />
                
                <!-- Eye Toggle Button -->
                <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-zinc-400 hover:text-zinc-200 focus:outline-none">
                    <svg x-show="!showConfirmPassword" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="showConfirmPassword" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.03 10.03 0 012.012-3.32m2.42-2.42A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            @error('password_confirmation')
                <span class="text-[11px] text-red-400 mt-1 block">{{ $message }}</span>
            @else
                <span class="text-[10px] text-zinc-500 mt-1 block">Must match the password above.</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-2.5 bg-white text-black font-semibold text-xs rounded-lg hover:bg-zinc-200 transition mt-2">
            Create Account
        </button>
    </form>

    <!-- Footer Switcher -->
    <div class="text-center text-xs text-zinc-500 pt-2 border-t border-zinc-800/60">
        Already have an account? 
        <a href="{{ route('login') }}" class="text-white font-medium hover:underline ml-1">Log in</a>
    </div>
</div>
@endsection