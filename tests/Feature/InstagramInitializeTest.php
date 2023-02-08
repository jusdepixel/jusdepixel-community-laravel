<?php

namespace Tests\Feature;

use App\Instagram\Instagram;
use stdClass;
use Tests\TestCase;

class InstagramInitializeTest extends TestCase
{
    public function test_initialize_instance(): void
    {
        $response = (new Instagram())->initialize();

        $this->assertEquals('App\Instagram\Instagram', get_class($response));
    }

    public function test_initialize_properties(): void
    {
        $response = (new Instagram())->initialize();

        $this->assertEquals('INSTAGRAM_CLIENT_ID', $response->getClientId());
        $this->assertEquals('INSTAGRAM_CLIENT_SECRET', $response->getClientSecret());
        $this->assertEquals('INSTAGRAM_REQUEST_URI', $response->getRedirectUri());
        $this->assertEquals('GuzzleHttp\Client', get_class($response->getClientGuzzle()));
    }

    public function test_initialize_session(): void
    {
        $response = (new Instagram())->initialize();

        $expected = new stdClass();
        $expected->isAuthenticated = false;
        $expected->socialId = null;
        $expected->accessToken = null;
        $expected->accountType = null;
        $expected->mediaCount = null;
        $expected->username = 'Anonymous';

        $this->assertEquals($expected, $response->getSession());
    }
}
