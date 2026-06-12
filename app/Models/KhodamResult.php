<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhodamResult extends Model
{
    protected $fillable = [
        'user_id', 'target_name', 'khodam_name', 'description', 
        'emoji', 'power_level', 'mode'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
