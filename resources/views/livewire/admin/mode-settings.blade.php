<div>
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold font-[Outfit] mb-2">Pengaturan Mode & AI</h1>
        <p class="text-slate-400">Atur mode sumber data untuk setiap fitur (Template Lokal vs OpenAI)</p>
    </div>

    {{-- Notification Toast --}}
    <div x-data="{ show: false, message: '' }"
         x-on:settings-saved.window="message = 'Berhasil menyimpan ' + $event.detail.section; show = true; setTimeout(() => show = false, 3000)"
         class="fixed top-4 right-4 z-50">
        <div x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-2"
             class="bg-green-500/20 text-green-400 border border-green-500/30 px-4 py-3 rounded-xl shadow-lg backdrop-blur flex items-center gap-2">
            <span>✅</span>
            <span x-text="message" class="font-medium"></span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Mode Toggles --}}
        <x-glass-card>
            <h2 class="text-xl font-bold font-[Outfit] mb-6 flex items-center gap-2">
                <span>🔄</span> Mode Fitur
            </h2>

            <form wire:submit="saveModes" class="space-y-6">
                @php
                $features = [
                    ['key' => 'fortuneMode', 'label' => 'Ramalan Utama', 'icon' => '🔮', 'desc' => 'Mode untuk fitur ramalan umum, cinta, dll.'],
                    ['key' => 'nameAnalysisMode', 'label' => 'Arti Nama', 'icon' => '✨', 'desc' => 'Mode untuk analisis huruf dan karakter.'],
                    ['key' => 'roastMode', 'label' => 'AI Roast', 'icon' => '🔥', 'desc' => 'Mode untuk roasting nama.'],
                    ['key' => 'auraMode', 'label' => 'Detektor Aura', 'icon' => '🌈', 'desc' => 'Mode untuk pendeteksi aura.'],
                ];
                @endphp

                @foreach($features as $feature)
                    <div class="glass p-4 rounded-xl">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="font-semibold text-slate-200 flex items-center gap-2">
                                    <span>{{ $feature['icon'] }}</span> {{ $feature['label'] }}
                                </h3>
                                <p class="text-xs text-slate-400 mt-1">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                        <div class="flex rounded-lg overflow-hidden border border-white/10 p-1 bg-white/5">
                            <button type="button"
                                    wire:click="$set('{{ $feature['key'] }}', 'template')"
                                    class="flex-1 py-2 text-sm font-medium rounded-md transition-all {{ $this->{$feature['key']} === 'template' ? 'bg-primary-600 text-white shadow' : 'text-slate-400 hover:text-slate-200' }}">
                                📚 Template
                            </button>
                            <button type="button"
                                    wire:click="$set('{{ $feature['key'] }}', 'openai')"
                                    class="flex-1 py-2 text-sm font-medium rounded-md transition-all {{ $this->{$feature['key']} === 'openai' ? 'bg-purple-600 text-white shadow' : 'text-slate-400 hover:text-slate-200' }}">
                                🤖 OpenAI
                            </button>
                        </div>
                    </div>
                @endforeach

                <div class="pt-4 border-t border-white/10">
                    <x-neon-button type="submit" variant="primary" class="w-full" :loading="true">
                        <span wire:loading.remove wire:target="saveModes">💾 Simpan Mode</span>
                        <span wire:loading wire:target="saveModes">⏳ Menyimpan...</span>
                    </x-neon-button>
                </div>
            </form>
        </x-glass-card>

        {{-- OpenAI Config --}}
        <x-glass-card>
            <h2 class="text-xl font-bold font-[Outfit] mb-6 flex items-center gap-2 text-purple-400">
                <span>🤖</span> Konfigurasi OpenAI
            </h2>

            <form wire:submit="saveOpenAIConfig" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">API Key OpenAI</label>
                    <input type="password" wire:model="openaiApiKey"
                           placeholder="sk-..."
                           class="w-full text-sm font-mono border-purple-500/30 focus:border-purple-500 focus:ring-purple-500/20">
                    <p class="text-xs text-slate-500 mt-1">Kosongkan jika menggunakan konfigurasi .env</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Model</label>
                    <select wire:model="openaiModel" class="w-full border-purple-500/30 focus:border-purple-500 focus:ring-purple-500/20">
                        <option value="gpt-4o-mini">GPT-4o-Mini (Rekomendasi - Cepat & Murah)</option>
                        <option value="gpt-4o">GPT-4o</option>
                        <option value="gpt-3.5-turbo">GPT-3.5 Turbo</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Prompt Dasar Ramalan</label>
                    <textarea wire:model="openaiFortunePrompt" rows="5"
                              class="w-full text-sm border-purple-500/30 focus:border-purple-500 focus:ring-purple-500/20"></textarea>
                    <p class="text-xs text-slate-500 mt-1">Prompt sistem untuk mengontrol gaya dan batasan ramalan AI.</p>
                </div>

                <div class="pt-4 border-t border-white/10">
                    <x-neon-button type="submit" variant="neon-purple" class="w-full" :loading="true">
                        <span wire:loading.remove wire:target="saveOpenAIConfig">💾 Simpan Konfigurasi</span>
                        <span wire:loading wire:target="saveOpenAIConfig">⏳ Menyimpan...</span>
                    </x-neon-button>
                </div>
            </form>
        </x-glass-card>
    </div>
</div>
