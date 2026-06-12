<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NameMeaningTemplate extends Model
{
    protected $fillable = ['letter', 'meaning', 'trait', 'category', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForLetter($query, string $letter)
    {
        return $query->where('letter', strtoupper($letter));
    }

    public static function getByLetterHash(string $letter, string $name): ?self
    {
        $templates = static::active()->forLetter($letter)->get();
        if ($templates->isEmpty()) return null;

        $hash = crc32(strtolower(trim($name)));
        return $templates[abs($hash) % $templates->count()];
    }
}
