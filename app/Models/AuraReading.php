<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuraReading extends Model
{
    protected $fillable = ['user_id', 'name', 'aura_type', 'title', 'description', 'color', 'emoji', 'power_level', 'mode'];
}
