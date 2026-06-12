<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhodamTemplate extends Model
{
    protected $fillable = ['name', 'description', 'type', 'emoji', 'power_level', 'is_active'];
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
}
