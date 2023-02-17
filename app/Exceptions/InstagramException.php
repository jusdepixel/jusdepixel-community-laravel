<?php

namespace App\Exceptions;

use App\Instagram\Instagram;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class InstagramException extends Exception
{
    public function report(): ?bool
    {
        return false;
    }

    public function render(GuzzleException $response, Instagram $instagram): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    {
        switch($response->getCode()) {
            case 400:
                $instagram->logout();
                return response([
                    'message' => 'Session Instagram expirée, veuillez vous connecter.',
                    'profile' => $instagram->getProfile()
                ], $response->getCode());

            case 403:
                return response([
                    'message' => 'Plafond d\'utilisation de l\'API Instagram atteint, veuillez patienter.'
                ], $response->getCode());

            default:
                return response([
                    'message' => $response->getMessage()
                ], $response->getCode());
        }

    }
}
