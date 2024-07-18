@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @include('pokemons._partials.search')

        <div class="mb-3">
            <a href="{{ route('pokemons.index') }}" class="btn btn-secondary">{{ __('Wróć do listy') }}</a>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h1>{{ $pokemon['name'] }}</h1>
                <img src="{{ $pokemon['sprites']['front_default'] }}" alt="{{ $pokemon['name'] }}" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3>{{ __('Statystyki') }}</h3>
                <ul class="list-group">
                    <li class="list-group-item">HP: {{ $pokemon['stats'][0]['base_stat'] }}</li>
                    <li class="list-group-item">Atak: {{ $pokemon['stats'][1]['base_stat'] }}</li>
                    <li class="list-group-item">Obrona: {{ $pokemon['stats'][2]['base_stat'] }}</li>
                    <li class="list-group-item">Szybkość: {{ $pokemon['stats'][5]['base_stat'] }}</li>
                </ul>
                <form method="POST" action="{{ route('pokemons.favorite', ['name' => $pokemon['name']]) }}" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        {{ in_array($pokemon['name'], $favorites) ? __('Usuń z ulubionych') : __('Dodaj do ulubionych') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
