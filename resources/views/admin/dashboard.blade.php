<x-layouts.admin :title="$title ?? 'Dashboard'">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <x-stat-card value="{{ \App\Models\Fortune::count() }}" label="Total Ramalan" icon="🔮" color="blue" />
        <x-stat-card value="{{ \App\Models\FortuneTemplate::count() }}" label="Template" icon="📚" color="purple" />
        <x-stat-card value="{{ \App\Models\User::count() }}" label="Pengguna" icon="👥" color="green" />
        <x-stat-card value="{{ \App\Models\Viewer::count() }}" label="Viewer" icon="📺" color="cyan" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Fortunes --}}
        <x-glass-card>
            <h3 class="text-lg font-bold font-[Outfit] mb-4">Ramalan Terbaru</h3>
            <div class="space-y-3">
                @forelse(\App\Models\Fortune::latest()->take(5)->get() as $fortune)
                    <div class="flex items-center gap-3 p-3 glass rounded-xl">
                        <span class="text-xl">{{ $fortune->emoji }}</span>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-sm truncate">{{ $fortune->name }}</p>
                            <p class="text-xs text-slate-400">{{ $fortune->category }} · {{ $fortune->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full {{ $fortune->mode === 'openai' ? 'bg-purple-600/20 text-purple-400' : 'bg-blue-600/20 text-blue-400' }}">
                            {{ $fortune->mode }}
                        </span>
                    </div>
                @empty
                    <p class="text-center text-slate-500 py-4">Belum ada ramalan</p>
                @endforelse
            </div>
        </x-glass-card>

        {{-- Mode & Settings --}}
        <x-glass-card>
            <h3 class="text-lg font-bold font-[Outfit] mb-4">Status Mode</h3>
            <div class="space-y-3">
                @php
                $modes = [
                    ['key' => 'fortune_mode', 'label' => 'Ramalan', 'icon' => '🔮'],
                    ['key' => 'name_analysis_mode', 'label' => 'Arti Nama', 'icon' => '✨'],
                    ['key' => 'roast_mode', 'label' => 'Roast', 'icon' => '🔥'],
                    ['key' => 'aura_mode', 'label' => 'Aura', 'icon' => '🌈'],
                ];
                @endphp

                @foreach($modes as $mode)
                    @php $value = \App\Models\AppSetting::getValue($mode['key'], 'template'); @endphp
                    <div class="flex items-center justify-between p-3 glass rounded-xl">
                        <span class="text-sm">{{ $mode['icon'] }} {{ $mode['label'] }}</span>
                        <span class="text-xs px-2 py-1 rounded-full {{ $value === 'openai' ? 'bg-purple-600/20 text-purple-400' : 'bg-blue-600/20 text-blue-400' }}">
                            {{ ucfirst($value) }}
                        </span>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.mode') }}" class="block mt-4 text-center text-sm text-primary-400 hover:text-primary-300">
                Ubah Mode →
            </a>
        </x-glass-card>
    </div>
</x-layouts.admin>
