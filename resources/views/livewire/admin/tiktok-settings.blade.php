<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold font-[Outfit]">TikTok Live Auto-Pilot 🤖</h1>
            <p class="text-slate-400">Hubungkan aplikasi ke komentar TikTok Live Anda secara otomatis.</p>
        </div>
        <button wire:click="checkConnectionStatus" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            Cek Status Node.js
        </button>
    </div>

    @if (session()->has('message'))
        <div class="p-4 bg-green-500/10 border border-green-500/20 text-green-400 rounded-xl">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Connection Settings -->
        <x-glass-card>
            <h2 class="text-lg font-bold mb-4 font-[Outfit]">Koneksi TikTok</h2>
            
            <div class="mb-6 p-4 rounded-xl border {{ $isConnected ? 'bg-green-500/10 border-green-500/30' : 'bg-red-500/10 border-red-500/30' }}">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-3 h-3 rounded-full {{ $isConnected ? 'bg-green-500 animate-pulse' : 'bg-red-500' }}"></div>
                    <span class="font-bold {{ $isConnected ? 'text-green-400' : 'text-red-400' }}">
                        {{ $isConnected ? 'Koneksi Aktif (LIVE)' : 'Terputus (OFFLINE)' }}
                    </span>
                </div>
                <p class="text-sm text-slate-300">{{ $statusMessage }}</p>
            </div>

            <form wire:submit.prevent="connectTiktok" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Username TikTok (Tanpa @)</label>
                    <input type="text" wire:model.defer="tiktok_username" class="w-full bg-slate-900/50 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-indigo-500" placeholder="contoh: feryandriansyah">
                    @error('tiktok_username') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center gap-4">
                    @if($isConnected)
                        <button type="button" wire:click="disconnectTiktok" class="flex-1 bg-red-500/20 text-red-400 hover:bg-red-500/30 border border-red-500/30 px-4 py-2.5 rounded-lg font-medium transition-colors">
                            Putus Koneksi
                        </button>
                    @else
                        <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2.5 rounded-lg font-medium transition-colors shadow-lg shadow-indigo-500/25">
                            Hubungkan ke Live
                        </button>
                    @endif
                </div>
            </form>
        </x-glass-card>

        <!-- Automation Settings -->
        <x-glass-card>
            <h2 class="text-lg font-bold mb-4 font-[Outfit]">Pengaturan Auto-Pilot</h2>
            
            <form wire:submit.prevent="saveSettings" class="space-y-4">
                <div class="p-4 bg-slate-900/50 border border-slate-700 rounded-xl">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <div class="flex-shrink-0 mt-1">
                            <input type="checkbox" wire:model.defer="is_auto_mode" class="w-5 h-5 rounded border-slate-600 text-indigo-500 focus:ring-indigo-500 bg-slate-800">
                        </div>
                        <div>
                            <div class="font-medium text-white mb-1">Aktifkan Auto-Pilot (Respon Otomatis)</div>
                            <p class="text-sm text-slate-400">Jika aktif, sistem akan langsung mengeksekusi layanan dan menampilkannya di Overlay saat ada penonton yang mengetikkan perintah di kolom komentar Live.</p>
                        </div>
                    </label>
                </div>

                <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-4">
                    <h3 class="text-sm font-bold text-slate-300 mb-2">Daftar Perintah (Commands) Aktif:</h3>
                    <ul class="text-sm text-slate-400 space-y-2 list-disc list-inside">
                        <li><code class="text-indigo-400 bg-indigo-400/10 px-1 rounded">!ramal [nama]</code> - Fitur Ramalan</li>
                        <li><code class="text-indigo-400 bg-indigo-400/10 px-1 rounded">!khodam [nama]</code> - Fitur Cek Khodam</li>
                        <li><code class="text-indigo-400 bg-indigo-400/10 px-1 rounded">!aura [nama]</code> - Fitur Detektor Aura</li>
                        <li><code class="text-indigo-400 bg-indigo-400/10 px-1 rounded">!roast [nama]</code> - Fitur AI Roast</li>
                    </ul>
                </div>

                <button type="submit" class="w-full bg-slate-800 hover:bg-slate-700 text-white px-4 py-2.5 rounded-lg font-medium transition-colors border border-slate-600">
                    Simpan Pengaturan
                </button>
            </form>
        </x-glass-card>
    </div>
</div>
