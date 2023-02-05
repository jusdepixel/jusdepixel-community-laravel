<?php

declare(strict_types=1);

namespace App\SocialNetwork;

use App\Http\Interface\SocialNetworkInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Instagram extends SocialNetwork implements SocialNetworkInterface
{
    private const AUTHORIZE_URL = 'https://api.instagram.com/oauth/authorize';
    private const TOKEN_URL = 'https://api.instagram.com/oauth/access_token';
    private const GRAPH_URL = "https://graph.instagram.com/";
    private const MEDIAS_URI = "/me/media";

    private string $clientId;
    private string $clientSecret;
    private string $redirectUri;
    private Client $clientGuzzle;
    private string $code;

    public function initialize(): void
    {
        $this->clientId = config('instagram.client_id');
        $this->clientSecret = config('instagram.client_secret');
        $this->redirectUri = config('instagram.request_uri');

        $this
            ->setClientGuzzle()
            ->getSession()
        ;
    }

    public function authenticate(?string $code): void
    {
        $this
            ->setCode($code)
            ->requestToken()
        ;
    }

    public function requestToken(): self
    {
        $params = [
            'form_params' => [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->redirectUri,
                'code' => str_replace('#_', '', $this->code)
            ]
        ];

        try {
            $response = $this->clientGuzzle->request('POST', self::TOKEN_URL, $params);
            $result = json_decode($response->getBody()->getContents());

            $this->setSession([
                'isAuthenticated' => true,
                'socialId' => $result->user_id,
                'token' => $result->access_token
            ]);
        } catch (GuzzleException $e) {
            dd([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }

        return $this;
    }

    public function getAuthorizeUrl(): string
    {
        return
            self::AUTHORIZE_URL . "?client_id=$this->clientId&redirect_uri=$this->redirectUri&scope=user_profile,user_media&response_type=code"
        ;
    }

    public function isAuthenticated(): bool
    {
        return $this->getSession()->isAuthenticated;
    }

    public function getSocialId(): ?int
    {
        return $this->getSession()->socialId;
    }

    public function getToken(): string
    {
        return $this->getSession()->token;
    }

    private function setClientGuzzle(): self
    {
        $this->clientGuzzle = new Client();
        return $this;
    }

    private function setCode(string $code): self
    {
        $this->code = str_replace('#_', '', $code);
        return $this;
    }
}
