<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\InstagramPostCollection;
use App\Http\Resources\InstagramPostResource;
use App\Instagram\Controller as InstagramController;
use App\Models\InstagramPost;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HomeController extends InstagramController
{
    public function __invoke(): InstagramPostCollection
    {
        return new InstagramPostCollection(
            InstagramPost::with('user')->get()
        );
    }
}
