<?php

namespace App\Http\Controllers\Game;

use App\Models\Game;
use App\Models\Point;
use App\Models\Round;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Game $game)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Game $game)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Game $game)
    {
        $round = $game->rounds()->create();

        $points = $request->points;

        foreach ($game->players as $player) {
            $playerPoint = $points[$player->id];
            $round->points()->create([
                'player_id' => $player->id,
                'points' => $playerPoint
            ]);
        }

        $round->sumarize();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game, Round $round)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game, Round $round)
    {
        return view('round.edit', compact('round', 'game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game, Round $round)
    {
        foreach ($request->points as $pointId => $value) {
            Point::find($pointId)->update([
                'points' => $value
            ]);
        }

        $round->sumarize();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game, Round $round)
    {
        //
    }
}
