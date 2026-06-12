<x-layouts.app title="Login">
    <div class="min-h-[70vh] flex items-center justify-center">
        <x-glass-card class="w-full max-w-md animate-slide-up">
            <div class="text-center mb-8">
                <div class="text-4xl mb-3">🔮</div>
                <h1 class="text-2xl font-bold font-[Outfit] gradient-text">Masuk ke Ramalanku</h1>
                <p class="text-sm text-slate-400 mt-1">Selamat datang kembali!</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
                    @error('email') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                    @error('password') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-slate-400">
                        <input type="checkbox" name="remember" class="rounded border-white/10 bg-white/5 text-primary-600 focus:ring-primary-500">
                        Ingat saya
                    </label>
                </div>

                <x-neon-button type="submit" variant="primary" size="lg" class="w-full">
                    🚀 Masuk
                </x-neon-button>
            </form>

            <p class="text-center text-sm text-slate-400 mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-primary-400 hover:text-primary-300 font-medium">Daftar Sekarang</a>
            </p>
        </x-glass-card>
    </div>
</x-layouts.app>
