<div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold font-[Outfit] mb-2">Statistik Laporan</h1>
            <p class="text-slate-400">Pantau performa interaksi dan ramalan dari stream TikTok Live Anda.</p>
        </div>

        <div>
            <select wire:model.live="period" class="bg-black/20 border-white/10 rounded-xl px-4 py-2 text-sm focus:ring-primary-500">
                <option value="today">Hari Ini</option>
                <option value="week">7 Hari Terakhir</option>
                <option value="month">30 Hari Terakhir</option>
                <option value="all">Semua Waktu</option>
            </select>
        </div>
    </div>

    {{-- Highlight Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <x-glass-card class="text-center p-6 hover:-translate-y-1 transition-transform">
            <div class="text-3xl mb-2">🔮</div>
            <div class="text-3xl font-black font-[Outfit] text-white">{{ number_format($totalFortunes) }}</div>
            <div class="text-sm text-slate-400 mt-1">Total Ramalan</div>
        </x-glass-card>

        <x-glass-card class="text-center p-6 hover:-translate-y-1 transition-transform">
            <div class="text-3xl mb-2">📺</div>
            <div class="text-3xl font-black font-[Outfit] text-white">{{ number_format($totalViewers) }}</div>
            <div class="text-sm text-slate-400 mt-1">Viewer Unik</div>
        </x-glass-card>

        <x-glass-card class="text-center p-6 hover:-translate-y-1 transition-transform">
            <div class="text-3xl mb-2">💬</div>
            <div class="text-3xl font-black font-[Outfit] text-white">{{ number_format($totalComments) }}</div>
            <div class="text-sm text-slate-400 mt-1">Total Komentar</div>
        </x-glass-card>

        <x-glass-card class="text-center p-6 hover:-translate-y-1 transition-transform">
            <div class="text-3xl mb-2">🎁</div>
            <div class="text-3xl font-black font-[Outfit] text-white">{{ number_format($totalGifts) }}</div>
            <div class="text-sm text-slate-400 mt-1">Total Gift</div>
        </x-glass-card>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Popular Categories --}}
        <x-glass-card>
            <h3 class="text-lg font-bold font-[Outfit] mb-6 flex items-center gap-2">
                <span>📊</span> Kategori Ramalan Terpopuler
            </h3>
            
            <div class="space-y-4">
                @forelse($popularCategories as $index => $cat)
                    @php
                        $percentage = $totalFortunes > 0 ? round(($cat->total / $totalFortunes) * 100) : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-slate-200">
                                {{ $index + 1 }}. {{ ucfirst($cat->category) }}
                            </span>
                            <span class="text-slate-400">{{ number_format($cat->total) }}x ({{ $percentage }}%)</span>
                        </div>
                        <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-400 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-500 py-4">Belum ada data ramalan pada periode ini.</div>
                @endforelse
            </div>
        </x-glass-card>

        {{-- Mode Usage --}}
        <x-glass-card>
            <h3 class="text-lg font-bold font-[Outfit] mb-6 flex items-center gap-2">
                <span>⚙️</span> Penggunaan Mode (Template vs OpenAI)
            </h3>
            
            <div class="space-y-4">
                @forelse($modeUsage as $mode)
                    @php
                        $percentage = $totalFortunes > 0 ? round(($mode->total / $totalFortunes) * 100) : 0;
                        $isAi = $mode->mode === 'openai';
                        $color = $isAi ? 'from-purple-500 to-pink-500' : 'from-blue-500 to-cyan-500';
                        $icon = $isAi ? '🤖' : '📚';
                    @endphp
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-slate-200">
                                {{ $icon }} {{ ucfirst($mode->mode) }} Mode
                            </span>
                            <span class="text-slate-400">{{ number_format($mode->total) }}x ({{ $percentage }}%)</span>
                        </div>
                        <div class="w-full h-3 bg-slate-800 rounded-full overflow-hidden border border-white/5">
                            <div class="h-full bg-gradient-to-r {{ $color }} rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-500 py-4">Belum ada data penggunaan mode.</div>
                @endforelse
            </div>
            
            <div class="mt-8 p-4 rounded-xl bg-purple-500/10 border border-purple-500/20 text-sm text-purple-200 flex gap-3 items-start">
                <span class="text-xl">💡</span>
                <p>Menggunakan <strong>OpenAI Mode</strong> menghasilkan ramalan yang lebih variatif, namun membutuhkan API Key aktif. <strong>Template Mode</strong> lebih ringan dan mengambil secara acak dari 20,000+ data lokal.</p>
            </div>
        </x-glass-card>
    </div>
</div>
