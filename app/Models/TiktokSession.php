<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TiktokSession extends Model
{
    protected $fillable = ['user_id', 'room_id', 'host_username', 'status', 'viewer_count', 'comment_count', 'gift_count'];

    public function comments(): HasMany
    {
        return $this->hasMany(TiktokComment::class);
    }

    public function gifts(): HasMany
    {
        return $this->hasMany(TiktokGift::class);
    }
}
