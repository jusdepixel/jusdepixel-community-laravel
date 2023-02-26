<?php

declare(strict_types=1);

namespace Instagram\Me;

use Database\Seeders\InstagramSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Instagram;

class ProfileTest extends Instagram
{
    public function test_status_error()
    {
        $response = $this->get('/api/me/profile');

        $response->assertStatus(403);
    }

    public function test_status_success()
    {
        self::fakeProfile();
        $this->seed(InstagramSeeder::class);

        $response = $this->get('/api/me/profile');

        $response->assertStatus(200);
    }

    public function test_response_success()
    {
        self::fakeProfile();
        $this->seed(InstagramSeeder::class);

        $response = $this->get('/api/me/profile');

        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->where('id', 'bac04411-0000-4cd2-b9d9-06ad4f9c1c62')
                ->where('instagram_id', 123456789)
                ->where('username', 'userName')
                ->where('media_count', 42)
                ->where('access_token', 'sdsdkjçiqjlkqjdç_eseklkq,sdo,ce_lq,,scoijqelqek,dllqldkq,cv')
                ->where('token_type', 'Bearer')
                ->where('expires_in', 1677267776)
                ->where('updated_time', 1677267776)
                ->where('created_at', '2023-02-24T19:42:56.000000Z')
                ->where('updated_at', '2023-02-24T19:42:56.000000Z')
                ->where('expires_days',  $this->expires())
            );
    }

    private function expires(): int
    {
        $expiresAt = 1677267776 + 1677267776;
        $diff = $expiresAt - time();

        return (int) round($diff / 86400);
    }
}
