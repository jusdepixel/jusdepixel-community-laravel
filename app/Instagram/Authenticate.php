<?php

declare(strict_types=1);

namespace App\Instagram;

use GuzzleHttp\Exception\GuzzleException;

class Authenticate extends Initialize
{
    private string $code;

    public function authenticate(string $code): void
    {
        $this
            ->setCode($code)
            ->requestToken()
            ->requestProfile()
        ;
    }

    /**
     * @throws GuzzleException
     */
    public function requestToken(): self
    {
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

        return $this;
    }

    /**
     * @throws GuzzleException
     */
    private function requestProfile(): void
    {
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

        $this->setSession([
            'isAuthenticated' => $this->getSession()->isAuthenticated,
            'socialId' => $this->getSession()->socialId,
            'accessToken' => $this->getSession()->accessToken,
            'accountType' => $profile->account_type,
            'mediaCount' => $profile->media_count,
            'username' => $profile->username,
        ]);
    }

    public function logout(): void
    {
        $this->request->session()->forget('social_network');
    }

    private function setCode(string $code): self
    {
        $this->code = str_replace('#_', '', $code);
        return $this;
    }
}
