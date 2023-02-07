<?php

declare(strict_types=1);

namespace App\Instagram;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Initialize
{
    protected const AUTHORIZE_URL = 'https://api.instagram.com/oauth/authorize';
    protected const TOKEN_URL = 'https://api.instagram.com/oauth/access_token';
    protected const GRAPH_URL = "https://graph.instagram.com/";
    protected const MEDIAS_URI = "/me/media";

    protected Request $request;
    protected Client $clientGuzzle;
    protected string $clientId;
    protected string $redirectUri;
    protected string $clientSecret;

    public function __construct()
    {
        if ($this->getSession() === null) {
            $this->setSession([
                'isAuthenticated' => false,
                'socialId' => null,
                'accessToken' => null,
                'accountType' => null,
                'mediaCount' => null,
                'username' => 'Anonymous'
            ]);
        }
    }

    public function initialize(): void
    {
        $this->clientId = config('instagram.client_id');
        $this->clientSecret = config('instagram.client_secret');
        $this->redirectUri = config('instagram.request_uri');

        $this
            ->setClientGuzzle()
            ->getSession();
    }

    private function setClientGuzzle(): self
    {
        $this->clientGuzzle = new Client();
        return $this;
    }

    protected function setSession(array $session): void
    {
       Session::put('social_network', json_encode($session));
    }

    protected function getSession(): ?object
    {
        if (Session::get('social_network')) {
            return json_decode(Session::get('social_network'));
        }

        return null;
    }

    protected function forgetSession(): void
    {
        Session::forget('social_network');
    }
}
