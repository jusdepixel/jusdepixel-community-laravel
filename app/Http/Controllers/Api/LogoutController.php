<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Instagram\Controller as InstagramController;

class LogoutController extends InstagramController
{
    public function __invoke(): object
    {
        $this->instagram->logout();

        return $this->instagram->getProfile();
    }
}
