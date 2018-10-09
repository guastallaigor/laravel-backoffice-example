<?php

namespace App\Http\Controllers\Domains;

use JWTAuth;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = [
            'email' => $request->json('login'),
            'password' => $request->json('password'),
        ];


        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([ 'error' => 'invalid_credentials' ], 401);
        }

        $user = JWTAuth::toUser($token);

        if (!$user->active) {
            return response()->json([ 'error' => 'inactive' ], 401);
        }

        return response()->json(compact('token'));
    }
}
