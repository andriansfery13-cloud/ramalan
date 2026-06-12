<div class="max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-bold font-[Outfit] gradient-text mb-2">✨ Arti Nama</h1>
        <p class="text-slate-400">Temukan makna tersembunyi di balik namamu!</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-glass-card>
            <form wire:submit="analyze" class="space-y-5">
                <div>
                    <label for="name-input" class="block text-sm font-medium text-slate-300 mb-2">Nama</label>
                    <input type="text" id="name-input" wire:model="name" placeholder="Masukkan nama..." class="text-lg">
                    @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>
                <x-neon-button type="submit" variant="neon-purple" size="lg" class="w-full" :loading="true">
                    <span wire:loading.remove wire:target="analyze">✨ Analisis Nama</span>
                    <span wire:loading wire:target="analyze">⏳ Menganalisis...</span>
                </x-neon-button>
            </form>
        </x-glass-card>

        <div>
            @if($result)
                <div class="space-y-4 animate-slide-up">
                    {{-- Letter Analysis --}}
                    <x-glass-card class="glow-purple">
                        <h3 class="text-lg font-bold text-purple-400 mb-4 font-[Outfit]">Analisis Huruf: {{ strtoupper($result['name']) }}</h3>
                        <div class="space-y-3">
                            @foreach($result['letters'] as $i => $letter)
                                <div class="flex items-center gap-3 animate-slide-up" style="animation-delay: {{ $i * 0.1 }}s">
                                    <div class="w-10 h-10 rounded-xl gradient-primary flex items-center justify-center text-lg font-bold text-white flex-shrink-0">
                                        {{ $letter['letter'] }}
                                    </div>
                                    <div>
                                        <span class="font-semibold text-primary-400">{{ $letter['meaning'] }}</span>
                                        <p class="text-sm text-slate-400">{{ $letter['trait'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </x-glass-card>

                    {{-- Summary --}}
                    <x-glass-card>
                        <div class="space-y-3">
                            <div>
                                <span class="text-xs uppercase tracking-wider text-slate-500">Karakter Dominan</span>
                                <p class="text-lg font-bold text-primary-400">{{ $result['dominant_character'] }}</p>
                            </div>
                            <div>
                                <span class="text-xs uppercase tracking-wider text-slate-500">Kepribadian</span>
                                <p class="text-slate-200">{{ $result['personality'] }}</p>
                            </div>
                            <div>
                                <span class="text-xs uppercase tracking-wider text-slate-500">Kekuatan</span>
                                <p class="text-slate-200">{{ $result['strength'] }}</p>
                            </div>
                            <div>
                                <span class="text-xs uppercase tracking-wider text-slate-500">Potensi</span>
                                <p class="text-slate-200">{{ $result['potential'] }}</p>
                            </div>
                        </div>
                    </x-glass-card>

                    <div class="text-center">
                        <x-neon-button variant="ghost" size="sm" wire:click="resetResult">🔄 Analisis Nama Lain</x-neon-button>
                    </div>
                </div>
            @else
                <x-glass-card class="flex items-center justify-center min-h-[300px]">
                    <div class="text-center text-slate-500">
                        <div class="text-6xl mb-4 animate-float">✨</div>
                        <p class="text-lg">Hasil analisis akan muncul di sini</p>
                    </div>
                </x-glass-card>
            @endif
        </div>
    </div>
</div>
