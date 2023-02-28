<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Instagram\Auth;

use App\Instagram\Controller;

final class LogoutController extends Controller
{
    public function __invoke(): array
    {
        $userName = self::$instagram::getProfile()->userName;
        self::$instagram::logout();

        return [
            'message' => $userName . ' got disconnected from Instagram',
            'profile' => self::$instagram::getProfile(),
        ];
    }
}
