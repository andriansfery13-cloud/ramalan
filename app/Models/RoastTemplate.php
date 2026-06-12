<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoastTemplate extends Model
{
    protected $fillable = ['content', 'intensity', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function getByNameHash(string $name, string $intensity = 'mild'): ?self
    {
        $query = static::active()->where('intensity', $intensity);
        $total = $query->count();
        if ($total === 0) return null;

        $hash = crc32(strtolower(trim($name)));
        return $query->skip(abs($hash) % $total)->first();
    }
}
