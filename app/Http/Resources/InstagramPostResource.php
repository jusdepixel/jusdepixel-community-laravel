<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstagramPostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'ig_id' => $this->ig_id,
            'caption' => $this->caption,
            'permalink' => $this->permalink,
            'timestamp' => $this->timestamp,
            'media_id' => $this->media_id,
            'media_type' => $this->media_type,
            'media_url' => $this->media_url,
            'thumbnail_url' => $this->thumbnail_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new InstagramUserResource($this->whenLoaded('user'))
        ];
    }
}
