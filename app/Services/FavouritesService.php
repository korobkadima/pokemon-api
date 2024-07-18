<?php

namespace App\Services;

class FavouritesService
{
    const FAVOURITE_KEY = 'favourites';
    const TIME = 60 * 24 * 30;

    /**
     * @param $name
     * @return \Illuminate\Cookie\CookieJar|\Illuminate\Foundation\Application|\Symfony\Component\HttpFoundation\Cookie
     */
    public function toggle($name)
    {
        $favorites = $this->getAll();

        if (in_array($name, $favorites)) {
            $favorites = array_diff($favorites, [$name]);
        } else {
            $favorites[] = $name;
        }

        return cookie(self::FAVOURITE_KEY, json_encode($favorites), self::TIME);
    }

    public function all()
    {
        return $this->getAll();
    }

    private function getAll()
    {
        return json_decode(request()->cookie(self::FAVOURITE_KEY, '[]'), true);
    }
}
