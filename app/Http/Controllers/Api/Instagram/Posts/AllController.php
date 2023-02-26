<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Instagram\Posts;

use App\Http\Resources\Instagram\Post\PostCollection;
use App\Models\Instagram\InstagramPost;

final class AllController
{
    public function __invoke(): PostCollection
    {
        return new PostCollection(
            InstagramPost::query()->with('author')->get()
        );
    }
}
