<?php

namespace App\Http\Controllers\Api\Instagram\Users;

use App\Http\Resources\Instagram\User\UserCollection;
use App\Models\Instagram\InstagramUser;

class AllController
{
    public function __invoke(): UserCollection
    {
        return new UserCollection(InstagramUser::all());
    }
}
