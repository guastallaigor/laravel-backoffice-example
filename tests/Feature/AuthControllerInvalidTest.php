<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthControllerInvalidTest extends TestCase
{
    use DatabaseMigrations;

    protected $authUri = 'api/v1/backoffice/login';

    public function testLoginWithInvalidCredentials()
    {
        //When we try to login passing wrong credentials
        $payload = [
            'login' => 'foo',
            'password' => 'bar',
        ];

        $response = $this->json('POST', $this->authUri, $payload);

        // It should return an error invalid_credentials
        $response
            ->assertStatus(401)
            ->assertJson([ 'error' => 'invalid_credentials' ]);
    }

    public function testLoginWithInactiveUser()
    {
        // We create 1 inactive employee
        $user = factory(Employee::class)->make();
        $user->password = bcrypt('teste123');
        $user->active = false;
        $user->save();

        //When we try to login with an inactive employee
        $credentials = [
            'login' => $user->email,
            'password' => 'teste123',
        ];

        $response = $this->json('POST', $this->authUri, $credentials);

        // It should return an error inactive
        $response
            ->assertStatus(401)
            ->assertJson([ 'error' => 'inactive' ]);
    }
}
