<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Instagram\Posts;

use App\Exceptions\InstagramException;
use App\Http\Resources\Instagram\Post\PostResource;
use App\Models\Instagram\InstagramPost;
use Exception;
use Illuminate\Http\Response;

final class OneController
{
    public function __invoke(string $id): Response|PostResource
    {
        $post = new PostResource(
            InstagramPost::query()->with('author')->find($id)
        );

        if ($post) {
            return $post;
        } else {
            return (new InstagramException())->render(
                new Exception("This post does not exist or no longer exists", 404)
            );
        }
    }
}
