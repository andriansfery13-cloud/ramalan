@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'loading' => false,
])

@php
$variants = [
    'primary' => 'gradient-primary text-white glow-blue hover:opacity-90',
    'secondary' => 'glass text-slate-200 hover:bg-white/10',
    'danger' => 'bg-red-600/80 text-white hover:bg-red-600',
    'success' => 'bg-green-600/80 text-white hover:bg-green-600',
    'ghost' => 'text-slate-300 hover:bg-white/5 hover:text-white',
    'neon-purple' => 'bg-purple-600/80 text-white glow-purple hover:bg-purple-600',
    'neon-pink' => 'bg-pink-600/80 text-white glow-pink hover:bg-pink-600',
    'neon-cyan' => 'bg-cyan-600/80 text-white glow-cyan hover:bg-cyan-600',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-xs rounded-lg',
    'md' => 'px-5 py-2.5 text-sm rounded-xl',
    'lg' => 'px-7 py-3.5 text-base rounded-xl',
    'xl' => 'px-9 py-4 text-lg rounded-2xl',
];
@endphp

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => "inline-flex items-center justify-center gap-2 font-semibold transition-all duration-300 active:scale-95 disabled:opacity-50 disabled:pointer-events-none {$variants[$variant]} {$sizes[$size]}"]) }}
    @if($loading) wire:loading.attr="disabled" @endif>

    @if($loading)
        <svg wire:loading class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
        </svg>
    @endif

    {{ $slot }}
</button>
