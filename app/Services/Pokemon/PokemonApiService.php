<?php

namespace App\Services\Pokemon;

use App\Services\PokemonApiInterface;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PokemonApiService implements PokemonApiInterface
{
    protected $client;

    const API_URL = 'https://pokeapi.co/api/v2/';
    const CACHE_POKEMON = 'pokemon_';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::API_URL,
        ]);
    }

    /**
     * @param Request $request
     * @param $limit
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(Request $request, $limit = 100): array
    {
        $search = $request->input('search');
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $limit;

        $response = $this->client->get('pokemon', [
            'query' => [
                'limit' => $limit,
                'offset' => $offset,
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        // TODO: Check if API has parameter for search by name
        if ($search) {
            $data['results'] = array_filter($data['results'], function ($row) use ($search) {
                return stripos($row['name'], $search) !== false;
            });
        }

        return [
            'pokemons' => $data['results'],
            'page'     => $page,
            'limit'    => $limit,
            'total'    => $search ? count($data['results']) : $data['count'],
            'search'   => $search,
        ];
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function details($name = ''): array
    {
        return Cache::remember(self::CACHE_POKEMON . $name, 60*60, function() use ($name) {
            $response = $this->client->get('pokemon/' . $name);
            return json_decode($response->getBody()->getContents(), true);
        });
    }
}
