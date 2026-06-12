<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuraTemplate extends Model
{
    protected $fillable = ['aura_type', 'title', 'description', 'color', 'emoji', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function getByNameHash(string $name): ?self
    {
        $templates = static::active()->get();
        if ($templates->isEmpty()) return null;

        $hash = crc32(strtolower(trim($name)));
        return $templates[abs($hash) % $templates->count()];
    }

    public static function getAuraTypeForName(string $name): string
    {
        $types = ['sultan', 'positif', 'misterius', 'anime', 'gamer', 'ambisius', 'santai'];
        $hash = crc32(strtolower(trim($name)));
        return $types[abs($hash) % count($types)];
    }
}
