<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CRestrito;
use Closure;
use Illuminate\Support\Facades\Log;

class AccessLevel
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
        $nivel = 3;
        $rota = $request->route()->getName();

        $response = $next($request);
        if ($rota != "restrito"){
            if ($nivel == 0){
                if ($rota != "index"){
                    return redirect('restrito');
                }
            }
            else if ($nivel == 1){
                if($rota != "index" && $rota != "curso.index" && $rota != "disciplina.index"){
                    return redirect('restrito');
                }
            }
            else if ($nivel == 2){
                if($rota != "index" && $rota != "curso.index" && $rota != "disciplina.index"
                    && $rota != "professor.index" && $rota != "aluno.index" && $rota != "matricula.show"){
                    return redirect('restrito');
                }
            }

        }
        return $response;
    }
}
