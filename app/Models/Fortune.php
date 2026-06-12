<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fortune extends Model
{
    protected $fillable = ['user_id', 'name', 'category', 'sub_category', 'title', 'content', 'luck_level', 'emoji', 'mode', 'source'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
