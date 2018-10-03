<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthControllerInvalidTest extends TestCase
{
    use DatabaseMigrations;

    public function testLoginWithInvalidCredentials()
    {
        //When we try to login passing wrong credentials
        $payload = [
            'login' => 'foo',
            'password' => 'bar',
        ];

        $response = $this->json('POST', 'api/v1/backoffice/login', $payload);

        // It should return an error invalid_credentials
        $response
            ->assertStatus(401)
            ->assertJson([ 'error' => 'invalid_credentials' ]);
    }
}
