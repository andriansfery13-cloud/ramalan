<?php

namespace App\Services;

use App\Models\NameBattle;

class NameBattleService
{
    public function battle(string $nameA, string $nameB, ?int $userId = null): array
    {
        $hashA = abs(crc32(strtolower(trim($nameA))));
        $hashB = abs(crc32(strtolower(trim($nameB))));

        // Generate scores from name characteristics
        $scoreA = ($hashA % 51) + 50; // 50-100
        $scoreB = ($hashB % 51) + 50; // 50-100

        // Add some variation based on name length and character values
        $scoreA += strlen($nameA) % 10;
        $scoreB += strlen($nameB) % 10;

        // Cap at 100
        $scoreA = min($scoreA, 100);
        $scoreB = min($scoreB, 100);

        $winner = $scoreA >= $scoreB ? $nameA : $nameB;
        $description = $this->generateBattleDescription($nameA, $nameB, $scoreA, $scoreB, $winner);

        $result = [
            'name_a' => $nameA,
            'name_b' => $nameB,
            'score_a' => $scoreA,
            'score_b' => $scoreB,
            'winner' => $winner,
            'description' => $description,
        ];

        $battle = NameBattle::create(array_merge($result, ['user_id' => $userId]));

        event(new \App\Events\FortuneGenerated([
            'id' => $battle->id,
            'name' => $nameA . ' vs ' . $nameB,
            'title' => '⚔️ BATTLE: ' . $winner . ' WIN!',
            'content' => $description,
            'luck_level' => max($scoreA, $scoreB),
            'emoji' => '⚔️',
            'mode' => 'template',
        ]));

        return $result;
    }

    private function generateBattleDescription(string $a, string $b, int $scoreA, int $scoreB, string $winner): string
    {
        $diff = abs($scoreA - $scoreB);

        if ($diff <= 5) {
            return "🔥 BATTLE SENGIT! {$a} dan {$b} hampir seimbang! {$winner} menang tipis dengan selisih {$diff} poin!";
        } elseif ($diff <= 15) {
            return "⚔️ Pertarungan yang menarik! {$winner} berhasil unggul dengan skor yang cukup meyakinkan!";
        } elseif ($diff <= 30) {
            return "💪 {$winner} menang telak! Dominasi yang tidak terbantahkan dalam battle ini!";
        } else {
            return "👑 TOTAL DOMINATION! {$winner} menghancurkan lawan dengan keunggulan mutlak! GG!";
        }
    }
}
