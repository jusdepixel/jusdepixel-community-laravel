<?php

namespace App\Http\Resources\Instagram\Me;

use App\Instagram\Auth;
use App\Models\Instagram\InstagramPost;
use Illuminate\Http\Resources\Json\JsonResource;

class MePostResource extends JsonResource
{
    public static $wrap = 'post';

    public function toArray($request): array
    {
        $post = InstagramPost::query()->select('id')->where('instagram_id', $this->id)->first();

        return [
            'id' => $post?->id,
            'caption' => $this->caption,
            'instagram_id' => $this->id,
            'instagram_user_id' => (new Auth())::getProfile()->userId,
            'media_type' => $this->media_type,
            'media_url' => $this->media_url,
            'permalink' => $this->permalink,
            'username' => $this->username,
            'timestamp' => $this->timestamp,
        ];
    }
}
