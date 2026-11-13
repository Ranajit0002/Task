@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-xs text-red-400 mt-1.5 space-y-1 font-mono']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-1.5">
                <span class="w-1 h-1 rounded-full bg-red-400 shrink-0"></span>
                <span>{{ $message }}</span>
            </li>
        @endforeach
    </ul>
@endif