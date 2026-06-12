<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viewer extends Model
{
    protected $fillable = ['username', 'display_name', 'platform', 'fortune_count', 'gift_count', 'comment_count'];
}
