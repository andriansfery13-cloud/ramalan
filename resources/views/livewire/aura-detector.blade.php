<div class="max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-bold font-[Outfit] gradient-text mb-2">🌈 Detektor Aura</h1>
        <p class="text-slate-400">Temukan aura tersembunyi dari namamu!</p>
    </div>

    <x-glass-card class="max-w-md mx-auto mb-8">
        <form wire:submit="detect" class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Nama</label>
                <input type="text" wire:model="name" placeholder="Masukkan nama..." class="text-lg">
                @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
            </div>
            <x-neon-button type="submit" variant="neon-cyan" size="lg" class="w-full" :loading="true">
                <span wire:loading.remove wire:target="detect">🌈 Deteksi Aura</span>
                <span wire:loading wire:target="detect">⏳ Mendeteksi...</span>
            </x-neon-button>
        </form>
    </x-glass-card>

    @if($result)
        <div class="max-w-md mx-auto animate-bounce-in">
            <div class="glass rounded-3xl p-8 text-center relative overflow-hidden" style="border: 2px solid {{ $result['color'] }}40; box-shadow: 0 0 30px {{ $result['color'] }}20, 0 0 60px {{ $result['color'] }}10;">
                {{-- Aura Glow Background --}}
                <div class="absolute inset-0 opacity-10 rounded-3xl" style="background: radial-gradient(circle at center, {{ $result['color'] }}, transparent 70%);"></div>

                <div class="relative z-10">
                    <div class="text-6xl mb-4">{{ $result['emoji'] }}</div>
                    <h2 class="text-2xl font-bold font-[Outfit] mb-1" style="color: {{ $result['color'] }}">{{ $result['title'] }}</h2>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-4" style="background: {{ $result['color'] }}20; color: {{ $result['color'] }}">
                        Aura {{ ucfirst($result['aura_type']) }}
                    </span>
                    <p class="text-slate-200 leading-relaxed mb-6">{{ $result['description'] }}</p>

                    <x-progress-bar :value="$result['power_level']" label="Power Level" color="cyan" height="h-4" />
                </div>
            </div>

            <div class="text-center mt-6">
                <x-neon-button variant="ghost" size="sm" wire:click="resetResult">🔄 Deteksi Nama Lain</x-neon-button>
            </div>
        </div>
    @endif
</div>
