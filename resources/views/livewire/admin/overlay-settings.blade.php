<div>
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold font-[Outfit] mb-2">Pengaturan Overlay OBS</h1>
        <p class="text-slate-400">Atur tampilan visual untuk popup ramalan yang muncul di live stream Anda via OBS.</p>
    </div>

    {{-- Notification Toast --}}
    <div x-data="{ show: false, message: '', type: 'success' }"
         x-on:notify.window="message = $event.detail.message; type = $event.detail.type; show = true; setTimeout(() => show = false, 3000)"
         class="fixed top-4 right-4 z-50">
        <div x-show="show" style="display: none;"
             x-transition
             :class="type === 'success' ? 'bg-green-500/20 text-green-400 border-green-500/30' : 'bg-red-500/20 text-red-400 border-red-500/30'"
             class="border px-4 py-3 rounded-xl shadow-lg backdrop-blur flex items-center gap-2">
            <span x-text="type === 'success' ? '✅' : '🗑️'"></span>
            <span x-text="message" class="font-medium"></span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Settings Form --}}
        <x-glass-card>
            <h2 class="text-xl font-bold font-[Outfit] mb-6 flex items-center gap-2">
                <span>🎨</span> Visual & Animasi
            </h2>

            <form wire:submit="save" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Tema Warna Utama</label>
                    <div class="flex gap-4">
                        @php
                            $colors = [
                                'blue' => 'bg-blue-500', 
                                'purple' => 'bg-purple-500', 
                                'pink' => 'bg-pink-500', 
                                'cyan' => 'bg-cyan-500',
                                'green' => 'bg-green-500'
                            ];
                        @endphp
                        @foreach($colors as $val => $bgClass)
                            <button type="button" wire:click="$set('themeColor', '{{ $val }}')" 
                                    class="w-10 h-10 rounded-full {{ $bgClass }} transition-transform {{ $themeColor === $val ? 'ring-4 ring-white ring-offset-2 ring-offset-[#0f172a] scale-110' : 'hover:scale-110' }} shadow-lg">
                            </button>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Gaya Animasi Muncul</label>
                    <select wire:model="animationStyle" class="w-full text-sm">
                        <option value="bounce-in">Bouncy (Memantul dari bawah)</option>
                        <option value="slide-up">Slide Up (Geser mulus dari bawah)</option>
                        <option value="fade-in">Fade In (Mulus pudar masuk)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Durasi Tampil (Detik)</label>
                    <input type="range" wire:model.live="displayDuration" min="3" max="30" class="w-full accent-primary-500">
                    <div class="flex justify-between text-xs text-slate-400 mt-1">
                        <span>3s (Cepat)</span>
                        <span class="font-bold text-primary-400 text-sm">{{ $displayDuration }} Detik</span>
                        <span>30s (Lama)</span>
                    </div>
                </div>

                <div class="glass p-4 rounded-xl flex items-center justify-between">
                    <div>
                        <h3 class="font-medium text-slate-200">Efek Confetti</h3>
                        <p class="text-xs text-slate-400 mt-1">Memicu ledakan confetti saat hasil ramalan sangat bagus (Hoki > 80%).</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="showConfetti" class="sr-only peer">
                        <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-500"></div>
                    </label>
                </div>

                <div class="pt-4 border-t border-white/10">
                    <x-neon-button type="submit" variant="primary" class="w-full" :loading="true">
                        <span wire:loading.remove wire:target="save">💾 Simpan Perubahan</span>
                        <span wire:loading wire:target="save">⏳ Menyimpan...</span>
                    </x-neon-button>
                </div>
            </form>
        </x-glass-card>

        {{-- Preview Panel --}}
        <div>
            <x-glass-card class="h-full flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold font-[Outfit] flex items-center gap-2">
                        <span>📺</span> Live Preview Setup
                    </h2>
                    <x-neon-button variant="neon-purple" size="sm" wire:click="triggerTestPopup">
                        ▶️ Test Pop-up
                    </x-neon-button>
                </div>

                <div class="flex-1 bg-black/40 rounded-xl border border-white/10 overflow-hidden relative min-h-[300px] flex items-end justify-center pb-6 bg-[url('https://transparenttextures.com/patterns/cubes.png')]">
                    {{-- Dummy Overlay --}}
                    <div class="w-[90%] p-4 bg-slate-900/80 backdrop-blur-md rounded-2xl border-t-2 {{ $themeColor === 'blue' ? 'border-blue-500' : ($themeColor === 'purple' ? 'border-purple-500' : ($themeColor === 'pink' ? 'border-pink-500' : ($themeColor === 'green' ? 'border-green-500' : 'border-cyan-500'))) }} shadow-[0_0_30px_rgba(59,130,246,0.2)]">
                        <div class="flex gap-3">
                            <div class="text-3xl">🔮</div>
                            <div>
                                <h3 class="font-bold text-white text-sm font-[Outfit]">Contoh Judul Ramalan</h3>
                                <p class="text-xs text-slate-300 mt-1">Ini adalah simulasi tampilan yang akan muncul di layar OBS Anda selama {{ $displayDuration }} detik.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="absolute inset-0 flex items-center justify-center opacity-50 pointer-events-none">
                        <span class="text-2xl font-bold text-white/20 uppercase tracking-widest rotate-[-15deg]">OBS Area</span>
                    </div>
                </div>
                
                <p class="text-xs text-center text-slate-500 mt-4">Copy URL berikut ke Browser Source OBS: <br>
                    <code class="text-blue-400 select-all block mt-1 p-2 bg-black/30 rounded">{{ url('/overlay') }}</code>
                </p>
            </x-glass-card>
        </div>
    </div>
</div>
