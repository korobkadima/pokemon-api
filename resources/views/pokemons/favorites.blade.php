@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @include('pokemons._partials.search')

        <h1>{{ __('Ulubione Pokemony') }}</h1>

        <ul class="list-group">
            @foreach ($pokemons as $pokemon)
                <li class="list-group-item">
                    <a href="{{ route('pokemons.show', ['name' => $pokemon['name']]) }}">{{ $pokemon['name'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

