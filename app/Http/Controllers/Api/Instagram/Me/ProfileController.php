<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Instagram\Me;

use App\Http\Resources\Instagram\User\UserResource;
use App\Instagram\Controller;
use App\Models\Instagram\InstagramUser;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

final class ProfileController extends Controller
{
    public function __invoke(): Response
    {
        $cacheKey = "my-profile-" . self::$instagram::getProfile()->instagramId;

        if (!Cache::has($cacheKey)) {
            Cache::add($cacheKey, new UserResource(InstagramUser::query()
                ->where(['instagram_id' => self::$instagram::getProfile()->instagramId])
                ->first()));
        }

        return response(Cache::get($cacheKey));
    }
}
