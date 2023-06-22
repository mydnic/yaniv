<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body class="antialiased">
        <nav class="flex justify-center space-x-3 bg-white border-b shadow-sm">
            <a href="/" class="px-5 py-3 hover:bg-indigo-500 hover:text-white">
                Home
            </a>
            <a href="{{route('game.index')}}" class="px-5 py-3 hover:bg-indigo-500 hover:text-white">
                Parties
            </a>
            <a href="{{route('player.index')}}" class="px-5 py-3 hover:bg-indigo-500 hover:text-white">
                Joueurs
            </a>
        </nav>

        @yield('content')
    </body>
</html>
