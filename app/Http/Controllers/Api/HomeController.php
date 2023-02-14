<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Instagram\Controller as InstagramController;
use App\Models\InstagramPost;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class HomeController extends InstagramController
{
    public function process(): JsonResponse
    {
        $posts = InstagramPost::orderBy('created_at DESC')
            ->take(12)
            ->get();

        if ($posts instanceof ModelNotFoundException) {
            return response()->json([
                'message' => $posts->getMessage()
            ], $posts->getCode());
        }

        return response()->json($posts, 200);
    }
}
