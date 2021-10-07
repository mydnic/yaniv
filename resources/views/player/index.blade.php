@extends('app')

@section('content')

<div class="container px-2 py-6 mx-auto md:px-0">
    <div class="flex items-center justify-between">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Joueurs
            </h1>
        </div>
        <div class="flex">
            <a href="{{route('player.create')}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Ajouter un joueur
            </a>
        </div>
    </div>


    <table class="table-default">
        <thead>
            <tr>
                <th>Nom</th>
                <th class="hidden md:table-cell">Nombre de manches jouées</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($players as $player)
                <tr>
                    <td>
                        {{$player->name}}
                    </td>
                    <td class="hidden md:table-cell">
                        {{ $player->games->count() }}
                    </td>
                    <td class="text-right">
                        <a href="{{route('player.edit', $player)}}" class="text-indigo-600 hover:text-indigo-900">
                            Modifier
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
