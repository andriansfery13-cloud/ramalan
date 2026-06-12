<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin' }} - Ramalanku Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-surface-900 text-slate-200 antialiased" x-data="{ sidebarOpen: false }">

    {{-- Background --}}
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-600/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 -left-40 w-96 h-96 bg-neon-purple/5 rounded-full blur-[150px]"></div>
    </div>

    {{-- Sidebar --}}
    <aside class="fixed top-0 left-0 z-40 h-screen w-64 glass-strong border-r border-white/5 transition-transform lg:translate-x-0"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           @click.outside="sidebarOpen = false">
        <div class="flex flex-col h-full">
            {{-- Logo --}}
            <div class="flex items-center gap-3 p-5 border-b border-white/5">
                <div class="w-9 h-9 rounded-xl gradient-primary flex items-center justify-center glow-blue">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9-9-9z"/>
                    </svg>
                </div>
                <div>
                    <span class="text-lg font-bold font-[Outfit] gradient-text">Ramalanku</span>
                    <p class="text-xs text-slate-500">Admin Panel</p>
                </div>
            </div>

            {{-- Menu --}}
            <nav class="flex-1 overflow-y-auto p-4 space-y-1">
                <p class="text-xs uppercase tracking-wider text-slate-500 mb-2 px-3">Menu Utama</p>
                <x-admin-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')" icon="chart">Dashboard</x-admin-nav-link>

                <p class="text-xs uppercase tracking-wider text-slate-500 mb-2 mt-5 px-3">Master Data</p>
                <x-admin-nav-link href="{{ route('admin.templates') }}" :active="request()->routeIs('admin.templates*')" icon="document">Template Ramalan</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.categories') }}" :active="request()->routeIs('admin.categories*')" icon="tag">Kategori</x-admin-nav-link>

                <p class="text-xs uppercase tracking-wider text-slate-500 mb-2 mt-5 px-3">Integrasi</p>
                <x-admin-nav-link href="{{ route('admin.openai') }}" :active="request()->routeIs('admin.openai')" icon="cpu">OpenAI</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.tiktok') }}" :active="request()->routeIs('admin.tiktok')" icon="chat">TikTok Live</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.mode') }}" :active="request()->routeIs('admin.mode')" icon="switch">Mode Switch</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.overlay') }}" :active="request()->routeIs('admin.overlay')" icon="eye">Overlay</x-admin-nav-link>

                <p class="text-xs uppercase tracking-wider text-slate-500 mb-2 mt-5 px-3">Sistem</p>
                <x-admin-nav-link href="{{ route('admin.statistics') }}" :active="request()->routeIs('admin.statistics')" icon="stats">Statistik</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users*')" icon="users">User Management</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.settings') }}" :active="request()->routeIs('admin.settings')" icon="settings">Pengaturan</x-admin-nav-link>
            </nav>

            {{-- Bottom --}}
            <div class="p-4 border-t border-white/5">
                <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 text-sm text-slate-400 hover:text-white rounded-lg hover:bg-white/5 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Aplikasi
                </a>
            </div>
        </div>
    </aside>

    {{-- Main Area --}}
    <div class="lg:ml-64 relative z-10">
        {{-- Top Bar --}}
        <header class="sticky top-0 z-30 glass border-b border-white/5">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-white/5 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="text-lg font-semibold font-[Outfit]">{{ $title ?? 'Dashboard' }}</h1>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-slate-400">{{ auth()->user()->name }}</span>
                    <div class="w-8 h-8 rounded-full gradient-primary flex items-center justify-center text-xs font-bold text-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main class="p-4 sm:p-6 lg:p-8 min-h-[calc(100vh-4rem)]">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl glass border border-green-500/20 text-green-400 animate-slide-down">
                    {{ session('success') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

    {{-- Sidebar Overlay --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-30 bg-black/50 lg:hidden" x-transition.opacity></div>

    @livewireScripts
    @stack('scripts')
</body>
</html>
