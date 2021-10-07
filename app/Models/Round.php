<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $fillable = ['is_bonus'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function points()
    {
        return $this->hasMany(Point::class);
    }

    public function winner()
    {
        return $this->belongsTo(Player::class, 'winner_id');
    }

    public function getScoreForPlayer(Player $player): int
    {
        $point = $this->points()->where('player_id', $player->id)->first();
        return $point ? $point->points : 0;
    }

    public function sumarize()
    {
        $playerId = $this->points()->orderBy('points', 'asc')->first()->player_id;
        $this->winner_id = $playerId;
        $this->save();

        $this->game->checkTotalPoints();
    }
}
