@props([
    'value' => 0,
    'label' => '',
    'icon' => '',
    'trend' => null,
    'color' => 'blue',
])

@php
$gradients = [
    'blue' => 'from-primary-600/20 to-primary-400/5',
    'purple' => 'from-purple-600/20 to-purple-400/5',
    'pink' => 'from-pink-600/20 to-pink-400/5',
    'green' => 'from-green-600/20 to-green-400/5',
    'cyan' => 'from-cyan-600/20 to-cyan-400/5',
    'orange' => 'from-orange-600/20 to-orange-400/5',
];
$textColors = [
    'blue' => 'text-primary-400',
    'purple' => 'text-purple-400',
    'pink' => 'text-pink-400',
    'green' => 'text-green-400',
    'cyan' => 'text-cyan-400',
    'orange' => 'text-orange-400',
];
@endphp

<div class="glass rounded-2xl p-5 hover:border-white/10 transition-all duration-300 group">
    <div class="flex items-start justify-between mb-3">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $gradients[$color] ?? $gradients['blue'] }} flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
            {{ $icon }}
        </div>
        @if($trend !== null)
            <span class="text-xs font-medium {{ $trend >= 0 ? 'text-green-400' : 'text-red-400' }}">
                {{ $trend >= 0 ? '↑' : '↓' }} {{ abs($trend) }}%
            </span>
        @endif
    </div>
    <p class="text-2xl font-bold {{ $textColors[$color] ?? 'text-white' }}" x-data x-init="animateCounter($el, {{ $value }})">0</p>
    <p class="text-sm text-slate-400 mt-1">{{ $label }}</p>
</div>
