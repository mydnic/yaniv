@extends('app')

@section('content')
<div class="text-center py-20 bg-blue-200">
    <a href="{{route('game.create')}}" class="text-xl font-semibold">
        New game
    </a>
</div>

<div class="container mx-auto">
    <h1 class="text-xl my-10">Games</h1>
    @foreach ($games as $game)
        <div class="bg-red-100 p-5">
            <a href="{{route('game.show', $game->id)}}">{{$game->id}}</a>
        </div>
    @endforeach
</div>

@endsection
