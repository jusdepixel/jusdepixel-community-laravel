<?php

namespace App\Actions;

use App\Instagram\Auth;
use App\Models\Instagram\InstagramUser;
use Exception;
use Illuminate\Database\Eloquent\Model;

final readonly class UserCreateAction
{
    public function __construct(
        private Auth $auth
    ) {}

    /**
     * @throws Exception
     */
    public function getUserInstagram(): null|object
    {
        return InstagramUser::query()
            ->where(['instagram_id' => $this->auth::getProfile()->instagramId])
            ->first();
    }

    /**
     * @throws Exception
     */
    public function setUser(): void
    {
        $user = $this->getUserInstagram();

        if (is_null($user)) {
            $user = $this->createUser();
        }

        $this->auth::setProfile([
            'accessToken' => $user->__get('access_token'),
            'userId' => getenv('APP_ENV') === 'testing' ? 'bac04411-0000-4cd2-b9d9-06ad4f9c1c62' : $user->id,
        ]);
    }

    /**
     * @throws Exception
     */
    private function createUser(): Model
    {
        $tokenInfos = $this->auth::requestLongLifeToken();

        return InstagramUser::query()->create([
            'instagram_id' => $this->auth::getProfile()->instagramId,
            'username' => $this->auth::getProfile()->userName,
            'media_count' => $this->auth::getProfile()->mediaCount,
            'access_token' => $tokenInfos['accessToken'],
            'token_type' => $tokenInfos['tokenType'],
            'expires_in' => $tokenInfos['expiresIn'],
            'updated_time' => time(),
        ]);
    }
}
