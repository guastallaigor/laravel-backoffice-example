<?php

namespace Tests\Feature;

use App\Employee;
use Tests\AuthenticatedTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthControllerTest extends AuthenticatedTestCase
{
    use DatabaseMigrations;

    protected $authUri = 'api/v1/backoffice/login';

    public function testLoginWithValidCredentials()
    {
        // We create one new employee and save it on the database
        $user = factory(Employee::class)->create();
        $user->password = 'teste123';

        // When we try to login with his credentials
        $credentials = [
            'login' => $user->email,
            'password' => $user->password,
        ];

        $response = $this->json('POST', $this->authUri, $credentials);

        // It should return a JWT token
        $response
            ->assertStatus(200)
            ->assertJsonStructure([ 'token' ]);
    }
}
