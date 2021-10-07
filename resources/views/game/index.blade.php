@extends('app')

@section('content')
<div class="container px-2 py-6 mx-auto md:px-0">
    <div class="py-4 md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Parties
            </h1>
        </div>
        <div class="flex mt-4 md:mt-0 md:ml-4">
            <a href="{{route('game.create')}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Commencer une nouvelle partie
            </a>
        </div>
    </div>

    <table class="table-default">
        <thead>
            <tr>
                <th>Numéro</th>
                <th class="hidden md:table-cell">Nombre de rounds joués</th>
                <th class="hidden md:table-cell">Gagnant</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($games as $game)
                <tr>
                    <td>
                        {{$game->id}}
                    </td>
                    <td class="hidden md:table-cell">
                        {{ $game->rounds->count() }}
                    </td>
                    <td class="hidden md:table-cell">
                        {{ optional($game->winner)->name ?? '/' }}
                    </td>
                    <td class="text-right">
                        <a href="{{route('game.show', $game)}}" class="text-indigo-600 hover:text-indigo-900">
                            Détails
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

