<?php

declare(strict_types=1);

namespace App\Instagram;

use GuzzleHttp\Exception\GuzzleException;

final class Instagram extends Authenticate
{
    public function getProfile(): object
    {
        return $this->getSession();
    }

    public function getPosts(): array|GuzzleException
    {
        try {
            $params = [
                'query' => [
                    'access_token' => $this->getSession()->accessToken,
                    'fields' => 'id,media_type,media_url,username,timestamp'
                ]
            ];

            $response = $this->clientGuzzle->request('GET', self::GRAPH_URL . self::MEDIAS_URI, $params);
            return json_decode($response->getBody()->getContents())->data;

        } catch (GuzzleException $e) {
            return $e;
        }
    }
    public function getPost(int $id): object
    {
        try {
            $params = [
                'query' => [
                    'access_token' => $this->getSession()->accessToken,
                    'fields' => 'id,media_type,media_url,username,timestamp'
                ]
            ];

            $response = $this->clientGuzzle->request(
                'GET',
                self::GRAPH_URL . $id, $params
            );
            return json_decode($response->getBody()->getContents());

        } catch (GuzzleException $e) {
            return $e;
        }
    }
}
