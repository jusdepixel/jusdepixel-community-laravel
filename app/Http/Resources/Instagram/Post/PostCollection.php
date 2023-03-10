<?php

namespace App\Http\Resources\Instagram\Post;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    public $collects = PostResource::class;
    public static $wrap = 'posts';

    public function toArray($request): array
    {
        return [
            'data' => $this->collection
                ->sortByDesc('created_at')
                ->values()
                ->all(),
            'count' => $this->count(),
            'links' => [
                'self' => url('/api/posts')
            ],
        ];
    }
}
