<?php

declare(strict_types=1);

namespace App\Instagram;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

final class Instagram extends Authenticate
{
    public function getPosts(): array|GuzzleException
    {
        $key = 'posts-' . $this->getProfile()->igId;

        if(!Cache::has($key)) {
            try {
                $params = [
                    'query' => [
                        'access_token' => $this->getProfile()->accessToken,
                        'fields' => 'caption,id,media_type,media_url,thumbnail_url,permalink,username,timestamp'
                    ]
                ];

                $response = $this->clientGuzzle->request(
                    'GET',
                    self::GRAPH_URL . self::MEDIAS_URI,
                    $params
                );

                Cache::put($key, json_encode((json_decode( $response->getBody()->getContents()))->data));

            } catch (GuzzleException $e) {
                return $e;
            }
        }

        return json_decode(Cache::get($key));
    }

    public function getPost(int $id): object
    {
        $key = 'post-' . $id;

        if(!Cache::has($key)) {
            try {
                $params = [
                    'query' => [
                        'access_token' => $this->getProfile()->accessToken,
                        'fields' => 'caption,id,media_type,media_url,thumbnail_url,permalink,username,timestamp'
                    ]
                ];

                $response = $this->clientGuzzle->request('GET', self::GRAPH_URL . $id, $params);
                Cache::put($key, $response->getBody()->getContents());

            } catch (GuzzleException $e) {
                return $e;
            }
        }

        return json_decode(Cache::get($key));
    }
}
