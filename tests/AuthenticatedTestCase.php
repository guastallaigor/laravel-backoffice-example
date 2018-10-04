<?php

namespace Tests;

use JWTAuth;
use App\Models\Employee;
use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class AuthenticatedTestCase extends TestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    protected $loggedUser;
    protected $oldExceptionHandler;

    public function setup()
    {
        parent::setup();
        $this->disableExceptionHandling();
        $this->loggedUser = factory(Employee::class)->create();
    }

    private function headers()
    {
        $token = JWTAuth::fromUser($this->loggedUser);
        JWTAuth::setToken($token);

        return [
            'Accept' => 'application/json',
            'Authorization' => sprintf('Bearer %s', $token),
        ];
    }

    public function json($method, $uri, array $data = [ ], array $headers = [ ])
    {
        $headers = array_merge($headers, $this->headers());

        return parent::json($method, $uri, $data, $headers);
    }

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(\Exception $e) {}
            public function render($request, \Exception $e) {
                throw $e;
            }
        });
    }
    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }
}
