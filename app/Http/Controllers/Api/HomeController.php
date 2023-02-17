<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\InstagramPostCollection;
use App\Instagram\Controller as InstagramController;
use App\Models\InstagramPost;

class HomeController extends InstagramController
{
    public function __invoke(): InstagramPostCollection
    {
        return new InstagramPostCollection(
            InstagramPost::with('user')->get()
        );
    }
}
