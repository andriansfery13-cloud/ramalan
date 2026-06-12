@props(['href', 'active' => false])

<a href="{{ $href }}"
   class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200
          {{ $active
             ? 'text-primary-400 bg-primary-600/10'
             : 'text-slate-300 hover:text-white hover:bg-white/5' }}">
    {{ $slot }}
</a>
