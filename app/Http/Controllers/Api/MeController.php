<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Instagram\Controller as InstagramController;
use App\Models\InstagramPost;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class MeController extends InstagramController
{
    public function process(): JsonResponse
    {
        $posts =  $this->instagram->getPosts();

        if ($posts instanceof GuzzleException) {
            switch($posts->getCode()) {
                case 400:
                    $this->instagram->logout();
                    return response()->json([
                        'message' => 'Session Instagram expirée, veuillez vous connecter.'
                    ], $posts->getCode());

                case 403:

                    return response()->json([
                        'message' => 'Plafond d\'utilisation de l\'API Instagram atteint, veuillez patienter.'
                    ], $posts->getCode());

                default:
                    return response()->json([
                        'message' => $posts->getMessage()
                    ], $posts->getCode());
            }

        }

        $sharedPosts = $this->getSharedPosts();

        $map = function ($post) use ($sharedPosts) {
            $post->isShared = in_array($post->id, $sharedPosts);
            return $post;
        };

        return response()->json(array_map($map, $posts), 200);
    }

    private function getSharedPosts(): array
    {
        $sharedPosts = [];

        $posts = InstagramPost::select('media_id')
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
