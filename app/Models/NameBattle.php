<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NameBattle extends Model
{
    protected $fillable = ['user_id', 'name_a', 'name_b', 'score_a', 'score_b', 'winner', 'description'];
}
