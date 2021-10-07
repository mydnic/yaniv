<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Game extends Model
{
    use HasFactory;

    public function players()
    {
        return $this->belongsToMany(Player::class);
    }

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function winner()
    {
        return $this->belongsTo(Player::class, 'winner_id');
    }

    public function getScoreForPlayer(Player $player): int
    {
        return $this->rounds()->with('points')->get()->sum(function ($round) use ($player) {
            return $round->points()->where('player_id', $player->id)->sum('points');
        });
    }

    public function currentWinner()
    {
        return $this->currentTotalPoints()->sortBy('score')->first()['player'];
    }

    public function currentTotalPoints()
    {
        $points = collect();

        foreach ($this->players as $player) {
            $points->push([
                'player' => $player,
                'score' => $this->getScoreForPlayer($player),
            ]);
        }

        return $points;
    }

    public function lastRounds()
    {
        return $this->rounds()->orderBy('id', 'desc');
    }

    public function getNextPlayer()
    {
        if ($this->rounds->count()) {
            return $this->lastRounds()->where('is_bonus', false)->first()->winner;
        }

        return $this->players()->inRandomOrder()->first();
    }

    public function checkTotalPoints()
    {
        foreach ($this->currentTotalPoints() as $playerPoints) {
            if ($playerPoints['score'] === 100 || $playerPoints['score'] === 200) {
                $this->registerBonusPoints($playerPoints['player']);
            }

            if ($playerPoints['score'] > 200) {
                $this->registerWinner($playerPoints['player']);
            }
        }
    }

    public function registerBonusPoints(Player $player)
    {
        $round = $this->rounds()->create(['is_bonus' => true]);

        $round->points()->create([
            'player_id' => $player->id,
            'points' => -50
        ]);
    }

    public function registerWinner(Player $player)
    {
        $this->winner_id = $this->players->where('id', '!=', $player->id)->first()->id;
        $this->save();
    }
}
