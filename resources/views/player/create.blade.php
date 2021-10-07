@extends('app')

@section('content')

<div class="container px-2 py-6 mx-auto md:px-0">
    <form action="{{route('player.store')}}" method="post">
        @csrf

        <div>
            <label class="label" for="name">Nom du joueur</label>
            <input type="text" id="name" class="input" name="name" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn">
                Ajouter
            </button>
        </div>
    </form>
</div>

@endsection
