<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-zinc-950">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TaskFlow') }}</title>

    <!-- TaskFlow Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23ffffff'><rect width='24' height='24' rx='4'/></svg>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-sans antialiased bg-zinc-950 text-zinc-100 overflow-hidden selection:bg-white selection:text-black">
    
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

    <div class="flex h-screen w-full bg-zinc-950 overflow-hidden">
        <!-- Sidebar Navigation Component -->
        @include('layouts.navigation')

        <!-- Main Content Container -->
        <div class="flex-1 flex flex-col h-full overflow-hidden bg-zinc-950">

            <!-- Top Header Bar with Notifications -->
            <header class="h-16 border-b border-zinc-800 bg-zinc-900/50 backdrop-blur px-8 flex items-center justify-between shrink-0 w-full">
                <div class="text-xs font-mono text-zinc-400">
                    WORKSPACE ENVIRONMENT // <span class="text-white uppercase font-semibold">Active Tenant</span>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Notifications Dropdown (Alpine.js) -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="relative p-2 text-zinc-400 hover:text-white transition focus:outline-none bg-zinc-900 border border-zinc-800 rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>

                            @if(auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute top-1 right-1 w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                            @endif
                        </button>

                        <!-- Dropdown Panel -->
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-zinc-900 border border-zinc-800 rounded-xl shadow-2xl py-2 z-50 text-xs" style="display: none;">
                            <div class="px-4 py-2 border-b border-zinc-800 flex items-center justify-between">
                                <span class="font-semibold text-white uppercase tracking-wider">Notifications</span>
                                @if(auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                                <form action="{{ route('notifications.readAll') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-[10px] text-zinc-400 hover:text-white underline">Mark all as read</button>
                                </form>
                                @endif
                            </div>

                            <div class="max-h-64 overflow-y-auto divide-y divide-zinc-800/60">
                                @if(auth()->check())
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                <div class="p-3 hover:bg-zinc-800/50 transition flex items-start justify-between gap-2">
                                    <a href="{{ $notification->data['url'] ?? '#' }}" class="space-y-1 flex-1">
                                        <p class="font-semibold text-white">{{ $notification->data['title'] ?? 'Notification' }}</p>
                                        <p class="text-zinc-400 text-[11px]">{{ $notification->data['message'] ?? '' }}</p>
                                    </a>
                                    <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-zinc-500 hover:text-white font-bold text-sm px-1">&times;</button>
                                    </form>
                                </div>
                                @empty
                                <div class="py-8 text-center text-zinc-500">
                                    No unread notifications.
                                </div>
                                @endforelse
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- User Profile Pill -->
                    <div class="text-xs text-zinc-300 bg-zinc-900 border border-zinc-800 px-3 py-1.5 rounded-lg font-medium">
                        {{ Auth::user()->name ?? 'Account' }}
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Content Area -->
            <main class="flex-1 w-full overflow-y-auto bg-zinc-950 p-8">
                @isset($slot)
                {{ $slot }}
                @else
                @yield('content')
                @endisset
            </main>
        </div>
    </div>
</body>

</html>