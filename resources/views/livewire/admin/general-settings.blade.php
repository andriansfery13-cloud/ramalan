<div>
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold font-[Outfit] mb-2">Pengaturan Umum</h1>
        <p class="text-slate-400">Atur parameter global aplikasi dan konfigurasi integrasi konektor TikTok.</p>
    </div>

    {{-- Notification Toast --}}
    <div x-data="{ show: false, message: '', type: 'success' }"
         x-on:notify.window="message = $event.detail.message; type = $event.detail.type; show = true; setTimeout(() => show = false, 3000)"
         class="fixed top-4 right-4 z-50">
        <div x-show="show" style="display: none;"
             x-transition
             :class="type === 'success' ? 'bg-green-500/20 text-green-400 border-green-500/30' : 'bg-red-500/20 text-red-400 border-red-500/30'"
             class="border px-4 py-3 rounded-xl shadow-lg backdrop-blur flex items-center gap-2">
            <span x-text="type === 'success' ? '✅' : '⚠️'"></span>
            <span x-text="message" class="font-medium"></span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- System Setup --}}
        <x-glass-card>
            <h2 class="text-xl font-bold font-[Outfit] mb-6 flex items-center gap-2">
                <span>⚙️</span> Pengaturan Sistem
            </h2>

            <form wire:submit="saveSystemSettings" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Nama Aplikasi</label>
                    <input type="text" wire:model="appName" class="w-full text-sm">
                    @error('appName') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Tagline (Deskripsi Singkat)</label>
                    <textarea wire:model="appTagline" rows="3" class="w-full text-sm"></textarea>
                    @error('appTagline') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4 border-t border-white/10">
                    <x-neon-button type="submit" variant="primary" class="w-full" :loading="true">
                        <span wire:loading.remove wire:target="saveSystemSettings">💾 Simpan Info Sistem</span>
                        <span wire:loading wire:target="saveSystemSettings">⏳ Menyimpan...</span>
                    </x-neon-button>
                </div>
            </form>
        </x-glass-card>

        {{-- TikTok Integration --}}
        <x-glass-card>
            <h2 class="text-xl font-bold font-[Outfit] mb-6 flex items-center gap-2 text-primary-400">
                <span>🎵</span> Integrasi TikTok Live
            </h2>

            <form wire:submit="saveTiktokSettings" class="space-y-5">
                <div class="glass p-4 rounded-xl mb-4 border border-white/5 flex items-start justify-between">
                    <div>
                        <h3 class="font-medium text-slate-200">TikTok Auto Mode</h3>
                        <p class="text-xs text-slate-400 mt-1">Jika aktif, sistem akan otomatis membaca komentar TikTok yang mengandung <strong>Keyword Trigger</strong> dan langsung menampilkan ramalan ke layar overlay OBS.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer mt-1 ml-4">
                        <input type="checkbox" wire:model="tiktokAutoMode" class="sr-only peer">
                        <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-500"></div>
                    </label>
                </div>

                <div class="{{ $tiktokAutoMode ? '' : 'opacity-50 pointer-events-none transition-opacity' }}">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Keyword Trigger Komentar</label>
                        <input type="text" wire:model="tiktokTriggerKeyword" class="w-full text-sm border-primary-500/30 focus:border-primary-500 focus:ring-primary-500/20">
                        <p class="text-xs text-slate-500 mt-1">Contoh: <code>ramal aku</code> atau <code>cek aura</code></p>
                        @error('tiktokTriggerKeyword') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-300 mb-2">Template Balasan Default Gift</label>
                        <textarea wire:model="tiktokGiftResponse" rows="2" class="w-full text-sm border-primary-500/30 focus:border-primary-500 focus:ring-primary-500/20"></textarea>
                        <p class="text-xs text-slate-500 mt-1">Gunakan <code>{user}</code> untuk me-replace nama pengirim gift.</p>
                        @error('tiktokGiftResponse') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="pt-4 border-t border-white/10">
                    <x-neon-button type="submit" variant="neon-primary" class="w-full" :loading="true">
                        <span wire:loading.remove wire:target="saveTiktokSettings">💾 Simpan Konfigurasi TikTok</span>
                        <span wire:loading wire:target="saveTiktokSettings">⏳ Menyimpan...</span>
                    </x-neon-button>
                </div>
            </form>
        </x-glass-card>
    </div>
</div>
