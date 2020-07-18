<?php

namespace App\Http\Middleware;

use Firebase\JWT\JWT;
use App\User;
use Illuminate\Http\Request;

class Autenticador
{
    public function handle(Request $request, \Closure $next, $guard = null)
    {
        try {
            if (!$request->hasHeader('Authorization')) {
                throw new \Exception();
            }

            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $dadosAutenticacao = JWT::decode($token, env('JWT_KEY'), ['HS256']);

            $user =  User::where('email', $dadosAutenticacao->email)->first();

            if (is_null($user)) {
                throw new \Exception();
            }

            return $next($request);

        } catch (\Exception $e) {
            return response()->json('Acesso Não Autorizado', 401);
        }
    }
}
