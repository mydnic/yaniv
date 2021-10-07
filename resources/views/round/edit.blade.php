@extends('app')

@section('content')

<div class="container px-2 py-6 mx-auto md:px-0">
    <form action="{{route('game.round.update', [$game, $round])}}" method="post">
        @csrf
        @method('put')

        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
            @foreach ($round->points as $point)
                <div>
                    <label class="label">{{ $point->player->name }}</label>
                    <input class="input" value="{{$point->points}}" type="number" placeholder="points" name="points[{{$point->id}}]" required>
                </div>
            @endforeach
        </div>

        <div class="mt-4 text-center">
            <button type="submit" class="btn">
                Sauvegarder
            </button>
        </div>
    </form>
</div>

@endsection
