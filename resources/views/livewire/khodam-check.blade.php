<div>
    <x-glass-card class="max-w-2xl mx-auto">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-orange-500/20 text-orange-400 mb-4 ring-1 ring-orange-500/50 shadow-[0_0_15px_rgba(249,115,22,0.3)]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold font-[Outfit] text-white mb-2">Cek Khodam</h2>
            <p class="text-slate-400">Cari tahu khodam pendamping apa yang bersemayam dalam dirimu!</p>
        </div>

        @if(!$result)
            <form wire:submit.prevent="checkKhodam" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Nama Lengkap / Panggilan</label>
                    <input type="text" wire:model="name" 
                           class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                           placeholder="Contoh: Budi Susanto" required>
                    @error('name') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <x-neon-button type="submit" color="orange" class="w-full justify-center">
                    <span wire:loading.remove wire:target="checkKhodam">Terawang Khodam</span>
                    <span wire:loading wire:target="checkKhodam" class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Sedang Menerawang...
                    </span>
                </x-neon-button>
            </form>
        @else
            <div class="space-y-6 animate-fade-in text-center">
                <div class="p-8 rounded-2xl bg-gradient-to-br from-orange-500/10 to-red-500/10 border border-orange-500/20 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500/20 to-red-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <div class="relative z-10">
                        <div class="text-8xl mb-6 animate-bounce-in">{{ $result['emoji'] }}</div>
                        <h3 class="text-2xl font-bold text-white mb-2 font-[Outfit]">Khodam: {{ $result['khodam_name'] }}</h3>
                        
                        <div class="w-16 h-1 bg-gradient-to-r from-orange-500 to-red-500 mx-auto my-6 rounded-full"></div>
                        
                        <div class="text-lg text-slate-300 mb-6 leading-relaxed">
                            {{ $result['description'] }}
                        </div>

                        <div class="bg-slate-900/50 rounded-xl p-4 border border-slate-800">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-slate-400">Level Energi Khodam</span>
                                <span class="text-sm font-bold text-orange-400">{{ $result['power_level'] }}%</span>
                            </div>
                            <x-progress-bar :value="$result['power_level']" color="orange" />
                        </div>
                    </div>
                </div>

                <div class="flex justify-center pt-4">
                    <button wire:click="resetCheck" class="text-slate-400 hover:text-white transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Cek Nama Lain
                    </button>
                </div>
            </div>
        @endif
    </x-glass-card>
</div>
