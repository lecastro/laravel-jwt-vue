<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthApiController extends Controller
{
    public function authenticate(Request $request)
    {
        // pegar credenciais da solicitação
        $credentials = $request->only('email', 'password');

        try {
            // tentativa de verificar as credenciais e criar um token para o usuário
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // algo deu errado ao tentar codificar o token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        //Recuperar Usuário Logado
        $user = auth()->user();

        // tudo de bom para devolver o token
        return response()->json(compact('token', 'user'));
    }

    public function getAuthenticatedUser()
    {
        try {
            //pega o token e verifica se o usuario e autenticado
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        //o token é válido e encontramos o usuário por meio da reivindicação secundária
        return response()->json(compact('user'));
    }

    public function refreshtoken()
    {
        //recuperando o token do usuario.
        if (!$token = JWTAuth::getToken()) {
            return response()->json(['error' => 'token_not_send'], 401);
        }
        //variavel token vai atualizada
        try {
            $token = JWTAuth::refresh();
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        }

        // gerar um novo token atualiza.
        return response()->json(compact('token', 'user'));
    }
}
