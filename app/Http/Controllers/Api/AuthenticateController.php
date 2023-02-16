<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Instagram\Controller as InstagramController;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class AuthenticateController extends InstagramController
{
    public function __invoke(): JsonResponse
    {
        if ($this->request->get('code') === null) {
            return response()->json([
                'message' => 'Le code n\'a pas été fourni par instagram, ou est déjà utilisé.'
            ], 422);
        }

        $profile = $this->instagram->authenticate($this->request->get('code'));

        if ($profile instanceof GuzzleException) {
            return response()->json([
                "message" => $profile->getMessage(),
            ], $profile->getCode());
        }

        return response()->json($profile, 200);
    }
}
