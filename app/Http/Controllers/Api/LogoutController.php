<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Instagram\Controller as InstagramController;
use Illuminate\Http\JsonResponse;

class LogoutController extends InstagramController
{
    public function __invoke(): JsonResponse
    {
        $this->instagram->logout();

        return response()->json($this->instagram->getProfile(), 200);
    }
}
