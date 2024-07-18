<?php

namespace App\Services;

use Illuminate\Http\Request;

interface PokemonApiInterface
{
    public function list(Request $request): array;

    public function details($name = ''): array;
}
