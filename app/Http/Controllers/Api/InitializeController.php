<?php

namespace App\Http\Controllers\Api;

use App\Instagram\Controller as InstagramController;

class InitializeController extends InstagramController
{
    public function profile(): object
    {
        unset ($this->profile->accessToken);

        return $this->profile;
    }
    public function url(): string
    {
        return $this->authorizeUrl;
    }
}
