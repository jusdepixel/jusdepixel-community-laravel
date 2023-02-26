<?php

namespace App\Http\Resources\Instagram\Me;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MePostCollection extends ResourceCollection
{
    public $collects = MePostResource::class;

    public static $wrap = 'posts';

    public function toArray($request): array
    {
        return [
            'data' => $this->collection->all(),
            'count' => $this->count(),
            'links' => [
                'self' => url('/api/me/posts')
            ],
        ];
    }
}
