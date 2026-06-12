<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NameMatch extends Model
{
    protected $fillable = ['user_id', 'name_a', 'name_b', 'friendship_score', 'cooperation_score', 'entertainment_score', 'romantic_score', 'overall_score', 'description'];
}
