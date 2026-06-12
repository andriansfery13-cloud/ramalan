<x-layouts.app title="Beranda">
    {{-- Hero Section --}}
    <div class="relative py-12 md:py-20 text-center">
        <div class="max-w-3xl mx-auto">
            <div class="text-6xl md:text-7xl mb-6 animate-float">🔮</div>
            <h1 class="text-4xl md:text-6xl font-black font-[Outfit] mb-4">
                <span class="gradient-text">Ramalanku</span>
            </h1>
            <p class="text-xl md:text-2xl text-primary-400 font-semibold mb-3 font-[Outfit]">AI Ramalan Nama Live</p>
            <p class="text-lg text-slate-400 mb-8 max-w-xl mx-auto">Ramalan Seru, Interaktif, dan Menghibur untuk Live TikTok. Powered by AI dan 20,000+ template unik!</p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('ramalan') }}" class="px-8 py-4 rounded-2xl gradient-primary text-white font-bold text-lg glow-blue hover:opacity-90 transition-all active:scale-95 inline-flex items-center justify-center gap-2">
                    🔮 Mulai Ramal
                </a>
                @guest
                    <a href="{{ route('register') }}" class="px-8 py-4 rounded-2xl glass text-slate-200 font-bold text-lg hover:bg-white/10 transition-all inline-flex items-center justify-center gap-2">
                        ✨ Daftar Gratis
                    </a>
                @endguest
            </div>
        </div>
    </div>

    {{-- Features Grid --}}
    <div class="py-12">
        <h2 class="text-2xl md:text-3xl font-bold text-center mb-10 font-[Outfit]">
            <span class="gradient-text">Fitur Lengkap</span> untuk Live TikTok
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @php
            $features = [
                ['icon' => '🔮', 'title' => 'Ramalan Nama', 'desc' => '5 kategori ramalan dari AI dan 20K+ template', 'href' => route('ramalan'), 'color' => 'from-blue-600/20 to-blue-400/5'],
                ['icon' => '✨', 'title' => 'Arti Nama', 'desc' => 'Analisis karakter huruf per huruf', 'href' => route('arti-nama'), 'color' => 'from-purple-600/20 to-purple-400/5'],
                ['icon' => '💕', 'title' => 'Cocok Nama', 'desc' => 'Cek kecocokan dua nama dengan visual', 'href' => route('cocok-nama'), 'color' => 'from-pink-600/20 to-pink-400/5'],
                ['icon' => '⚔️', 'title' => 'Battle Nama', 'desc' => 'Adu skor dua nama dengan animasi VS', 'href' => route('battle-nama'), 'color' => 'from-red-600/20 to-red-400/5'],
                ['icon' => '🌈', 'title' => 'Detektor Aura', 'desc' => '7 tipe aura dengan kartu visual', 'href' => route('aura'), 'color' => 'from-cyan-600/20 to-cyan-400/5'],
                ['icon' => '🔥', 'title' => 'AI Roast', 'desc' => 'Roasting lucu dan aman untuk hiburan', 'href' => route('roast'), 'color' => 'from-orange-600/20 to-orange-400/5'],
                ['icon' => '👻', 'title' => 'Cek Khodam', 'desc' => 'Khodam hewan dan hantu kocak', 'href' => route('cek-khodam'), 'color' => 'from-indigo-600/20 to-indigo-400/5'],
                ['icon' => '🎯', 'title' => 'Spinner Nama', 'desc' => 'Wheel of Fortune untuk pilih pemenang', 'href' => route('spinner'), 'color' => 'from-green-600/20 to-green-400/5'],
                ['icon' => '🏆', 'title' => 'Leaderboard', 'desc' => 'Ranking viewer paling hoki', 'href' => route('leaderboard'), 'color' => 'from-yellow-600/20 to-yellow-400/5'],
            ];
            @endphp

            @foreach($features as $f)
                <a href="{{ $f['href'] }}" class="glass rounded-2xl p-6 hover:border-white/10 transition-all duration-300 group hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $f['color'] }} flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                        {{ $f['icon'] }}
                    </div>
                    <h3 class="text-lg font-bold mb-1 font-[Outfit] text-white">{{ $f['title'] }}</h3>
                    <p class="text-sm text-slate-400">{{ $f['desc'] }}</p>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Stats --}}
    <div class="py-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <x-stat-card value="{{ \App\Models\FortuneTemplate::count() }}" label="Template Ramalan" icon="📚" color="blue" />
            <x-stat-card value="{{ \App\Models\Fortune::count() }}" label="Ramalan Dibuat" icon="🔮" color="purple" />
            <x-stat-card value="{{ \App\Models\Category::count() }}" label="Kategori" icon="📂" color="cyan" />
            <x-stat-card value="{{ \App\Models\User::count() }}" label="Pengguna" icon="👥" color="green" />
        </div>
    </div>

    {{-- Disclaimer --}}
    <div class="py-8 text-center">
        <x-glass-card class="max-w-2xl mx-auto" :hover="false">
            <p class="text-sm text-slate-400">
                ⚠️ <strong>Disclaimer:</strong> Semua ramalan dalam aplikasi ini bersifat <strong>hiburan semata</strong>.
                Tidak mengklaim kebenaran masa depan, tidak mengandung unsur mistik, dan tidak dimaksudkan sebagai panduan hidup.
                Nikmati dan bersenang-senang! 🎉
            </p>
        </x-glass-card>
    </div>
</x-layouts.app>
