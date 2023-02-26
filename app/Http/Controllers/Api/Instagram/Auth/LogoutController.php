<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Instagram\Auth;

use App\Instagram\Controller;

final class LogoutController extends Controller
{
    public function __invoke(): array
    {
        $profile = self::$instagram::getProfile();
        self::$instagram::logout();

        return [
            'message' => $profile->userName . ' got disconnected from Instagram',
            'profile' => self::$instagram::getProfile(), // On retourne le profil par défaut au front
        ];
    }
}
