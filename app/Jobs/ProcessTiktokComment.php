<?php

namespace App\Jobs;

use App\Services\FortuneService;
use App\Services\KhodamService;
use App\Services\AuraDetectorService;
use App\Services\RoastGeneratorService;
use App\Models\AppSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessTiktokComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        $isAutoMode = AppSetting::getValue('tiktok_auto_mode', 'false') === 'true';
        if (!$isAutoMode) return;

        $comment = strtolower(trim($this->data['comment'] ?? ''));
        if (empty($comment)) return;

        $username = $this->data['uniqueId'] ?? 'Viewer';
        // Extract the target name from the comment. 
        // e.g. "!khodam Budi" -> "Budi"
        
        try {
            if (str_starts_with($comment, '!khodam ')) {
                $targetName = trim(substr($comment, 8));
                if ($targetName) {
                    $mode = AppSetting::getValue('global_mode', 'template');
                    app(KhodamService::class)->checkKhodam($targetName, null, $mode);
                }
            } 
            elseif (str_starts_with($comment, '!aura ')) {
                $targetName = trim(substr($comment, 6));
                if ($targetName) {
                    $mode = AppSetting::getValue('global_mode', 'template');
                    app(AuraDetectorService::class)->detect($targetName, null, $mode);
                }
            }
            elseif (str_starts_with($comment, '!roast ')) {
                $targetName = trim(substr($comment, 7));
                if ($targetName) {
                    $mode = AppSetting::getValue('global_mode', 'template');
                    app(RoastGeneratorService::class)->generateRoast($targetName, null, $mode);
                }
            }
            elseif (str_starts_with($comment, '!ramal ')) {
                $targetName = trim(substr($comment, 7));
                if ($targetName) {
                    // Default to 'tiktok-live' category
                    app(FortuneService::class)->generate($targetName, 'tiktok-live', null, null);
                }
            }
        } catch (\Exception $e) {
            Log::error('ProcessTiktokComment Error: ' . $e->getMessage());
        }
    }
}
