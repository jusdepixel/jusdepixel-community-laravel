<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Exceptions\InstagramException;
use App\Instagram\Controller as InstagramController;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;

class AuthenticateController extends InstagramController
{
    public function __invoke(): Response|array
    {
        $code = $this->request->get('code');

        if ($code === null) {
            return response([
                'message' => 'Le code n\'a pas été fourni par instagram, ou est déjà utilisé.'
            ], 422);
        }

        $profile = $this->instagram->authenticate($code);

        if ($profile instanceof GuzzleException) {
            return (new InstagramException())->render($profile, $this->instagram);
        }

        return $profile;
    }
}
