<div class="max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-bold font-[Outfit] gradient-text mb-2">🏆 Leaderboard Live</h1>
        <p class="text-slate-400">Siapa yang paling hoki hari ini?</p>
    </div>

    {{-- Type Tabs --}}
    <div class="flex flex-wrap justify-center gap-2 mb-8">
        @foreach($types as $key => $type)
            <button wire:click="setType('{{ $key }}')"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200
                           {{ $activeType === $key ? 'gradient-primary text-white glow-blue' : 'glass text-slate-400 hover:text-white' }}">
                {{ $type['icon'] }} {{ $type['label'] }}
            </button>
        @endforeach
    </div>

    {{-- Leaderboard --}}
    <x-glass-card>
        @if($entries->count() > 0)
            <div class="space-y-2">
                @foreach($entries as $i => $entry)
                    <div class="flex items-center gap-4 p-3 rounded-xl leaderboard-row
                                {{ $i === 0 ? 'leaderboard-rank-1' : ($i === 1 ? 'leaderboard-rank-2' : ($i === 2 ? 'leaderboard-rank-3' : '')) }}">
                        <div class="w-10 text-center">
                            @if($i === 0) <span class="text-2xl">🥇</span>
                            @elseif($i === 1) <span class="text-2xl">🥈</span>
                            @elseif($i === 2) <span class="text-2xl">🥉</span>
                            @else <span class="text-lg text-slate-500 font-bold">#{{ $i + 1 }}</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <span class="font-semibold {{ $i < 3 ? $types[$activeType]['color'] : 'text-slate-200' }}">
                                {{ $entry->viewer_name }}
                            </span>
                        </div>
                        <div class="text-right">
                            <span class="text-lg font-bold {{ $types[$activeType]['color'] }}">{{ number_format($entry->score) }}</span>
                            <span class="text-xs text-slate-500 ml-1">pts</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 text-slate-500">
                <div class="text-5xl mb-4">🏆</div>
                <p class="text-lg">Belum ada data leaderboard</p>
                <p class="text-sm mt-1">Mulai ramal untuk mengisi leaderboard!</p>
            </div>
        @endif
    </x-glass-card>
</div>
