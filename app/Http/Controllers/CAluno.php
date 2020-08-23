<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Http\Request;

class CAluno extends Controller
{

    public function index()
    {
        $aluno = Aluno::with('curso')->with('disciplina')->get();
        return view('aluno.index', compact('aluno'));
    }

    public function store(Request $request)
    {
        $curso = Curso::find($request->curso_id);
        if (isset($curso)){
            $aluno = new Aluno();
            $aluno->nome = $request->nome;
            $aluno->email = $request->email;
            $aluno->curso()->associate($curso);
            $aluno->save();
            return json_encode($aluno);
        }
        else{
            return response('Curso não encontrado', 404);
        }
    }

    public function show($id)
    {
        $aluno = Aluno::with('curso')->with('disciplina')->find($id);
        if (isset($aluno)) {
            return json_encode($aluno);
        }
        return response('Aluno não encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $aluno = Aluno::with('curso')->with('disciplina')->find($id);
        if (isset($aluno)) {
            $curso = Curso::find($request->curso_id);
            if (isset($curso)){
                $aluno->nome = $request->nome;
                $aluno->email = $request->email;
                $aluno->curso()->associate($curso);
                $aluno->save();
                return json_encode($aluno);
            }
            else{
                return response('Curso não encontrado', 404);
            }
        }
        return response('Aluno não encontrado', 404);
    }


    public function loadJson(){
        $aluno = Aluno::with('curso')->with('disciplina')->get();
        return json_encode($aluno);
    }
}
