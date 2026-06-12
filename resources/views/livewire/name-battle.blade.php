<div class="max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-bold font-[Outfit] gradient-text mb-2">⚔️ Battle Nama</h1>
        <p class="text-slate-400">Siapa yang lebih kuat? Adu dua nama!</p>
    </div>

    @if(!$result)
        <x-glass-card class="max-w-xl mx-auto">
            <form wire:submit="battle" class="space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-red-400 mb-2">🔴 Fighter A</label>
                        <input type="text" wire:model="nameA" placeholder="Nama fighter A..." class="text-lg border-red-500/20">
                        @error('nameA') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-400 mb-2">🔵 Fighter B</label>
                        <input type="text" wire:model="nameB" placeholder="Nama fighter B..." class="text-lg border-blue-500/20">
                        @error('nameB') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                    </div>
                </div>
                <x-neon-button type="submit" variant="danger" size="lg" class="w-full" :loading="true">
                    <span wire:loading.remove wire:target="battle">⚔️ FIGHT!</span>
                    <span wire:loading wire:target="battle">⏳ Pertarungan dimulai...</span>
                </x-neon-button>
            </form>
        </x-glass-card>
    @else
        <div class="animate-bounce-in">
            {{-- VS Battle Display --}}
            <div class="vs-container max-w-3xl mx-auto mb-8">
                {{-- Fighter A --}}
                <x-glass-card class="text-center {{ $result['score_a'] >= $result['score_b'] ? 'glow-green border-green-500/30' : '' }}">
                    <div class="text-4xl mb-2">🔴</div>
                    <h3 class="text-xl font-bold text-red-400 font-[Outfit]">{{ $result['name_a'] }}</h3>
                    <div class="text-5xl font-black mt-3 {{ $result['score_a'] >= $result['score_b'] ? 'text-green-400' : 'text-slate-400' }}">
                        {{ $result['score_a'] }}
                    </div>
                    @if($result['winner'] === $result['name_a'])
                        <div class="mt-2 text-sm text-green-400 font-bold">👑 WINNER!</div>
                    @endif
                </x-glass-card>

                {{-- VS Badge --}}
                <div class="vs-badge text-center animate-vs-battle">
                    ⚔️<br>VS
                </div>

                {{-- Fighter B --}}
                <x-glass-card class="text-center {{ $result['score_b'] > $result['score_a'] ? 'glow-green border-green-500/30' : '' }}">
                    <div class="text-4xl mb-2">🔵</div>
                    <h3 class="text-xl font-bold text-blue-400 font-[Outfit]">{{ $result['name_b'] }}</h3>
                    <div class="text-5xl font-black mt-3 {{ $result['score_b'] > $result['score_a'] ? 'text-green-400' : 'text-slate-400' }}">
                        {{ $result['score_b'] }}
                    </div>
                    @if($result['winner'] === $result['name_b'])
                        <div class="mt-2 text-sm text-green-400 font-bold">👑 WINNER!</div>
                    @endif
                </x-glass-card>
            </div>

            {{-- Description --}}
            <x-glass-card class="max-w-2xl mx-auto text-center">
                <p class="text-lg text-slate-200">{{ $result['description'] }}</p>
            </x-glass-card>

            <div class="text-center mt-6">
                <x-neon-button variant="ghost" size="sm" wire:click="resetResult">🔄 Battle Lagi</x-neon-button>
            </div>
        </div>
    @endif
</div>
