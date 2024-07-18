<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class FavouritesFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'favourites';
    }
}
