<?php

namespace App\Livewire\Admin;

use App\Models\Fortune;
use App\Models\TiktokComment;
use App\Models\TiktokGift;
use App\Models\User;
use App\Models\Viewer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Statistics extends Component
{
    public string $period = 'today';

    public function render()
    {
        $startDate = match ($this->period) {
            'today' => Carbon::today(),
            'week' => Carbon::now()->subDays(7),
            'month' => Carbon::now()->subDays(30),
            'all' => Carbon::createFromTimestamp(0),
        };

        $totalFortunes = Fortune::where('created_at', '>=', $startDate)->count();
        $totalViewers = Viewer::where('created_at', '>=', $startDate)->count();
        $totalComments = TiktokComment::where('created_at', '>=', $startDate)->count();
        $totalGifts = TiktokGift::where('created_at', '>=', $startDate)->count();

        // Kategori terpopuler
        $popularCategories = Fortune::where('created_at', '>=', $startDate)
            ->select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Penggunaan Mode (OpenAI vs Template)
        $modeUsage = Fortune::where('created_at', '>=', $startDate)
            ->select('mode', DB::raw('count(*) as total'))
            ->groupBy('mode')
            ->get();

        return view('livewire.admin.statistics', [
            'totalFortunes' => $totalFortunes,
            'totalViewers' => $totalViewers,
            'totalComments' => $totalComments,
            'totalGifts' => $totalGifts,
            'popularCategories' => $popularCategories,
            'modeUsage' => $modeUsage,
        ])->layout('components.layouts.admin', ['title' => 'Statistik & Laporan']);
    }
}
