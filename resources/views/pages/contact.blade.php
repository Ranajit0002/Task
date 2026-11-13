@extends('layouts.guest')

@section('title', 'TaskFlow - Contact Us')

@section('content')
<div class="w-full max-w-xl mx-auto space-y-6 py-6">
    <div class="text-center space-y-2">
        <h1 class="text-2xl font-bold text-white">Get in Touch</h1>
        <p class="text-xs text-zinc-400">Have questions about TaskFlow? Send us a message below.</p>
    </div>

    <!-- novalidate disables native browser popup tooltips -->
    <form action="{{ route('contact') }}" method="POST" novalidate class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl space-y-4 shadow-xl">
        @csrf
        
        <div>
            <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" autofocus
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
</div>
@endsection