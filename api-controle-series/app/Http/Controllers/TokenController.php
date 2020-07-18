<?php

namespace App\Http\Controllers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function gerarToken(Request $request)
    {
        /*
         * Garante que os dados email e password estão na requisição
         * */
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $usuario = User::where('email', $request->email)->first();

        /*
         * Checa se esta nulo
         *  ---------------------------------
         * Checando se senha esta certa
         * Parametro 1 => senha que veio
         * Parametro 2 => senha salva
         * */
        if (is_null($usuario) || !Hash::check($request->password, $usuario->password)) {
            return response()->json('Usuario ou senha invalidos !', 401);
        }

        /*
         * Gerando token
         * */
        $token = JWT::encode(['email' => $request->email], env('JWT_KEY'));

        return [
            'access_token' => $token
        ];
    }
}
