<?php

namespace App\Actions\Instagram;

use App\Instagram\Profile;
use App\Models\Instagram\InstagramPost;
use Illuminate\Support\Facades\Cache;

final readonly class UserCacheAction
{
    public function __construct()
    {
        $profile = new Profile();
        $id = $profile::getProfile()->instagramId;

        Cache::delete("my-posts-" . $id);
        Cache::delete("my-profile-" . $id);

        $postsUser = InstagramPost::query()
            ->select('instagram_id')
            ->where('instagram_user_id', $id)
            ->get();

        foreach ($postsUser as $postCacheToDelete) {
            Cache::delete("post-" . $postCacheToDelete->instagram_id);
        }
    }
}
