<?php

namespace App\Providers;

use App\Http\ViewComposers\FavoriteCountViewComposer;
use App\Services\FavouritesService;
use App\Services\Pokemon\PokemonApiService;
use App\Services\PokemonApiInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PokemonApiInterface::class, PokemonApiService::class);

        $this->app->singleton('favourites', function () {
            return new FavouritesService();
        });

        View::composer(
            ['layouts.app'],
            FavoriteCountViewComposer::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
