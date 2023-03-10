<?php

namespace App\Http\Resources\Instagram\User;

use App\Http\Resources\Instagram\Post\PostCollection;
use Carbon\Carbon;
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'expires_in_human' => $this->expiresInHuman($this->expires_in),
            'posts' => new PostCollection($this->whenLoaded('posts')),
        ];
    }

    private function expiresInHuman(int $expiresIn)
    {
        $startDate = Carbon::createFromTimestamp(time());
        $endDate = Carbon::createFromTimestamp(time() + $expiresIn);

        $days = $startDate->diffInDays($endDate);
        $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
        $minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);

        return "$days days, $hours hours and $minutes minutes";
    }
}
