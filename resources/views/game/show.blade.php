@extends('app')

@section('content')

<div class="bg-gray-900">
    <div class="container px-2 py-6 mx-auto md:px-0">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-white sm:text-3xl sm:truncate">
                    Partie #{{ $game->id }}
                </h2>
                <div class="flex flex-col mt-1 sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                    <div class="flex items-center mt-2 text-sm text-gray-300">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ $game->winner ? $game->winner->name : '/' }}
                    </div>
                    <div class="flex items-center mt-2 text-sm text-gray-300">
                        <!-- Heroicon name: solid/calendar -->
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        {{ $game->created_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-4 mx-auto">
    <label class="mb-2 label">Scores:</label>
    <table class="table-default">
        <thead>
            <tr>
                @foreach ($game->players as $player)
                    <th>{{ $player->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($game->players as $player)
                <td>
                    <span
                    @class([
                        'font-bold text-green-500' => $currentWinner->id === $player->id,
                        'font-bold text-red-500' => $currentWinner->id != $player->id,
                    ])
                    >{{ $game->getScoreForPlayer($player) }}</span>
                </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
<div class="py-6 space-y-2 bg-indigo-500">

    <div class="text-lg text-center text-gray-100">
        Au tour de :
    </div>
    <div class="text-lg font-bold text-center text-white">
        {{ $game->getNextPlayer()->name }}
    </div>

</div>
<div class="container px-2 py-6 mx-auto md:px-0">
    <form action="{{route('game.round.store', $game)}}" method="post">
        @csrf

        <label class="mb-2 label">Enrigstrer points:</label>
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
            @foreach ($game->players as $player)
                <div>
                    <label class="label">{{ $player->name }}</label>
                    <input class="input" value="0" type="number" placeholder="points" name="points[{{$player->id}}]" required>
                </div>
            @endforeach
        </div>

        <div class="mt-4"><button type="submit" class="btn">Enregistrer</button></div>
    </form>
</div>

<div class="container py-5 mx-auto">
    <div class="pb-5 border-b border-gray-200">
        <h3 class="text-lg font-medium leading-6 text-gray-900">
            Rounds
        </h3>
    </div>

    <table class="table-default">
        <thead>
            <tr>
                @foreach ($game->players as $player)
                    <th>{{ $player->name }}</th>
                @endforeach
                <th>Heure</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($game->lastRounds as $round)
                <tr>
                    @foreach ($game->players as $player)
                        <td>
                            <span
                            @class([
                                'text-green-600 font-semibold' => $round->winner_id === $player->id || $round->is_bonus,
                                'text-red-600' => $round->winner_id != $player->id,
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
