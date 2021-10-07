<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'round_id',
        'points',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function round()
    {
        return $this->belongsTo(Round::class);
    }
}
