<div class="max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-bold font-[Outfit] gradient-text mb-2">🔥 AI Roast Nama</h1>
        <p class="text-slate-400">Roasting lucu dan aman — 100% hiburan!</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-glass-card>
            <form wire:submit="roast" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Nama Target</label>
                    <input type="text" wire:model="name" placeholder="Siapa yang mau di-roast?" class="text-lg">
                    @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-3">Level Pedas 🌶️</label>
                    <div class="flex gap-2">
                        @foreach(['mild' => '🌶️ Mild', 'medium' => '🌶️🌶️ Medium', 'spicy' => '🌶️🌶️🌶️ Spicy'] as $val => $label)
                            <button type="button" wire:click="$set('intensity', '{{ $val }}')"
                                    class="flex-1 px-3 py-2 rounded-xl text-sm font-medium transition-all
                                           {{ $intensity === $val ? 'bg-orange-600 text-white glow-orange' : 'glass text-slate-400 hover:text-white' }}">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <x-neon-button type="submit" variant="danger" size="lg" class="w-full" :loading="true">
                    <span wire:loading.remove wire:target="roast">🔥 Roast!</span>
                    <span wire:loading wire:target="roast">⏳ Memasak roasting...</span>
                </x-neon-button>
            </form>
        </x-glass-card>

        <div>
            @if($result)
                <x-glass-card class="animate-bounce-in glow-orange">
                    <div class="text-center space-y-4">
                        <div class="text-5xl">🔥</div>
                        <h2 class="text-xl font-bold text-orange-400 font-[Outfit]">Roasting untuk {{ $result['name'] }}</h2>
                        <p class="text-lg text-slate-200 leading-relaxed italic">"{{ $result['content'] }}"</p>
                        <p class="text-xs text-slate-500 mt-4">⚠️ Ini hanya hiburan! Tidak ada niat menyinggung.</p>
                        <x-neon-button variant="ghost" size="sm" wire:click="resetResult">🔄 Roast Lagi</x-neon-button>
                    </div>
                </x-glass-card>
            @else
                <x-glass-card class="flex items-center justify-center min-h-[300px]">
                    <div class="text-center text-slate-500">
                        <div class="text-6xl mb-4 animate-float">🔥</div>
                        <p class="text-lg">Hasil roasting akan muncul di sini</p>
                    </div>
                </x-glass-card>
            @endif
        </div>
    </div>
</div>
