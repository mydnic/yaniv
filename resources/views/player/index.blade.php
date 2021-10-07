@extends('app')

@section('content')
<a href="{{route('player.create')}}">
    New Player
</a>

@foreach ($players as $player)
    <div>
        {{$player->name}}
    </div>
@endforeach

@endsection
