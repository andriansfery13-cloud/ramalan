<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NameAnalysis extends Model
{
    protected $fillable = ['user_id', 'name', 'letter_analysis', 'dominant_character', 'personality', 'strength', 'potential', 'mode'];

    protected $casts = [
        'letter_analysis' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
