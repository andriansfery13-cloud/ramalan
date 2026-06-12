<div class="max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-bold font-[Outfit] gradient-text mb-2">💕 Cocok Nama</h1>
        <p class="text-slate-400">Cek kecocokanmu dengan orang lain!</p>
    </div>

    <x-glass-card class="max-w-xl mx-auto">
        <form wire:submit="match" class="space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Nama A</label>
                    <input type="text" wire:model="nameA" placeholder="Nama pertama..." class="text-lg">
                    @error('nameA') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Nama B</label>
                    <input type="text" wire:model="nameB" placeholder="Nama kedua..." class="text-lg">
                    @error('nameB') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>
            <x-neon-button type="submit" variant="neon-pink" size="lg" class="w-full" :loading="true">
                <span wire:loading.remove wire:target="match">💕 Cek Kecocokan</span>
                <span wire:loading wire:target="match">⏳ Menghitung...</span>
            </x-neon-button>
        </form>
    </x-glass-card>

    @if($result)
        <div class="mt-8 space-y-6 animate-slide-up">
            {{-- Overall Score --}}
            <x-glass-card class="text-center glow-pink">
                <div class="text-6xl font-bold gradient-text font-[Outfit] mb-2">{{ $result['overall_score'] }}%</div>
                <p class="text-xl text-pink-400 font-semibold mb-4">{{ $result['name_a'] }} ❤️ {{ $result['name_b'] }}</p>
                <p class="text-slate-300">{{ $result['description'] }}</p>
            </x-glass-card>

            {{-- Individual Scores --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-glass-card>
                    <x-progress-bar :value="$result['friendship_score']" label="💛 Persahabatan" color="gold" />
                </x-glass-card>
                <x-glass-card>
                    <x-progress-bar :value="$result['cooperation_score']" label="🤝 Kerjasama" color="blue" />
                </x-glass-card>
                <x-glass-card>
                    <x-progress-bar :value="$result['entertainment_score']" label="🎭 Hiburan" color="purple" />
                </x-glass-card>
                <x-glass-card>
                    <x-progress-bar :value="$result['romantic_score']" label="💕 Romantis" color="pink" />
                </x-glass-card>
            </div>

            <div class="text-center">
                <x-neon-button variant="ghost" size="sm" wire:click="resetResult">🔄 Cek Nama Lain</x-neon-button>
            </div>
        </div>
    @endif
</div>
