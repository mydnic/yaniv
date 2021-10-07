@extends('app')

@section('content')

<form action="{{route('game.store')}}" method="post">
    @csrf

    <div>
        @foreach ($players as $player)
            <div>
                <input type="checkbox" name="players[{{$player->id}}]">
                {{$player->name}}
            </div>
        @endforeach
        <a href="{{route('player.create')}}">add new player</a>
    </div>

    <div>
        <button type="submit">
            Commencer
        </button>
    </div>
</form>

@endsection
