<?php

namespace App\Http\Controllers\Auth;

use JWTAuth;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Generate jwt token for authentication.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        try {
            $token = $this
                ->service
                ->generateToken($request->login, $request->password);

            return response(compact('token'));
        } catch (Exception $e) {
            return response(['Login or password invalid'], 401);
        }
    }

    /**
     * Refresh jwt token.
     *
     * @return Response
     */
    public function refresh()
    {
        $token = JWTAuth::refresh(JWTAuth::getToken());

        return response(compact('token'));
    }
}
