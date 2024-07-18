<?php

namespace App\Http\ViewComposers;

use App\Facades\FavouritesFacade;
use Illuminate\View\View;

class FavoriteCountViewComposer
{
    public function compose(View $view)
    {
        $favorites = FavouritesFacade::all();

        $view->with('favoriteCount', count($favorites));
    }
}
