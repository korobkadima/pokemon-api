<form method="GET" action="{{ route('pokemons.index') }}" class="form-inline mb-4 d-flex align-items-start">
    <div class="form-group mr-2 flex-grow-1">
        <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
    </div>
    <button type="submit" class="btn btn-primary ml-2">Search</button>
</form>
