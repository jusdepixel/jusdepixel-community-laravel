<?php

declare(strict_types=1);

namespace App\Instagram;

use GuzzleHttp\Exception\GuzzleException;

class Authenticate extends Initialize
{
    public string $code;

    public function authenticate(?string $code): int|array|bool|GuzzleException
    {
        if (!isset($code)) {
            return 204;
        }

        $token = $this->setCode($code)->requestToken();
        if ($token instanceof GuzzleException) {
            return $token;
        }

        return $this->requestProfile();
    }

    public function requestAuthorizeUrl(): string
    {
        return
            self::AUTHORIZE_URL .
            "?client_id=$this->clientId&redirect_uri=$this->redirectUri&scope=user_profile,user_media&response_type=code"
            ;
    }

    public function requestToken(): bool|GuzzleException
    {
        try {
            $params = [
                'form_params' => [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => $this->redirectUri,
                    'code' => $this->code
                ]
            ];

            $response = $this->clientGuzzle->request('POST', self::TOKEN_URL, $params);
            $result = json_decode($response->getBody()->getContents());

            $this->setSession([
                'isAuthenticated' => true,
                'socialId' => $result->user_id,
                'accessToken' => $result->access_token
            ]);
            return true;

        } catch (GuzzleException $e) {
            return $e;
        }
    }

    public function requestProfile(): array|GuzzleException
    {
        try {
            $params = [
                'query' => [
                    'access_token' => $this->getSession()->accessToken,
                    'fields' => 'account_type,media_count,username'
                ]
            ];

            $response = $this->clientGuzzle->request(
                'GET',
                self::GRAPH_URL . $this->getSession()->socialId,
                $params
            );

            $profile = json_decode($response->getBody()->getContents());

            $session = [
                'isAuthenticated' => $this->getSession()->isAuthenticated,
                'socialId' => $this->getSession()->socialId,
                'accessToken' => $this->getSession()->accessToken,
                'accountType' => $profile->account_type,
                'mediaCount' => $profile->media_count,
                'username' => $profile->username,
            ];
            $this->setSession($session);
            return $session;

        } catch (GuzzleException $e) {
            return $e;
        }
    }

    public function logout(): void
    {
        $this->forgetSession();
    }

    public function setCode(?string $code): self
    {
        $this->code = str_replace('#_', '', $code);
        return $this;
    }
}
