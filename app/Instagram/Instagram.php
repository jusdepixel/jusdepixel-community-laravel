<?php

declare(strict_types=1);

namespace App\Instagram;

use App\Models\InstagramPost;
use GuzzleHttp\Exception\GuzzleException;

class Instagram extends Authenticate
{
    public function getAuthorizeUrl(): string
    {
        return
            self::AUTHORIZE_URL .
            "?client_id=$this->clientId&redirect_uri=$this->redirectUri&scope=user_profile,user_media&response_type=code"
        ;
    }

    public function getProfile(): object
    {
        return $this->getSession();
    }

    public function getPosts(): int|array
    {
        try {
            $params = [
                'query' => [
                    'access_token' => $this->getSession()->accessToken,
                    'fields' => 'id,media_type,media_url,username,timestamp'
                ]
            ];

            $response = $this->clientGuzzle->request('GET', self::GRAPH_URL . self::MEDIAS_URI, $params);
            $posts = json_decode($response->getBody()->getContents())->data;

//            foreach($posts as $post) {
//                InstagramPost::factory()->create([
//                    'ig_id' => $this->getSession()->socialId,
//                    'media_id' => $post->id,
//                    'media_type' => $post->media_type,
//                    'media_url' => $post->media_url,
//                    'username' => $post->username,
//                    'timestamp' => $post->timestamp,
//                ]);
//            }

            return  $posts;

        } catch (GuzzleException $e) {
            return $e->getCode();
        }


    }
}
