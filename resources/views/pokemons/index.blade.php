@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @include('pokemons._partials.search')

        <ul class="list-group">
            @foreach ($pokemons as $pokemon)
                <li class="list-group-item">
                    <a href="{{ route('pokemons.show', ['name' => $pokemon['name']]) }}">{{ $pokemon['name'] }}</a>
                </li>
            @endforeach
        </ul>

        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                @for ($i = 1; $i <= ceil($total / $limit); $i++)
                    <li class="page-item{{ $i == request('page', 1) ? ' active' : '' }}">
                        <a class="page-link" href="{{ route('pokemons.index', ['page' => $i, 'search' => request('search')]) }}">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </nav>
    </div>
@endsection
