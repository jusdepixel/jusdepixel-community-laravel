<?php

namespace App\Http\Controllers\Api\Instagram\Users;

use App\Exceptions\InstagramException;
use App\Http\Resources\Instagram\User\UserResource;
use App\Models\Instagram\InstagramUser;
use Exception;
use Illuminate\Http\Response;

class OneController
{
    public function __invoke(string $id): UserResource|Response
    {
        $user = InstagramUser::query()->with('posts')->find($id);

        if ($user) {
            return new UserResource($user);
        } else {
            return (new InstagramException())->render(
                new Exception("This user does not exist or no longer exists", 404)
            );
        }
    }
}
