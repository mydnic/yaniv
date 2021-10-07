@extends('app')

@section('content')

<form action="{{route('player.store')}}" method="post">
    @csrf

    <input type="text" name="name" required>

    <button type="submit">
        Ajouter
    </button>
</form>

@endsection
