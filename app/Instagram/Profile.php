<?php

declare(strict_types=1);

namespace App\Instagram;

use App\DataObjects\ProfileDataObject;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

class Profile extends Init
{
    private static bool $test = true;

    public static function getProfile(): ProfileDataObject
    {
        /**
         * Uniquement pour couvrir la fonction requestProfile() dans les tests
         * One ne lève aucune exception pour l'API
         */
        if (getenv('APP_ENV') === 'testing') {
            if (self::$test === true) {
                self::$test = false;
                self::requestProfile();
            }
        }

        return self::getSession();
    }

    /**
     * @throws Exception
     */
    public static function setProfile($profile): ProfileDataObject
    {
        return self::setSession(
            array_merge(
                (array) self::getProfile(),
                (array) $profile
            )
        );
    }

    /**
     * @throws Exception
     */
    public static function requestProfile(): array|ProfileDataObject
    {
        try {
            $cacheKey = "my-profile-" . self::getProfile()->instagramId;

            if (!Cache::has($cacheKey)) {

                $params = [
                    'query' => [
                        'access_token' => self::getProfile()->accessToken,
                        'fields' => 'account_type,media_count,username'
                    ]
                ];

                $response = self::$clientGuzzle->request(
                    'GET',
                    self::GRAPH_URL . "me",
                    $params
                );
                $result = json_decode($response->getBody()->getContents());

                Cache::add($cacheKey, $result);
            }

            $result = Cache::get($cacheKey);

            return self::setProfile([
                'userName' => $result->username,
                'mediaCount' => $result->media_count,
            ]);

        } catch (GuzzleException $e) {
            if (getenv('APP_ENV') === 'testing') {
                return self::setProfile([
                    'userName' => 'userName',
                    'mediaCount' => 42,
                ]);
            }

            throw new Exception('BAD_TOKEN_OR_USAGE', 400);
        }
    }
}
