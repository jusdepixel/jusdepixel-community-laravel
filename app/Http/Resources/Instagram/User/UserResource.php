<?php

namespace App\Http\Resources\Instagram\User;

use App\Http\Resources\Instagram\Post\PostCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = 'user';

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'instagram_id' => $this->instagram_id,
            'username' => $this->username,
            'media_count' => $this->media_count,
            'access_token' => $this->access_token,
            'token_type' => $this->token_type,
            'expires_in' => $this->expires_in,
            'updated_time' => $this->updated_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'expires_days' => $this->expires($this->expires_in, $this->updated_time),
            'posts' => new PostCollection($this->whenLoaded('posts'))
        ];
    }

    private function expires($expires_in, $updated_time): int
    {
        $expiresAt = $expires_in + $updated_time;
        $diff = $expiresAt - time();

        return (int) round($diff / 86400);
    }
}
