<?php

namespace Tests;

use App\DataObjects\ProfileDataObject;
use App\Http\Resources\Instagram\Me\MePostResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class Instagram extends TestCase
{
    use RefreshDatabase;

    protected static \App\Instagram\Instagram $instagram;

    protected function setUp(): void
    {
        parent::setUp();

        self::$instagram = new \App\Instagram\Instagram();
    }

    protected static function fakeProfile(): ProfileDataObject
    {
        return self::$instagram::setProfile([
            'userName' => 'userName',
            'isAuthenticated' => true,
            'instagramId' => 123456789,
            'mediaCount' => 42,
            'userId' => 'bac04411-0000-4cd2-b9d9-06ad4f9c1c62',
            'accessToken' => 'sdsdkjçiqjlkqjdç_eseklkq,sdo,ce_lq,,scoijqelqek,dllqldkq,cv'
        ]);
    }

    protected static function fakePost(): MePostResource
    {
        $post = [
            'id' => 12345678910,
            'caption' => 'Caption Post !',
            'media_type' => 'IMAGE',
            'media_url' => 'http://media.url/12345678910',
            'permalink' => 'https://perma.link/12345678910',
            'username' => 'userName',
            'timestamp' => 1677267776,
        ];

        return new MePostResource((object) $post);
    }
}
