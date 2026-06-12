<div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold font-[Outfit] mb-2">Manajemen Pengguna</h1>
            <p class="text-slate-400">Kelola akun Host, Admin, dan Pengguna reguler.</p>
        </div>
        <x-neon-button wire:click="create" variant="primary" size="md">
            + Tambah User
        </x-neon-button>
    </div>

    {{-- Notification Toast --}}
    <div x-data="{ show: false, message: '', type: 'success' }"
         x-on:notify.window="message = $event.detail.message; type = $event.detail.type; show = true; setTimeout(() => show = false, 3000)"
         class="fixed top-4 right-4 z-50">
        <div x-show="show" style="display: none;"
             x-transition
             :class="type === 'success' ? 'bg-green-500/20 text-green-400 border-green-500/30' : 'bg-red-500/20 text-red-400 border-red-500/30'"
             class="border px-4 py-3 rounded-xl shadow-lg backdrop-blur flex items-center gap-2">
            <span x-text="type === 'success' ? '✅' : '⚠️'"></span>
            <span x-text="message" class="font-medium"></span>
        </div>
    </div>

    <x-glass-card>
        <div class="mb-6 max-w-sm">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari nama atau email..." class="w-full text-sm">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-400 uppercase bg-white/5">
                    <tr>
                        <th class="px-4 py-3 rounded-tl-xl">Pengguna</th>
                        <th class="px-4 py-3">Peran</th>
                        <th class="px-4 py-3">Terdaftar</th>
                        <th class="px-4 py-3 rounded-tr-xl text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($users as $user)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-white">{{ $user->name }}</div>
                                        <div class="text-xs text-slate-400 mt-0.5">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                @if($user->is_admin)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-500/20 text-purple-400 border border-purple-500/30">Admin</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-500/20 text-slate-400 border border-slate-500/30">User</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-slate-400">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-4 py-4 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <button wire:click="edit({{ $user->id }})" class="text-blue-400 hover:text-blue-300 font-medium">Edit</button>
                                    @if($user->id !== auth()->id())
                                        <button wire:click="delete({{ $user->id }})" wire:confirm="Yakin menghapus user ini?" class="text-red-400 hover:text-red-300 font-medium">Hapus</button>
                                    @else
                                        <span class="text-slate-500 text-xs">(Anda)</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-slate-500">Tidak ada user ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </x-glass-card>

    {{-- Modal --}}
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black/60 backdrop-blur-sm transition-all">
            <x-glass-card class="w-full max-w-md max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold font-[Outfit]">{{ $userId ? 'Edit User' : 'Tambah User' }}</h3>
                    <button wire:click="$set('showModal', false)" class="text-slate-400 hover:text-white">✕</button>
                </div>

                <form wire:submit="save" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="name" class="w-full text-sm">
                        @error('name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">Alamat Email</label>
                        <input type="email" wire:model="email" class="w-full text-sm">
                        @error('email') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">
                            Password {{ $userId ? '(Isi jika ingin mereset password)' : '' }}
                        </label>
                        <input type="password" wire:model="password" class="w-full text-sm">
                        @error('password') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    @if($userId !== auth()->id())
                        <div class="glass p-3 rounded-xl flex items-center justify-between border border-white/5">
                            <div>
                                <h4 class="text-sm font-medium text-slate-200">Hak Akses Admin</h4>
                                <p class="text-xs text-slate-400 mt-1">Berikan akses ke halaman pengaturan panel ini.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" wire:model="isAdmin" class="sr-only peer">
                                <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-500"></div>
                            </label>
                        </div>
                    @else
                        <div class="text-xs text-slate-500 p-2 bg-white/5 rounded-lg text-center mt-2">
                            Anda tidak bisa mengubah role Anda sendiri.
                        </div>
                    @endif

                    <div class="pt-4 border-t border-white/10 flex justify-end gap-3">
                        <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2 rounded-xl glass hover:bg-white/10 text-sm font-medium transition-colors">Batal</button>
                        <x-neon-button type="submit" variant="primary" size="md">
                            💾 Simpan
                        </x-neon-button>
                    </div>
                </form>
            </x-glass-card>
        </div>
    @endif
</div>
