<?php

namespace App\Http\Resources\Instagram\Post;

use App\Http\Resources\Instagram\Author\AuthorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public static $wrap = 'post';

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'instagram_id' => $this->instagram_id,
            'author' => new AuthorResource($this->whenLoaded('author')),
            'caption' => $this->caption,
            'permalink' => $this->permalink,
            'timestamp' => $this->timestamp,
            'media_type' => $this->media_type,
            'media_url' => $this->media_url,
            'thumbnail_url' => $this->thumbnail_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
