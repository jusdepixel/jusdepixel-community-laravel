<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Instagram\Me;

use App\Models\Instagram\InstagramPost;
use Illuminate\Http\Response;

final class PostDeleteController
{
    public function __invoke(InstagramPost $post): Response
    {
        $post->delete();

        return response([
            'message' => 'Post has been deleted',
        ], 204);
    }
}
