<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiktokComment extends Model
{
    protected $fillable = ['tiktok_session_id', 'username', 'comment', 'is_processed'];

    protected $casts = ['is_processed' => 'boolean'];
}
