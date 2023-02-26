<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Instagram\Auth;

use App\Instagram\Controller;

final class ProfileController extends Controller
{
    public function __invoke(): array
    {
        return [
            'profile' => self::$instagram::getProfile()
        ];
    }
}
