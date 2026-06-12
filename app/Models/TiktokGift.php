<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiktokGift extends Model
{
    protected $fillable = ['tiktok_session_id', 'username', 'gift_name', 'gift_count', 'diamond_count', 'response', 'is_processed'];

    protected $casts = ['is_processed' => 'boolean'];
}
