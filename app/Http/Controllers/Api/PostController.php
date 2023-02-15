<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Instagram\Controller as InstagramController;
use App\Models\InstagramPost;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

        try {
            InstagramPost::factory()->create([
                'ig_id' => $this->instagram->getSession()->igId,
                'media_id' => $post->id,
                'media_type' => $post->media_type,
                'media_url' => $post->media_url,
                'username' => $post->username,
                'timestamp' => $post->timestamp
            ]);

            try {
                (new UserController($this->instagram, $this->request))->create();

            } catch (ModelNotFoundException $e) {
                return response()->json([
                    'message' => $e->getMessage()
                ], $e->getCode());
            }

            return response()->json([
                'message' => 'Le post est maintenant partagé.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            InstagramPost::query()
                ->where('media_id', $id)
                ->delete();

            return response()->json([
                'message' => 'Le post n\'est plus partagé.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
