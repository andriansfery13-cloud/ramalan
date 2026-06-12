@props(['class' => '', 'hover' => true, 'padding' => 'p-6'])

<div {{ $attributes->merge(['class' => "glass rounded-2xl {$padding} {$class}" . ($hover ? ' hover:border-white/10 transition-all duration-300' : '')]) }}>
    {{ $slot }}
</div>
