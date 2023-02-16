<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Instagram\Controller as InstagramController;
use App\Models\InstagramPost;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class PostController extends InstagramController
{
    public function create(int $id): JsonResponse
    {
        $post = $this->instagram->getPost($id);

        if ($post instanceof GuzzleException) {
            return response()->json([
                'message' => $post->getMessage()
            ], $post->getCode());
        }

        InstagramPost::factory()->create([
            'ig_id' => $this->instagram->getSession()->igId,
            'caption' => $post->caption ?? "",
            'permalink' => $post->permalink,
            'media_id' => $post->id,
            'media_type' => $post->media_type,
            'media_url' => $post->media_url,
            'thumbnail_url' => $post->thumbnail_url ?? "",
            'timestamp' => $post->timestamp
        ]);

        (new UserController($this->instagram, $this->request))->create();

        return response()->json([
            'message' => 'Le post est maintenant partagé.'
        ], 200);
    }

    public function delete(int $id): JsonResponse
    {
        InstagramPost::query()
            ->where('media_id', $id)
            ->delete();

        return response()->json([
            'message' => 'Le post n\'est plus partagé.'
        ], 200);
    }
}
