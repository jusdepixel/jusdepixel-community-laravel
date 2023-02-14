<?php

use Tests\TestCase;

class ControllersTest extends TestCase
{
    /** Route home@process */
    public function test_get_home(): void
    {
        $this->withoutVite();
        $response = $this->get('/api/home');
        $response->assertStatus(200);
    }

    /** Route me@process */
    public function test_get_me_no_authenticated(): void
    {
        $response = $this->get('/api/me');
        $response->assertStatus(400);
    }

    /** Route auth@process */
    public function test_get_auth_no_code(): void
    {
        $response = $this->get('/api/authenticate');
        $response->assertStatus(422);
    }

    public function test_get_auth_fake_code(): void
    {
        $response = $this->get('/api/authenticate?code=fake_code');
        $response->assertStatus(400);
    }

    /** Route logout@process */
    public function test_get_logout(): void
    {
        $response = $this->get('/api/logout');
        $response->assertStatus(204);
    }
}
