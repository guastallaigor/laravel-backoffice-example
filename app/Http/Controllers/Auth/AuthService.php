<?php

namespace App\Domain\V1\Auth;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthService
{
    /**
     * Gera um token de autenticação caso as credenciais do usuário sejam válidas.
     *
     * @param  String $login
     * @param  String $senha
     *
     * @return Boolean|String $token
     */
    public function generateToken($login, $senha)
    {
        $credencials = ['email' => $login, 'password' => $senha];

        if (! $token = JWTAuth::attempt($credencials)) {
            throw new InvalidCredentiualsException('Login or password invalid!');
        }

        return $token;
    }
}
