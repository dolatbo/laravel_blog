<?php

namespace App\Http\Middleware;

use Closure;

class CheckDevTechs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $teste = $request->header('Teste');
        //dd($teste);
        // tratar se o campo for diferente da tabela
        //        $github_username = $request->input('GITHUB');
        //        $request->merge(['github_username' => $github_username]);

        //dd($request->all());
        if ($teste > 1) {
            return $next($request);
        }
        return response()->json(['Error' => 'Parâmetro incorreto!'], 400);
    }
}
