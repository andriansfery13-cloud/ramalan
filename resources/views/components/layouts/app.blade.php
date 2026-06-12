<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $metaDescription ?? 'Ramalanku - Ramalan Seru, Interaktif, dan Menghibur untuk Live TikTok' }}">

    <title>{{ $title ?? 'Ramalanku' }} - AI Ramalan Nama Live</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-surface-900 text-slate-200 antialiased" x-data="{ mobileMenu: false }">

    {{-- Background Effects --}}
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute top-1/3 -left-40 w-96 h-96 bg-neon-purple/8 rounded-full blur-[150px]"></div>
        <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-neon-cyan/6 rounded-full blur-[100px]"></div>
    </div>

    {{-- Navigation --}}
    <nav class="fixed top-0 left-0 right-0 z-50 glass border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                {{-- Logo --}}
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-9 h-9 rounded-xl gradient-primary flex items-center justify-center glow-blue transition-transform group-hover:scale-110">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9-9-9z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold font-[Outfit] gradient-text hidden sm:block">Ramalanku</span>
                    </a>
                </div>

                {{-- Desktop Nav --}}
                <div class="hidden lg:flex items-center gap-1">
                    <x-nav-link href="{{ route('ramalan') }}" :active="request()->routeIs('ramalan')">
                        🔮 Ramalan
                    </x-nav-link>
                    <x-nav-link href="{{ route('arti-nama') }}" :active="request()->routeIs('arti-nama')">
                        ✨ Arti Nama
                    </x-nav-link>
                    <x-nav-link href="{{ route('cocok-nama') }}" :active="request()->routeIs('cocok-nama')">
                        💕 Cocok Nama
                    </x-nav-link>
                    <x-nav-link href="{{ route('battle-nama') }}" :active="request()->routeIs('battle-nama')">
                        ⚔️ Battle
                    </x-nav-link>
                    <x-nav-link href="{{ route('aura') }}" :active="request()->routeIs('aura')">
                        🌈 Aura
                    </x-nav-link>
                    <x-nav-link href="{{ route('roast') }}" :active="request()->routeIs('roast')">
                        🔥 Roast
                    </x-nav-link>
                    <x-nav-link href="{{ route('spinner') }}" :active="request()->routeIs('spinner')">
                        🎯 Spinner
                    </x-nav-link>
                    <x-nav-link href="{{ route('leaderboard') }}" :active="request()->routeIs('leaderboard')">
                        🏆 Leaderboard
                    </x-nav-link>
                </div>

                {{-- Right Side --}}
                <div class="flex items-center gap-3">
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm text-primary-400 hover:bg-primary-600/10 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Admin
                            </a>
                        @endif
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 px-3 py-1.5 rounded-lg glass hover:bg-white/5 transition-colors">
                                <div class="w-7 h-7 rounded-full gradient-primary flex items-center justify-center text-xs font-bold text-white">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="hidden sm:block text-sm">{{ auth()->user()->name }}</span>
                            </button>
                            <div x-show="open" @click.outside="open = false" x-transition
                                 class="absolute right-0 mt-2 w-48 glass rounded-xl overflow-hidden shadow-xl shadow-black/20">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 text-sm hover:bg-white/5 transition-colors">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2.5 text-sm hover:bg-white/5 text-red-400 transition-colors">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm text-slate-300 hover:text-white transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm rounded-xl gradient-primary text-white font-medium glow-blue hover:opacity-90 transition-opacity">Daftar</a>
                    @endauth

                    {{-- Mobile Menu Toggle --}}
                    <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 rounded-lg hover:bg-white/5 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenu" x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-1 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-1 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden glass-strong border-t border-white/5 pb-4">
            <div class="grid grid-cols-2 gap-1 px-4 pt-3">
                <x-mobile-nav-link href="{{ route('ramalan') }}" icon="🔮">Ramalan</x-mobile-nav-link>
                <x-mobile-nav-link href="{{ route('arti-nama') }}" icon="✨">Arti Nama</x-mobile-nav-link>
                <x-mobile-nav-link href="{{ route('cocok-nama') }}" icon="💕">Cocok Nama</x-mobile-nav-link>
                <x-mobile-nav-link href="{{ route('battle-nama') }}" icon="⚔️">Battle</x-mobile-nav-link>
                <x-mobile-nav-link href="{{ route('aura') }}" icon="🌈">Aura</x-mobile-nav-link>
                <x-mobile-nav-link href="{{ route('roast') }}" icon="🔥">Roast</x-mobile-nav-link>
                <x-mobile-nav-link href="{{ route('spinner') }}" icon="🎯">Spinner</x-mobile-nav-link>
                <x-mobile-nav-link href="{{ route('leaderboard') }}" icon="🏆">Leaderboard</x-mobile-nav-link>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="relative z-10 pt-20 pb-8 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl glass border border-green-500/20 text-green-400 animate-slide-down" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl glass border border-red-500/20 text-red-400 animate-slide-down" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            {{ $slot }}
        </div>
    </main>

    {{-- Footer --}}
    <footer class="relative z-10 border-t border-white/5 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg gradient-primary flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9-9-9z"/>
                        </svg>
                    </div>
                    <span class="text-sm text-slate-400">Ramalanku &copy; {{ date('Y') }} — Hiburan Semata</span>
                </div>
                <p class="text-xs text-slate-500">⚠️ Semua ramalan bersifat hiburan. Tidak mengklaim kebenaran masa depan.</p>
            </div>
        </div>
    </footer>

    @livewireScripts
    @stack('scripts')
</body>
</html>
