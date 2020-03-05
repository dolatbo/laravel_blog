<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Models\PasswordResets;
use App\Notifications\PasswordResetRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function criarToken(Request $request)
    {
        $validarEmail = Validator::make($request->all(), ['email' => 'required|email']);

        if ($validarEmail->fails()) {
            return response()->json(['error' => $validarEmail->errors()], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'E-mail não encontrado'], 404);
        }

        $gerarToken = PasswordResets::updateOrCreate(
            ['email' => $user->email],
            ['email' => $user->email, 'token' => Str::random(60)]
        );

        if ($gerarToken) {
            $notify = $user->notify(
                new PasswordResetRequest($gerarToken->token)
            );

            if ($notify) {
                return response()->json(['error' =>
                'Erro ao enviar redefinição de senha para o seu e-mail']);
            }
        }

        return response()->json(['ok' => 'Redifinição de senha enviada para seu e-mail.']);
    }
}
