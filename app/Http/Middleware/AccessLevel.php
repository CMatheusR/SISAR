<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CRestrito;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AccessLevel
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if (Auth::check()) {

            $nivel = Auth::user()->level;
            $rota = $request->route()->getName();

            if ($rota != "restrito") {
                if ($nivel == 0) {
                    if ($rota != "index" && $rota != "") {
                        return redirect('restrito');
                    }
                } else if ($nivel == 1) {
                    if ($rota != "index" && $rota != "curso.index" && $rota != "disciplina.index" && $rota != "") {
                        return redirect('restrito');
                    }
                } else if ($nivel == 2) {
                    if ($rota != "" && $rota != "index" && $rota != "curso.index" && $rota != "disciplina.index"
                        && $rota != "professor.index" && $rota != "aluno.index" && $rota != "matricula.show") {
                        return redirect('restrito');
                    }
                }

            }

        }
        return $response;
    }
}
