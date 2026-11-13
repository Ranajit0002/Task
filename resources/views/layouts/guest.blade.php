<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-zinc-950">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'TaskFlow'))</title>

        <!-- TaskFlow Favicon -->
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23ffffff'><rect width='24' height='24' rx='4'/></svg>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen flex flex-col font-sans antialiased bg-zinc-950 text-zinc-100">
        
        <!-- Global Floating Toast / Modal Notification System -->
        <div aria-live="assertive" class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 z-50 justify-end">
            <div class="w-full flex flex-col items-center space-y-4 sm:items-end">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                         class="max-w-sm w-full bg-zinc-900 border border-emerald-500/30 shadow-2xl rounded-xl pointer-events-auto flex ring-1 ring-black ring-opacity-5 overflow-hidden transition-all duration-300 transform">
                        <div class="p-4 w-full flex items-start gap-3">
                            <span class="flex-shrink-0 w-2 h-2 mt-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <div class="flex-1 text-xs">
                                <p class="font-semibold text-white">Success</p>
                                <p class="text-zinc-400 mt-0.5">{{ session('success') }}</p>
                            </div>
                            <button @click="show = false" class="text-zinc-500 hover:text-white text-sm font-bold">&times;</button>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         class="max-w-sm w-full bg-zinc-900 border border-red-500/30 shadow-2xl rounded-xl pointer-events-auto flex ring-1 ring-black ring-opacity-5 overflow-hidden transition-all duration-300 transform">
                        <div class="p-4 w-full flex items-start gap-3">
                            <span class="flex-shrink-0 w-2 h-2 mt-1.5 rounded-full bg-red-400 animate-pulse"></span>
                            <div class="flex-1 text-xs">
                                <p class="font-semibold text-white">Notice</p>
                                <p class="text-zinc-400 mt-0.5">{{ session('error') }}</p>
                            </div>
                            <button @click="show = false" class="text-zinc-500 hover:text-white text-sm font-bold">&times;</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Top Public Navigation Bar -->
        <nav class="w-full bg-zinc-900 border-b border-zinc-800 sticky top-0 z-50 shrink-0">
            <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
                <!-- Brand -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="w-3.5 h-3.5 bg-white inline-block rounded-xs"></span>
                    <span class="font-bold text-base tracking-wider text-white">TASKFLOW</span>
                </a>

                <!-- Navigation Links -->
                <div class="flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-xs font-medium {{ request()->routeIs('home') ? 'text-white font-semibold' : 'text-zinc-400 hover:text-white' }} transition">Home</a>
                    <a href="{{ route('pricing') }}" class="text-xs font-medium {{ request()->routeIs('pricing') ? 'text-white font-semibold' : 'text-zinc-400 hover:text-white' }} transition">Pricing</a>
                    <a href="{{ route('contact') }}" class="text-xs font-medium {{ request()->routeIs('contact') ? 'text-white font-semibold' : 'text-zinc-400 hover:text-white' }} transition">Contact</a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-white text-black text-xs font-semibold rounded-lg hover:bg-zinc-200 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-xs font-medium text-zinc-300 hover:text-white transition px-2 py-1">Log In</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-black text-xs font-semibold rounded-lg hover:bg-zinc-200 transition">Sign Up</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Main Content Area -->
        <main class="flex-1 w-full max-w-7xl mx-auto px-6 py-8 flex flex-col justify-center">
            @yield('content')
        </main>

        <!-- Minimal Footer -->
        <footer class="w-full py-5 text-xs text-zinc-500 border-t border-zinc-900 bg-zinc-950 shrink-0">
            <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                <!-- Left: Copyright -->
                <div>
                    &copy; {{ date('Y') }} TaskFlow
                </div>

                <!-- Middle: Essential Legal Links -->
                <div class="flex items-center justify-center gap-4">
                    <a href="{{ route('privacy') }}" class="hover:text-zinc-300 transition">Privacy & Policiy</a>
                    <span class="text-zinc-800">&bull;</span>
                    <a href="{{ route('terms') }}" class="hover:text-zinc-300 transition">Terms & Condition</a>
                </div>

                <!-- Right: Status / Version -->
                <div class="font-mono text-[11px] text-zinc-600">
                    v1.1.0
                </div>
            </div>
        </footer>
    </body>
</html>