<x-layouts.app title="Daftar">
    <div class="min-h-[70vh] flex items-center justify-center">
        <x-glass-card class="w-full max-w-md animate-slide-up">
            <div class="text-center mb-8">
                <div class="text-4xl mb-3">✨</div>
                <h1 class="text-2xl font-bold font-[Outfit] gradient-text">Daftar Ramalanku</h1>
                <p class="text-sm text-slate-400 mt-1">Buat akun baru secara gratis!</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Nama lengkap">
                    @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com">
                    @error('email') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter">
                    @error('password') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi password">
                </div>

                <x-neon-button type="submit" variant="primary" size="lg" class="w-full">
                    ✨ Daftar Sekarang
                </x-neon-button>
            </form>

            <p class="text-center text-sm text-slate-400 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-primary-400 hover:text-primary-300 font-medium">Masuk</a>
            </p>
        </x-glass-card>
    </div>
</x-layouts.app>
