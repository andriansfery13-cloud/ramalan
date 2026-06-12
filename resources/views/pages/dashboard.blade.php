<x-layouts.app title="Dashboard">
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold font-[Outfit]">
            Halo, <span class="gradient-text">{{ auth()->user()->name }}</span>! 👋
        </h1>
        <p class="text-slate-400 mt-1">Selamat datang di dashboard Ramalanku</p>
    </div>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <x-stat-card value="{{ \App\Models\Fortune::where('user_id', auth()->id())->count() }}" label="Ramalanku" icon="🔮" color="blue" />
        <x-stat-card value="{{ \App\Models\NameAnalysis::where('user_id', auth()->id())->count() }}" label="Nama Dianalisis" icon="✨" color="purple" />
        <x-stat-card value="{{ \App\Models\NameMatch::where('user_id', auth()->id())->count() }}" label="Kecocokan Dicek" icon="💕" color="pink" />
        <x-stat-card value="{{ \App\Models\NameBattle::where('user_id', auth()->id())->count() }}" label="Battle Dilakukan" icon="⚔️" color="orange" />
    </div>

    {{-- Quick Links --}}
    <h2 class="text-xl font-bold font-[Outfit] mb-4">Fitur Cepat</h2>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        @php
        $quickLinks = [
            ['icon' => '🔮', 'title' => 'Ramalan', 'href' => route('ramalan')],
            ['icon' => '✨', 'title' => 'Arti Nama', 'href' => route('arti-nama')],
            ['icon' => '💕', 'title' => 'Cocok Nama', 'href' => route('cocok-nama')],
            ['icon' => '⚔️', 'title' => 'Battle', 'href' => route('battle-nama')],
            ['icon' => '🌈', 'title' => 'Aura', 'href' => route('aura')],
            ['icon' => '🔥', 'title' => 'Roast', 'href' => route('roast')],
            ['icon' => '👻', 'title' => 'Cek Khodam', 'href' => route('cek-khodam')],
            ['icon' => '🎯', 'title' => 'Spinner', 'href' => route('spinner')],
            ['icon' => '🏆', 'title' => 'Leaderboard', 'href' => route('leaderboard')],
        ];
        @endphp

        @foreach($quickLinks as $link)
            <a href="{{ $link['href'] }}" class="glass rounded-2xl p-5 text-center hover:border-white/10 transition-all duration-300 group hover:-translate-y-1">
                <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">{{ $link['icon'] }}</div>
                <span class="text-sm font-medium">{{ $link['title'] }}</span>
            </a>
        @endforeach
    </div>
</x-layouts.app>
