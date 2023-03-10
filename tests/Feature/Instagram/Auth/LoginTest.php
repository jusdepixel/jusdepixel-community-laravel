<?php

declare(strict_types=1);

namespace Instagram\Auth;

use App\Instagram\Profile;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_login_status_success()
    {
        $response = $this->get('/api/auth/login/CODE_INSTAGRAM#_');

        $response->assertStatus(400);
    }

    public function test_login_status_error_method()
    {
        $response = $this->post('/api/auth/login/CODE_INSTAGRAM#_');

        $response->assertStatus(405);
    }

    public function test_login_response_error()
    {
        $response = $this->get('/api/auth/login/CODE_INSTAGRAM#_');

        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->where('message', 'Bad or no longer valid code, or has already been used')
        );
    }
}
