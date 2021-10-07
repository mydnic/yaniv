<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'GameController@index');
Route::resource('game', 'GameController');
Route::resource('player', 'PlayerController');
Route::resource('game.round', 'Game\RoundController');
