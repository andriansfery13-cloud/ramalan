<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpinnerEntry extends Model
{
    protected $fillable = ['spinner_session_id', 'name', 'color', 'is_winner'];

    protected $casts = ['is_winner' => 'boolean'];

    public function session(): BelongsTo
    {
        return $this->belongsTo(SpinnerSession::class, 'spinner_session_id');
    }
}
