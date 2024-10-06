<?php

namespace App\Repository;

use Illuminate\Support\Facades\Auth;


class BaseRepository
{
    /**
     * Get a userId
     *
     * @return int
     */
    public function userId(): int
    {
        return Auth::user()->id;
    }

}