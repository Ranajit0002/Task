<aside class="w-64 bg-zinc-950 border-r border-zinc-800 flex flex-col h-full shrink-0">
    <!-- Brand Header -->
    <div class="h-16 flex items-center px-6 border-b border-zinc-800">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <span class="w-3.5 h-3.5 bg-white inline-block rounded-xs"></span>
            <span class="font-bold text-base tracking-wider text-white">TASKFLOW</span>
        </a>
    </div>

    <!-- Main Sidebar Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto w-full">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-zinc-800 text-white shadow-sm' : 'text-zinc-400 hover:text-white hover:bg-zinc-900' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            <span>Dashboard</span>
        </a>

        <!-- Workspaces -->
        <a href="{{ route('workspaces.index') }}" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('workspaces*') ? 'bg-zinc-800 text-white shadow-sm' : 'text-zinc-400 hover:text-white hover:bg-zinc-900' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            <span>Workspaces</span>
        </a>

        <!-- Projects -->
        <a href="{{ route('projects.index') }}" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('projects*') ? 'bg-zinc-800 text-white shadow-sm' : 'text-zinc-400 hover:text-white hover:bg-zinc-900' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            <span>Projects</span>
        </a>

        <!-- Tasks -->
        <a href="{{ route('tasks.index') }}" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('tasks*') ? 'bg-zinc-800 text-white shadow-sm' : 'text-zinc-400 hover:text-white hover:bg-zinc-900' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Tasks</span>
        </a>

        <!-- Divider -->
        <div class="pt-4 pb-2">
            <div class="w-full border-t border-zinc-800"></div>
        </div>

        <!-- Home (Landing Page) Link -->
        <a href="{{ url('/') }}" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-zinc-400 hover:text-white hover:bg-zinc-900 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span>Home</span>
        </a>
    </nav>

    <!-- Sidebar Bottom Footer -->
    <div class="p-4 border-t border-zinc-800 bg-zinc-950 w-full space-y-4">
        @auth
            <!-- 1. Profile Setting Button (Placed Top) -->
            <a href="{{ route('profile.edit') }}" class="w-full flex items-center justify-between px-3 py-2 text-xs font-medium text-zinc-300 bg-zinc-900 hover:bg-zinc-800 border border-zinc-800 rounded-lg transition">
                <span>Profile Settings</span>
                <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>

            <!-- 2. User Info & Logout Button (Placed Bottom) -->
            <div class="pt-2 border-t border-zinc-900 space-y-3">
                <div class="px-1">
                    <p class="text-xs font-semibold text-zinc-100 truncate">{{ Auth::user()?->name }}</p>
                    <p class="text-[10px] text-zinc-500 truncate">{{ Auth::user()?->email }}</p>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full text-center py-2 px-3 bg-zinc-900 hover:bg-red-950/60 border border-zinc-800 hover:border-red-900 text-red-400 rounded-lg text-xs font-medium transition">
                        Log Out
                    </button>
                </form>
            </div>
        @else
            <!-- Guest Auth Buttons -->
            <div class="space-y-2 w-full">
                <a href="{{ route('login') }}" class="block text-center w-full py-2 bg-zinc-900 border border-zinc-800 text-zinc-200 rounded-lg text-xs font-medium hover:bg-zinc-800 transition">Log In</a>
                <a href="{{ route('register') }}" class="block text-center w-full py-2 bg-white text-black rounded-lg text-xs font-medium hover:bg-zinc-200 transition">Sign Up</a>
            </div>
        @endauth
    </div>
</aside>