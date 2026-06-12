<div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold font-[Outfit] mb-2">Template Ramalan</h1>
            <p class="text-slate-400">Kelola 20,000+ template ramalan yang akan digunakan saat Mode Template aktif.</p>
        </div>
        <x-neon-button wire:click="create" variant="primary" size="md">
            + Tambah Template
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

    <x-glass-card class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari judul / konten..." class="w-full text-sm">
            </div>
            <div>
                <select wire:model.live="filterType" class="w-full text-sm">
                    <option value="">Semua Tipe</option>
                    @foreach($types as $t)
                        <option value="{{ $t }}">{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select wire:model.live="filterSubCategory" class="w-full text-sm">
                    <option value="">Semua Sub Kategori</option>
                    @foreach($subCategories as $sub)
                        <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-400 uppercase bg-white/5">
                    <tr>
                        <th class="px-4 py-3 rounded-tl-xl">Info</th>
                        <th class="px-4 py-3">Konten</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 rounded-tr-xl text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($templates as $template)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="text-2xl">{{ $template->emoji }}</div>
                                    <div>
                                        <div class="font-bold text-white">{{ $template->title }}</div>
                                        <div class="text-xs flex items-center gap-1 mt-1">
                                            <span class="text-slate-400">Hoki:</span>
                                            <span class="{{ $template->luck_level >= 80 ? 'text-green-400' : ($template->luck_level >= 50 ? 'text-blue-400' : 'text-red-400') }} font-semibold">{{ $template->luck_level }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-slate-300">
                                <div class="line-clamp-2">{{ $template->content }}</div>
                            </td>
                            <td class="px-4 py-4">
                                <span class="px-2 py-1 bg-purple-500/20 text-purple-300 rounded text-xs">
                                    {{ $template->type }}
                                </span>
                                @if($template->subCategory)
                                <span class="px-2 py-1 bg-blue-500/20 text-blue-300 rounded text-xs ml-1">
                                    {{ $template->subCategory->name }}
                                </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-center">
                                <button wire:click="toggleActive({{ $template->id }})" class="px-3 py-1 rounded-full text-xs font-semibold {{ $template->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                    {{ $template->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="edit({{ $template->id }})" class="text-blue-400 hover:text-blue-300">Edit</button>
                                    <button wire:click="delete({{ $template->id }})" wire:confirm="Yakin hapus template ini?" class="text-red-400 hover:text-red-300">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-slate-500">Tidak ada template yang ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $templates->links(data: ['scrollTo' => false]) }}
        </div>
    </x-glass-card>

    {{-- Modal --}}
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black/60 backdrop-blur-sm transition-all">
            <x-glass-card class="w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold font-[Outfit]">{{ $templateId ? 'Edit Template' : 'Tambah Template' }}</h3>
                    <button wire:click="$set('showModal', false)" class="text-slate-400 hover:text-white">✕</button>
                </div>

                <form wire:submit="save" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-1">Tipe</label>
                            <input type="text" wire:model="type" class="w-full text-sm">
                            @error('type') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-1">Sub Kategori (Opsional)</label>
                            <select wire:model="subCategoryId" class="w-full text-sm">
                                <option value="">Tidak ada</option>
                                @foreach($subCategories as $sub)
                                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                @endforeach
                            </select>
                            @error('subCategoryId') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">Judul Ramalan</label>
                        <input type="text" wire:model="title" class="w-full text-sm">
                        @error('title') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">Konten Ramalan</label>
                        <textarea wire:model="content" rows="4" class="w-full text-sm"></textarea>
                        @error('content') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-1">Emoji</label>
                            <input type="text" wire:model="emoji" class="w-full text-sm text-2xl text-center">
                            @error('emoji') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-1">Level Hoki (0-100)</label>
                            <input type="number" wire:model="luckLevel" class="w-full text-sm" min="0" max="100">
                            @error('luckLevel') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-2 mt-2">
                        <input type="checkbox" wire:model="isActive" id="isActive">
                        <label for="isActive" class="text-sm font-medium text-slate-300">Aktif (Tampil di ramalan publik)</label>
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
