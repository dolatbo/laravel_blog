<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    private $tokenName = 'devsApp';

    public function login()
    {
        $email = request('email');
        $password = request('password');
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            $sucesso['token'] = $user->createToken($this->tokenName)->accessToken;

            $sucesso['id'] = $user->id;
            $sucesso['nome'] = $user->name;

            return response()->json(['ok' => $sucesso]);
        }
        return response()->json(['error' => 'Não autorizado'], 401);
    }

    public function registrar(Request $request)
    {
        $validarUsuario = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
        if ($validarUsuario->fails()) {
            return response()->json(['error' => $validarUsuario->errors()], 400);
        }
        $json = $request->all();
        $json['password'] = bcrypt($json['password']); // Criptografar senha obrigatório
        $user = User::create($json);

        $sucesso['token'] = $user->createToken($this->tokenName)->accessToken;
        $sucesso['id'] = $user->id;
        $sucesso['nome'] = $user->name;

        return response()->json(['ok' => $sucesso]);
    }

    public function detalhesUser()
    {
        $user = Auth::user();
        return response()->json(['ok' => $user]);
    }
}
