<div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold font-[Outfit] mb-2">Manajemen Kategori</h1>
            <p class="text-slate-400">Kelola kategori utama ramalan yang tampil di halaman depan.</p>
        </div>
        <x-neon-button wire:click="create" variant="primary" size="md">
            + Tambah Kategori
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
            <span x-text="type === 'success' ? '✅' : '🗑️'"></span>
            <span x-text="message" class="font-medium"></span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($categories as $category)
            <x-glass-card class="relative flex flex-col h-full group transition-all hover:border-white/20 hover:-translate-y-1">
                <div class="absolute top-4 right-4 flex gap-2">
                    <button wire:click="edit({{ $category->id }})" class="p-1.5 rounded-lg bg-blue-500/20 text-blue-400 hover:bg-blue-500/40 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    </button>
                    <button wire:click="delete({{ $category->id }})" wire:confirm="Hapus kategori ini?" class="p-1.5 rounded-lg bg-red-500/20 text-red-400 hover:bg-red-500/40 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>

                <div class="text-4xl mb-4 pt-2">{{ $category->icon }}</div>
                <h3 class="text-xl font-bold font-[Outfit] mb-1">{{ $category->name }}</h3>
                <p class="text-sm text-slate-400 mb-4 flex-grow">{{ $category->description ?: 'Tidak ada deskripsi' }}</p>
                
                <div class="pt-4 border-t border-white/5 flex items-center justify-between mt-auto">
                    <div class="text-xs text-slate-400">
                        {{ $category->sub_categories_count }} Sub Kategori
                    </div>
                    <button wire:click="toggleActive({{ $category->id }})" class="px-3 py-1 rounded-full text-xs font-semibold transition-colors {{ $category->is_active ? 'bg-green-500/20 text-green-400 hover:bg-green-500/30' : 'bg-slate-500/20 text-slate-400 hover:bg-slate-500/30' }}">
                        {{ $category->is_active ? 'Publik' : 'Sembunyi' }}
                    </button>
                </div>
            </x-glass-card>
        @empty
            <div class="col-span-full">
                <x-glass-card class="text-center py-12">
                    <div class="text-4xl mb-4 text-slate-600">📂</div>
                    <p class="text-slate-400">Belum ada kategori yang dibuat.</p>
                </x-glass-card>
            </div>
        @endforelse
    </div>

    {{-- Modal --}}
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black/60 backdrop-blur-sm transition-all">
            <x-glass-card class="w-full max-w-md max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold font-[Outfit]">{{ $categoryId ? 'Edit Kategori' : 'Tambah Kategori' }}</h3>
                    <button wire:click="$set('showModal', false)" class="text-slate-400 hover:text-white">✕</button>
                </div>

                <form wire:submit="save" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">Nama Kategori</label>
                        <input type="text" wire:model.live="name" class="w-full text-sm">
                        @error('name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-1">Slug (URL)</label>
                            <input type="text" wire:model="slug" class="w-full text-sm bg-black/20" {{ $categoryId ? 'readonly' : '' }}>
                            @error('slug') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-1">Icon (Emoji/Text)</label>
                            <input type="text" wire:model="icon" class="w-full text-sm text-center text-xl">
                            @error('icon') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">Deskripsi</label>
                        <textarea wire:model="description" rows="3" class="w-full text-sm"></textarea>
                        @error('description') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center gap-2 mt-2">
                        <input type="checkbox" wire:model="isActive" id="isActiveCat">
                        <label for="isActiveCat" class="text-sm font-medium text-slate-300">Aktif (Tampil di form input publik)</label>
                    </div>

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
