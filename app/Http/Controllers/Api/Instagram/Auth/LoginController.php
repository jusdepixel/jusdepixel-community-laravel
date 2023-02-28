<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Instagram\Auth;

use App\Actions\Instagram\UserCacheAction;
use App\Exceptions\InstagramException;
use App\Instagram\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

final class LoginController extends Controller
{
    public function __invoke(string $code): array|Response
    {
        try {
            $profile = self::$instagram::login($code);

            new UserCacheAction();

            return [
                'messsage' => $profile->userName . ' is connected to Instagram',
                'profile' => $profile
            ];
        } catch (\Exception $e) {
            return (new InstagramException())->render($e);
        }
    }
}
