<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InstagramPostCollection extends ResourceCollection
{
    public $collects = InstagramPostResource::class;

    public function toArray($request): array
    {
        return [
            'data' => $this->collection->sortByDesc('created_at')->values()->all(),
            'count' => $this->count(),
            'links' => [
                'self' => url('/home')
            ],
        ];
    }
}
