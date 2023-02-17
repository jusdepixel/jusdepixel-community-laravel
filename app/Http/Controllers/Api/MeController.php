<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Exceptions\InstagramException;
use App\Instagram\Controller as InstagramController;
use App\Models\InstagramPost;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;

class MeController extends InstagramController
{
    public function __invoke(): array|Response
    {
        $posts =  $this->instagram->getPosts();

        if ($posts instanceof GuzzleException) {
            return (new InstagramException())->render($posts, $this->instagram);
        }

        $sharedPosts = $this->getSharedPosts();

        $map = function ($post) use ($sharedPosts) {
            $post->isShared = in_array($post->id, $sharedPosts);
            return $post;
        };

        return array_map($map, $posts);
    }

    private function getSharedPosts(): array
    {
        $sharedPosts = [];

        $posts = InstagramPost::query()
            ->select('media_id')
            ->where('ig_id', $this->instagram->getSession()->igId)
            ->get();

        if ($posts) {
            foreach ($posts as $post) {
                $sharedPosts[$post->media_id] = $post->media_id;
            }
        }

        return $sharedPosts;
    }
}
