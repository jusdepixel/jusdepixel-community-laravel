<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Instagram\Me;

use App\Http\Resources\Instagram\User\UserResource;
use App\Instagram\Controller;
use App\Models\Instagram\InstagramUser;
use Illuminate\Http\Response;

final class ProfileController extends Controller
{
    public function __invoke(): Response
    {
        return response(
            new UserResource(InstagramUser::query()
                ->where(['instagram_id' => self::$instagram::getProfile()->instagramId])
                ->first()
            )
        );
    }
}
