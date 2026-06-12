<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-bold font-[Outfit] gradient-text mb-2">🔮 Ramalan Nama</h1>
        <p class="text-slate-400">Masukkan namamu dan temukan ramalanmu!</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Input Panel --}}
        <x-glass-card>
            <form wire:submit="generate" class="space-y-5">
                {{-- Name Input --}}
                <div>
                    <label for="fortune-name" class="block text-sm font-medium text-slate-300 mb-2">Nama</label>
                    <input type="text" id="fortune-name" wire:model="name"
                           placeholder="Masukkan nama..."
                           class="text-lg">
                    @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>

                {{-- Category Selection --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-3">Kategori</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                        @foreach($categories as $cat)
                            <button type="button"
                                    wire:click="$set('selectedCategory', '{{ $cat->slug }}')"
                                    class="p-3 rounded-xl text-sm font-medium transition-all duration-200 text-center
                                           {{ $selectedCategory === $cat->slug
                                              ? 'gradient-primary text-white glow-blue'
                                              : 'glass hover:bg-white/5 text-slate-300' }}">
                                <span class="text-lg">{{ $cat->icon }}</span>
                                <span class="block mt-1">{{ $cat->name }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Sub Category --}}
                @php
                    $activeCat = $categories->firstWhere('slug', $selectedCategory);
                @endphp
                @if($activeCat && $activeCat->subCategories->count() > 0)
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Sub Kategori</label>
                        <div class="flex flex-wrap gap-2">
                            <button type="button"
                                    wire:click="$set('selectedSubCategory', '')"
                                    class="px-3 py-1.5 rounded-lg text-xs font-medium transition-all
                                           {{ $selectedSubCategory === '' ? 'bg-primary-600 text-white' : 'glass text-slate-400 hover:text-white' }}">
                                Semua
                            </button>
                            @foreach($activeCat->subCategories as $sub)
                                <button type="button"
                                        wire:click="$set('selectedSubCategory', '{{ $sub->slug }}')"
                                        class="px-3 py-1.5 rounded-lg text-xs font-medium transition-all
                                               {{ $selectedSubCategory === $sub->slug ? 'bg-primary-600 text-white' : 'glass text-slate-400 hover:text-white' }}">
                                    {{ $sub->icon }} {{ $sub->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Generate Button --}}
                <x-neon-button type="submit" variant="primary" size="lg" class="w-full" :loading="true">
                    <span wire:loading.remove wire:target="generate">🔮 Generate Ramalan</span>
                    <span wire:loading wire:target="generate">⏳ Sedang Meramal...</span>
                </x-neon-button>
            </form>
        </x-glass-card>

        {{-- Result Panel --}}
        <div>
            @if($result)
                <x-glass-card class="animate-bounce-in glow-blue">
                    <div class="text-center space-y-4">
                        <div class="text-5xl">{{ $result['emoji'] }}</div>
                        <h2 class="text-xl font-bold font-[Outfit] text-primary-400">{{ $result['title'] }}</h2>
                        <p class="text-slate-200 leading-relaxed text-lg">{{ $result['content'] }}</p>

                        <x-progress-bar :value="$result['luck_level']" label="Tingkat Keberuntungan" color="blue" height="h-4" class="mt-6" />

                        <div class="pt-4 flex gap-3 justify-center">
                            <x-neon-button variant="secondary" size="sm" wire:click="resetResult">
                                🔄 Ramal Lagi
                            </x-neon-button>
                        </div>
                    </div>
                </x-glass-card>
            @else
                <x-glass-card class="flex items-center justify-center min-h-[300px]">
                    <div class="text-center text-slate-500">
                        <div class="text-6xl mb-4 animate-float">🔮</div>
                        <p class="text-lg">Hasil ramalan akan muncul di sini</p>
                        <p class="text-sm mt-1">Masukkan nama dan klik Generate!</p>
                    </div>
                </x-glass-card>
            @endif
        </div>
    </div>
</div>
