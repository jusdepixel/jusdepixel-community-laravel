<?php

declare(strict_types=1);

namespace App\Instagram;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class Initialize
{
    protected const AUTHORIZE_URL = 'https://api.instagram.com/oauth/authorize';
    protected const TOKEN_URL = 'https://api.instagram.com/oauth/access_token';
    protected const GRAPH_URL = "https://graph.instagram.com/";
    protected const MEDIAS_URI = "me/media";

    protected Client $clientGuzzle;
    protected string $clientId;
    protected string $redirectUri;
    protected string $clientSecret;
    protected array $session = [
        'isAuthenticated' => false,
        'igId' => null,
        'accessToken' => null,
        'accountType' => null,
        'mediaCount' => null,
        'username' => 'Anonymous'
    ];

    public function __construct()
    {
        if ($this->getSession() === null) {
            $this->setSession($this->session);
        }
    }

    public function initialize(): self
    {
        $this->clientId = config('instagram.client_id');
        $this->clientSecret = config('instagram.client_secret');
        $this->redirectUri = config('instagram.request_uri');

        $this
            ->setClientGuzzle()
            ->getSession();

        return $this;
    }

    private function setClientGuzzle(): self
    {
        $this->clientGuzzle = new Client();
        return $this;
    }

    public function setSession(array $session): void
    {
       Session::put('social_network', json_encode($session));
    }

    public function getSession(): ?object
    {
        if (Session::get('social_network')) {
            return json_decode(Session::get('social_network'));
        }

        return null;
    }

    protected function forgetSession(): void
    {
        Session::forget('social_network');

        $this->setSession($this->session);
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @required by tests
     */

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientGuzzle(): Client
    {
        return $this->clientGuzzle;
    }


    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }
}
