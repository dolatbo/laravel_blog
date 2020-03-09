<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Models\PasswordResets;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSucess;
use App\User;
use Carbon\Carbon;
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

    private function getEmailDoToken($token)
    {
        $horas_expiracao = config('configuracoes_personalizadas.password_expires');
        // dd($horas_expiracao);
        $passwordReset = PasswordResets::where('token', $token)->first();

        $result = ['result' => false, 'passwordReset' => ''];

        if (!$passwordReset) {
            // return response()->json(['error' => 'Token inválido'], 404);
            return $result;
        }

        if (Carbon::parse($passwordReset->updated_at)->addHour($horas_expiracao)->isPast()) {
            $passwordReset->delete();
            // return response()->json(['error' => 'Token expirado'], 404);
            return $result;
        }

        return ['result' => true, 'passwordReset' => $passwordReset];
    }

    public function reset(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'password' => 'required|string',
            'c_password' => 'required|same:password',
            'token' => 'required|string'
        ]);

        if ($validador->fails()) {
            return response()->json(['error' => $validador->errors()], 401);
        }

        $resultToken = $this->getEmailDoToken($request->token);

        if ($resultToken['result']) {
            $user = User::where('email', $resultToken['passwordReset']->email)->first();

            if (!$user) {
                return response()->json(['error' => 'Usuário não encontrado'], 404);
            }

            //$user->password = bcrypt($request->password);
            $user->password = $request->password;
            $user->save();

            $resultToken['passwordReset']->delete();
            $user->notify(new PasswordResetSucess());

            return response()->json(['ok' => 'Senha alterada com sucesso']);
        }

        return response()->json(['error' => 'token não encontrado ou expirado'], 404);
    }
}
