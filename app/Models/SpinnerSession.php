<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpinnerSession extends Model
{
    protected $fillable = ['user_id', 'title', 'winner_name', 'status'];

    public function entries(): HasMany
    {
        return $this->hasMany(SpinnerEntry::class);
    }
}
