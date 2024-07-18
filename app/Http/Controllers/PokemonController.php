<?php

namespace App\Http\Controllers;

use App\Exceptions\PokemonApiException;
use App\Facades\FavouritesFacade;
use App\Services\PokemonApiInterface;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    protected $pokemonApiService;

    public function __construct(PokemonApiInterface $pokemonApiService)
    {
        $this->pokemonApiService = $pokemonApiService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        try {
            $data = $this->pokemonApiService->list($request, 100);
            return view('pokemons.index', $data);

        } catch (PokemonApiException $e) {
            return back()->withError('Failed to fetch Pokemon details. Please try again later.');
        }
    }

    /**
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show(Request$request, $name)
    {
        $favorites = FavouritesFacade::all();

        try {
            $pokemon = $this->pokemonApiService->details($name);
            return view('pokemons.show', compact('pokemon', 'favorites'));

        } catch (PokemonApiException $e) {
            return back()->withError('Failed to fetch Pokemon details. Please try again later.');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function favorite(Request $request, $name)
    {
        $favoritesCookie = FavouritesFacade::toggle($name);

        return redirect()->back()->withCookie($favoritesCookie);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function favorites(Request $request)
    {
        $favorites = FavouritesFacade::all();

        foreach ($favorites as $name) {
            $pokemons[] = $this->pokemonApiService->details($name);
        }

        return view('pokemons.favorites', ['pokemons' => $pokemons]);
    }
}
