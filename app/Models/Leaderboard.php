<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    protected $fillable = ['viewer_name', 'type', 'score', 'session_id'];

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeTopScores($query, int $limit = 10)
    {
        return $query->orderByDesc('score')->limit($limit);
    }
}
