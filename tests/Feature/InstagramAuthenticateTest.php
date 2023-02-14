<?php

namespace Tests\Feature;

use App\Instagram\Instagram;
use GuzzleHttp\Exception\ClientException;
use Tests\TestCase;

class InstagramAuthenticateTest extends TestCase
{
    public function test_request_authorize_url(): void
    {
        $response = (new Instagram())->initialize()->requestAuthorizeUrl();
        $expected = "https://api.instagram.com/oauth/authorize?client_id=INSTAGRAM_CLIENT_ID&redirect_uri=INSTAGRAM_REQUEST_URI&scope=user_profile,user_media&response_type=code";

        $this->assertEquals($expected, $response);
    }

    public function test_request_token(): void
    {
        $response = (new Instagram())
            ->initialize()
            ->setCode('fake_code')
            ->requestToken();

        $this->assertEquals(true, $response instanceof ClientException);
        $this->assertEquals(400, $response->getCode());
    }

    public function test_request_profile(): void
    {
        $response = (new Instagram())
            ->initialize()
            ->requestProfile();

        $this->assertEquals(true, $response instanceof ClientException);
        $this->assertEquals(400, $response->getCode());
    }

    public function test_authenticate_no_code(): void
    {
        $response = (new Instagram())->initialize()->authenticate(null);

        $this->assertEquals(204, $response);
    }

    public function test_authenticate_fake_code(): void
    {
        $response = (new Instagram())->initialize()->authenticate('fake_code');


        $this->assertEquals(true, $response instanceof ClientException);
        $this->assertEquals(400, $response->getCode());
    }

    public function test_logout(): void
    {
        $profile = [
            'isAuthenticated' => true,
            'igId' => 'igId',
            'accessToken' => 'accessToken',
            'accountType' => 'accountType',
            'mediaCount' => 42,
            'username' => 'MyName'
        ];
        $instagram = (new Instagram());
        $instagram
            ->initialize()
            ->setProfile($profile);

        $this->assertEquals($profile, (array) $instagram->getSession());

        $instagram->logout();

        $expected = [
            'isAuthenticated' => false,
            'igId' => null,
            'accessToken' => null,
            'accountType' => null,
            'mediaCount' => null,
            'username' => 'Anonymous'
        ];

        $this->assertEquals($expected, (array) $instagram->getSession());
    }

    public function test_set_code(): void
    {
        $code = 'fake_code#_';
        $response = (new Instagram())->setCode($code);

        $this->assertEquals('fake_code', $response->code);
    }
}
