@extends('app')

@section('content')

<div class="container px-2 py-6 mx-auto md:px-0">
    <div class="flex items-center justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Nouvelle partie
            </h1>
        </div>
    </div>

    <form action="{{route('game.store')}}" method="post">
        @csrf

        <label class="mb-2 label">Choisir les joueurs</label>
        <div class="grid grid-cols-2 gap-4 md:grid-cols-24">
            @foreach ($players as $player)
                <label class="p-3 text-center border rounded">
                    <div class="my-5">{{$player->name}}</div>
                    <input type="checkbox" name="players[{{$player->id}}]">
                </label>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <button type="submit" class="btn">
                Commencer
            </button>
        </div>
    </form>
</div>

@endsection
