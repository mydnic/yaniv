@extends('app')

@section('content')
<div class="py-10 bg-blue-200">
    <div class="mb-10 text-center">
        #{{ $game->id }} - {{ $game->created_at->format('d/m/Y H:i') }}
    </div>
    <div class="mb-10 text-center">
        Winner : {{ $game->winner ? $game->winner->name : '/' }}
    </div>
    <div class="container mx-auto">
        <table class="table-default">
            <thead>
                <tr>
                    <th>Joueurs</th>
                    @foreach ($game->players as $player)
                        <th>{{ $player->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Scores</td>
                    @foreach ($game->players as $player)
                        <td>
                            <span
                                @class([
                                    'text-xl font-bold text-green-500' => $currentWinner->id === $player->id,
                                    'text-xl font-bold text-red-500' => $currentWinner->id != $player->id,
                                ])
                            >{{ $game->getScoreForPlayer($player) }}</span>
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container mx-auto mt-10">
        <div class="text-center">Au tour de : {{ $game->getNextPlayer()->name }}</div>
    </div>
</div>


<div class="py-5 bg-gray-100">
    <div class="container mx-auto">
        <form action="{{route('game.round.store', $game)}}" method="post">
            @csrf

            <div class="flex items-end justify-center space-x-2">
                @foreach ($game->players as $player)
                    <div>
                        <label class="label">{{ $player->name }}</label>
                        <input class="input" type="number" placeholder="points" name="points[{{$player->id}}]" required>
                    </div>
                @endforeach

                <button type="submit" class="btn">Enregistrer round</button>
            </div>
        </form>
    </div>
</div>

<div class="container py-5 mx-auto">
    <table class="table-default">
        <thead>
            <tr>
                <th></th>
                @foreach ($game->players as $player)
                    <th>{{ $player->name }}</th>
                @endforeach
                <th>Heure</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($game->lastRounds as $round)
                <tr>
                    <td></td>
                    @foreach ($game->players as $player)
                        <td>
                            <span
                                @class([
                                    'text-lg text-green-600 font-semibold' => $round->winner_id === $player->id || $round->is_bonus,
                                    'text-lg text-red-600' => $round->winner_id != $player->id,
                                ])
                            >{{ $round->getScoreForPlayer($player) }}</span>
                        </td>
                    @endforeach
                    <td>{{$round->created_at->format('H:i')}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
