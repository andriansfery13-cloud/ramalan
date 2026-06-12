<?php

namespace App\Services;

use App\Models\NameMatch;

class NameMatchService
{
    public function match(string $nameA, string $nameB, ?int $userId = null): array
    {
        $a = strtolower(trim($nameA));
        $b = strtolower(trim($nameB));

        // Generate consistent scores based on name combination hash
        $combinedHash = crc32($a . $b);
        $reverseHash = crc32($b . $a);
        $baseHash = abs($combinedHash + $reverseHash); // Symmetric — same result regardless of order

        $friendship = $this->scoreFromHash($baseHash, 1);
        $cooperation = $this->scoreFromHash($baseHash, 2);
        $entertainment = $this->scoreFromHash($baseHash, 3);
        $romantic = $this->scoreFromHash($baseHash, 4);
        $overall = intval(($friendship + $cooperation + $entertainment + $romantic) / 4);

        $description = $this->generateDescription($nameA, $nameB, $overall);

        $result = [
            'name_a' => $nameA,
            'name_b' => $nameB,
            'friendship_score' => $friendship,
            'cooperation_score' => $cooperation,
            'entertainment_score' => $entertainment,
            'romantic_score' => $romantic,
            'overall_score' => $overall,
            'description' => $description,
        ];

        $match = NameMatch::create(array_merge($result, ['user_id' => $userId]));

        event(new \App\Events\FortuneGenerated([
            'id' => $match->id,
            'name' => $nameA . ' & ' . $nameB,
            'title' => '💕 Kecocokan: ' . $overall . '%',
            'content' => $description,
            'luck_level' => $overall,
            'emoji' => '💕',
            'mode' => 'template',
        ]));

        return $result;
    }

    private function scoreFromHash(int $hash, int $seed): int
    {
        $value = abs(crc32($hash . '_' . $seed));
        return ($value % 61) + 40; // Range 40-100
    }

    private function generateDescription(string $a, string $b, int $overall): string
    {
        if ($overall >= 90) {
            return "{$a} dan {$b} adalah kombinasi yang SEMPURNA! 💯 Kalian seperti dua keping puzzle yang saling melengkapi!";
        } elseif ($overall >= 80) {
            return "{$a} dan {$b} sangat cocok! 🌟 Kalian punya chemistry yang luar biasa kuat!";
        } elseif ($overall >= 70) {
            return "{$a} dan {$b} punya kecocokan yang tinggi! ✨ Saling mendukung dan menguatkan!";
        } elseif ($overall >= 60) {
            return "{$a} dan {$b} cukup cocok! 👍 Ada potensi besar jika saling memahami!";
        } else {
            return "{$a} dan {$b} punya kecocokan yang unik! 🎭 Perbedaan justru bisa saling melengkapi!";
        }
    }
}
