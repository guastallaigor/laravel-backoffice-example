<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthControllerInvalidTest extends TestCase
{
    use DatabaseMigrations;

    public function testLoginWithInvalidCredentials()
    {
        $payload = [
            'login' => 'foo',
            'password' => 'bar',
        ];

        $response = $this->json('POST', 'api/v1/backoffice/login', $payload);

        $response
            ->assertStatus(401)
            ->assertJson(['error' => 'invalid_credentials']);
    }
}
