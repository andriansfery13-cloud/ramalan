<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoastResult extends Model
{
    protected $fillable = ['user_id', 'name', 'content', 'intensity', 'mode'];
}
