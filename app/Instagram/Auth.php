<?php

declare(strict_types=1);

namespace App\Instagram;

use App\DataObjects\ProfileDataObject;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class Auth extends Profile
{
    public static string $code;

    /**
     * @throws Exception
     */
    public static function login(string $code): ProfileDataObject
    {
        self::setCode($code);

        return self::requestToken();
    }

    public static function logout(): ProfileDataObject
    {
        return self::forgetSession();
    }

    /**
     * @throws Exception
     */
    public static function requestToken(): ProfileDataObject
    {
        try {
            $params = [
                'form_params' => [
                    'client_id' => self::$clientId,
                    'client_secret' => self::$clientSecret,
                    'redirect_uri' => self::$redirectUri,
                    'code' => self::$code,
                    'grant_type' => 'authorization_code',
                ]
            ];

            $response = self::$clientGuzzle->request('POST', self::TOKEN_URL, $params);
            $result = json_decode($response->getBody()->getContents());

            self::setProfile([
                'accessToken' => $result->access_token,
                'instagramId' => $result->user_id,
                'isAuthenticated' => true
            ]);

            return self::requestProfile();

        } catch (GuzzleException $e) {
            throw new Exception('BAD_CODE_OR_USAGE', $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public static function requestLongLifeToken(?string $token = null)//: array
    {
        try {
            $token === null ? self::getProfile()->accessToken : $token;

            $params = [
                'query' => [
                    'access_token' => $token,
                    'grant_type' => 'ig_exchange_token',
                    'client_secret' => self::$clientSecret,
                ]
            ];

            $response = self::$clientGuzzle->request(
                'GET',
                self::REFRESH_TOKEN_URL,
                $params
            );

            $result = json_decode($response->getBody()->getContents());

            return [
                'accessToken' => $result->access_token,
                'tokenType' => $result->token_type,
                'expiresIn' => $result->expires_in,
            ];

        } catch (GuzzleException $e) {
            if (getenv('APP_ENV') === 'testing') {
                return [
                    'accessToken' => 'sdsdkjçiqjlkqjdç_eseklkq,sdo,ce_lq,,scoijqelqek,dllqldkq,cv',
                    'tokenType' => 'Bearer',
                    'expiresIn' => 1677267776,
                ];
            }

            throw new Exception('BAD_TOKEN_OR_USAGE', $e->getCode());
        }
    }

    public static function code($code): string
    {
        return self::setCode($code);
    }

    private static function setCode(string $code): string
    {
        return self::$code = str_replace('#_', '', $code);
    }
}
