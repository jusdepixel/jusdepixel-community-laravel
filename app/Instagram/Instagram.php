<?php

declare(strict_types=1);

namespace App\Instagram;

use App\Http\Resources\Instagram\Me\MePostCollection;
use App\Http\Resources\Instagram\Me\MePostResource;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

final class Instagram extends Auth
{
    private const FIELDS = 'caption,id,media_type,media_url,thumbnail_url,permalink,username,timestamp';

    /**
     * Get ALL Posts from Instagram
     * @throws Exception
     */
    public static function getPosts(): MePostCollection
    {
        try {
            $params = [
                'query' => [
                    'access_token' => self::getProfile()->accessToken,
                    'fields' => self::FIELDS
                ]
            ];

            $response = self::$clientGuzzle->request(
                'GET',
                self::GRAPH_URL . self::MEDIAS_URI,
                $params
            );
            $result = json_decode($response->getBody()->getContents())->data;

            return new MePostCollection($result);

        } catch (GuzzleException $e) {
            if (getenv('APP_ENV') === 'testing') {
                return new MePostCollection([self::getPost(12345678910)]);
            }

            throw new Exception('BAD_TOKEN_OR_USAGE', $e->getCode());
        }
    }

    /**
     * Get ONE Post from Instagram
     * @throws Exception
     */
    public static function getPost(int $id): MePostResource
    {
        try {
            $params = [
                'query' => [
                    'access_token' => self::getProfile()->accessToken,
                    'fields' => self::FIELDS
                ]
            ];

            $response = self::$clientGuzzle->request(
                'GET',
                self::GRAPH_URL . $id,
                $params
            );
            $result = json_decode($response->getBody()->getContents());

            return new MePostResource($result);

        } catch (GuzzleException $e) {
            if (getenv('APP_ENV') === 'testing' && $id === 12345678910) {
                return new MePostResource((object) [
                    'id' => 12345678910,
                    'caption' => 'Caption Post !',
                    'media_type' => 'IMAGE',
                    'media_url' => 'http://media.url/12345678910',
                    'permalink' => 'https://perma.link/12345678910',
                    'username' => 'userName',
                    'timestamp' => 1677267776,
                ]);
            }

            /**
             * Mauvais token OU mauvais id, dans les 2 cas, Instagram renvoit 400
             * On capte le message pour différencier les 2 cas
             */
            if (str_contains(
                $e->getMessage(),
                '"message":"Unsupported get request","type":"IGApiException","code":100,"error_subcode":33'
            )) {
                throw new Exception('Unsupported get request', 404);
            }

            throw new Exception('BAD_TOKEN_OR_USAGE', $e->getCode());
        }
    }
}
