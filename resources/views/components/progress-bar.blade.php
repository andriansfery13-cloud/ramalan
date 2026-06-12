@props([
    'value' => 0,
    'max' => 100,
    'color' => 'blue',
    'label' => '',
    'animated' => true,
    'showPercent' => true,
    'height' => 'h-3',
])

@php
$colors = [
    'blue' => 'from-primary-600 to-primary-400',
    'purple' => 'from-purple-600 to-purple-400',
    'pink' => 'from-pink-600 to-pink-400',
    'green' => 'from-green-600 to-green-400',
    'cyan' => 'from-cyan-600 to-cyan-400',
    'orange' => 'from-orange-600 to-orange-400',
    'red' => 'from-red-600 to-red-400',
    'gold' => 'from-yellow-600 to-yellow-400',
];
$percent = $max > 0 ? min(($value / $max) * 100, 100) : 0;
$glowColors = [
    'blue' => 'shadow-primary-500/30',
    'purple' => 'shadow-purple-500/30',
    'pink' => 'shadow-pink-500/30',
    'green' => 'shadow-green-500/30',
    'cyan' => 'shadow-cyan-500/30',
    'orange' => 'shadow-orange-500/30',
    'red' => 'shadow-red-500/30',
    'gold' => 'shadow-yellow-500/30',
];
@endphp

<div {{ $attributes }}>
    @if($label || $showPercent)
        <div class="flex justify-between items-center mb-1.5">
            @if($label)
                <span class="text-sm text-slate-300">{{ $label }}</span>
            @endif
            @if($showPercent)
                <span class="text-sm font-semibold text-slate-200">{{ round($percent) }}%</span>
            @endif
        </div>
    @endif
    <div class="w-full {{ $height }} bg-white/5 rounded-full overflow-hidden">
        <div class="h-full rounded-full bg-gradient-to-r {{ $colors[$color] ?? $colors['blue'] }} shadow-lg {{ $glowColors[$color] ?? '' }} transition-all duration-1000 ease-out"
             style="width: {{ $percent }}%"
             @if($animated) x-data x-init="$el.style.width = '0%'; setTimeout(() => $el.style.width = '{{ $percent }}%', 100)" @endif>
        </div>
    </div>
</div>
