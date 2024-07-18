<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PokemonController;

Route::get('/', [PokemonController::class, 'index'])->name('pokemons.index');
Route::group(['prefix' => 'pokemons'], function () {
    Route::get('/{name}', [PokemonController::class, 'show'])->name('pokemons.show');
    Route::post('/{name}/favorite', [PokemonController::class, 'favorite'])->name('pokemons.favorite');
});
Route::get('/favorites', [PokemonController::class, 'favorites'])->name('pokemons.favorites');

Auth::routes();
