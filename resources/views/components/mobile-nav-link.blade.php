@props(['href', 'icon' => ''])

<a href="{{ $href }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm hover:bg-white/5 transition-colors" @click="mobileMenu = false">
    <span>{{ $icon }}</span>
    <span>{{ $slot }}</span>
</a>
