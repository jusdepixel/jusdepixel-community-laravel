<?php

use Tests\TestCase;

class ControllersTest extends TestCase
{
    /** Route home@process */
    public function test_get_home(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** Route me@process */
    public function test_get_me_no_authtenticated(): void
    {
        $response = $this->get('/me');
        $response->assertStatus(403);
    }

    /** Route auth@process */
    public function test_get_auth_no_code(): void
    {
        $response = $this->get('/auth');
        $response->assertStatus(422);
    }

    public function test_get_auth_fake_code(): void
    {
        $response = $this->get('/auth?code=fake_code');
        $response->assertStatus(400);
    }

    /** Route logout@process */
    public function test_get_logout(): void
    {
        $response = $this->get('/logout');
        $response->assertStatus(204);
    }
}
