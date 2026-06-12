<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FortuneTemplate extends Model
{
    protected $fillable = ['sub_category_id', 'type', 'title', 'content', 'emoji', 'luck_level', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get a template based on name hash for consistency.
     */
    public static function getByNameHash(string $name, string $type = 'general', ?int $subCategoryId = null): ?self
    {
        $query = static::active()->ofType($type);

        if ($subCategoryId) {
            $query->where('sub_category_id', $subCategoryId);
        }

        $total = $query->count();
        if ($total === 0) return null;

        $hash = crc32(strtolower(trim($name)));
        $offset = abs($hash) % $total;

        return $query->skip($offset)->first();
    }
}
