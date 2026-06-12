<div class="max-w-4xl mx-auto" x-data="spinnerData()" @spinner-complete.window="onSpinComplete($event.detail.winner)">
    <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-bold font-[Outfit] gradient-text mb-2">🎯 Spinner Nama</h1>
        <p class="text-slate-400">Wheel of Fortune — Pilih pemenang secara acak!</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Wheel Display --}}
        <x-glass-card class="flex flex-col items-center justify-center min-h-[400px]">
            @if(count($names) >= 2)
                <div class="wheel-container mb-6">
                    <div class="wheel-pointer"></div>
                    <canvas id="spinnerCanvas" width="400" height="400"
                            class="w-full h-full rounded-full"
                            x-ref="canvas"
                            x-init="drawWheel(@js($names))"></canvas>
                </div>

                @if($winner)
                    <div class="text-center animate-bounce-in mt-4">
                        <p class="text-sm text-slate-400 mb-1">🎉 Pemenangnya adalah:</p>
                        <h2 class="text-3xl font-black gradient-text font-[Outfit]">{{ $winner }}</h2>
                        <x-neon-button variant="ghost" size="sm" wire:click="resetSpinner" class="mt-4">🔄 Putar Lagi</x-neon-button>
                    </div>
                @else
                    <x-neon-button variant="primary" size="xl" wire:click="spin" class="mt-4" :loading="true" x-on:click="spinWheel()">
                        <span wire:loading.remove wire:target="spin">🎯 PUTAR!</span>
                        <span wire:loading wire:target="spin">⏳ Berputar...</span>
                    </x-neon-button>
                @endif
            @else
                <div class="text-center text-slate-500">
                    <div class="text-6xl mb-4 animate-float">🎯</div>
                    <p>Tambahkan minimal 2 nama</p>
                    <p class="text-sm mt-1">untuk memulai spinner</p>
                </div>
            @endif
        </x-glass-card>

        {{-- Name List --}}
        <x-glass-card>
            <h3 class="text-lg font-semibold mb-4 font-[Outfit]">Daftar Nama ({{ count($names) }}/20)</h3>

            <form wire:submit="addName" class="flex gap-2 mb-4">
                <input type="text" wire:model="newName" placeholder="Tambah nama..." class="flex-1">
                <x-neon-button type="submit" variant="primary" size="md">+ Tambah</x-neon-button>
            </form>

            <div class="space-y-2 max-h-[400px] overflow-y-auto">
                @forelse($names as $i => $n)
                    <div class="flex items-center justify-between p-3 glass rounded-xl animate-slide-up"
                         style="animation-delay: {{ $i * 0.05 }}s">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold text-white"
                                 style="background: {{ ['#3b82f6', '#ef4444', '#22c55e', '#f59e0b', '#8b5cf6', '#ec4899', '#06b6d4', '#f97316'][$i % 8] }}">
                                {{ $i + 1 }}
                            </div>
                            <span class="font-medium {{ $winner === $n ? 'text-yellow-400' : '' }}">
                                {{ $n }} {{ $winner === $n ? '👑' : '' }}
                            </span>
                        </div>
                        <button wire:click="removeName({{ $i }})" class="text-red-400 hover:text-red-300 transition-colors p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @empty
                    <p class="text-center text-slate-500 py-4">Belum ada nama ditambahkan</p>
                @endforelse
            </div>
        </x-glass-card>
    </div>
</div>

@push('scripts')
<script>
function spinnerData() {
    return {
        rotation: 0,
        spinning: false,
        drawWheel(names) {
            const canvas = this.$refs.canvas;
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            const centerX = canvas.width / 2;
            const centerY = canvas.height / 2;
            const radius = Math.min(centerX, centerY) - 10;
            const colors = ['#3b82f6', '#ef4444', '#22c55e', '#f59e0b', '#8b5cf6', '#ec4899', '#06b6d4', '#f97316'];
            const sliceAngle = (2 * Math.PI) / names.length;

            ctx.clearRect(0, 0, canvas.width, canvas.height);

            names.forEach((name, i) => {
                const startAngle = i * sliceAngle + this.rotation;
                const endAngle = startAngle + sliceAngle;

                ctx.beginPath();
                ctx.moveTo(centerX, centerY);
                ctx.arc(centerX, centerY, radius, startAngle, endAngle);
                ctx.closePath();
                ctx.fillStyle = colors[i % colors.length];
                ctx.fill();
                ctx.strokeStyle = 'rgba(255,255,255,0.2)';
                ctx.lineWidth = 2;
                ctx.stroke();

                // Text
                ctx.save();
                ctx.translate(centerX, centerY);
                ctx.rotate(startAngle + sliceAngle / 2);
                ctx.textAlign = 'right';
                ctx.fillStyle = '#fff';
                ctx.font = 'bold 14px Inter';
                ctx.fillText(name.substring(0, 10), radius - 20, 5);
                ctx.restore();
            });

            // Center circle
            ctx.beginPath();
            ctx.arc(centerX, centerY, 20, 0, 2 * Math.PI);
            ctx.fillStyle = '#0a0e1a';
            ctx.fill();
            ctx.strokeStyle = '#3b82f6';
            ctx.lineWidth = 3;
            ctx.stroke();
        },
        spinWheel() {
            if (this.spinning) return;
            this.spinning = true;
            const canvas = this.$refs.canvas;
            if (!canvas) return;
            const names = @js($names);
            const totalRotation = Math.PI * 2 * (5 + Math.random() * 5);
            const duration = 4000;
            const start = performance.now();
            const startRotation = this.rotation;

            const animate = (time) => {
                const elapsed = time - start;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 4);
                this.rotation = startRotation + totalRotation * eased;
                this.drawWheel(names);
                if (progress < 1) requestAnimationFrame(animate);
                else this.spinning = false;
            };
            requestAnimationFrame(animate);
        },
        onSpinComplete(winner) {
            if (typeof createConfetti === 'function') createConfetti(80);
        }
    };
}
</script>
@endpush
