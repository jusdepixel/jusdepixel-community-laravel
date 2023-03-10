<?php

declare(strict_types=1);

namespace Instagram\Auth;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CodeTest extends TestCase
{
    public function test_code_status()
    {
        $response = $this->get('/api/auth/code/CODE_INSTAGRAM#_');

        $response->assertStatus(200);
    }

    public function test_code_response()
    {
        $response = $this->get('/api/auth/code/CODE_INSTAGRAM#_');
        $expected = 'CODE_INSTAGRAM';

        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('code', $expected)
        );
    }
}
