<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Instagram\Me;

use App\Exceptions\InstagramException;
use App\Http\Resources\Instagram\Post\PostResource;
use App\Instagram\Controller;
use App\Instagram\Instagram;
use App\Models\Instagram\InstagramPost;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class PostCreateController extends Controller
{
    public function __invoke(int $instagramId, Request $request): Response
    {
        try {
            $instagramPost = Instagram::getPost($instagramId);

            $result = InstagramPost::query()->create(
                $instagramPost->toArray($request)
            );

            return response([
                'message' => 'Post has been added',
                'post' => new PostResource($result)
            ], 201);

        } catch (\Exception $e) {

            if ($e instanceof QueryException &&
                $e->errorInfo[2] === 'UNIQUE constraint failed: instagram_posts.instagram_id'
            ) {
                return response([
                    'message' => 'Post already exists',
                    'post' => $instagramPost->toArray($request) // Défini car, existe déjà
                ], 201);
            }

            return (new InstagramException())->render($e);
        }
    }
}
