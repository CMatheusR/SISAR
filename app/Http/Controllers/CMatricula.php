<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Matricula;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class CMatricula extends Controller
{

    public function index()
    {
        $matricula = Matricula::with('aluno')->with('disciplina')->get();
        return view('matricula.index', compact('matricula'));
    }

    public function store(Request $request)
    {
        $aluno = Aluno::find($request->aluno_id);
        if (isset($aluno)) {
            $disciplina = Disciplina::find($request->disciplina_id);
            if (isset($disciplina)) {
                $matricula = new Matricula();
                $matricula->aluno()->associate($aluno);
                $matricula->disciplina()->associate($disciplina);
                $matricula->save();
                return json_encode($matricula);
            } else {
                return response('Disciplina não encontrada', 404);
            }
        }
        else {
            return response('Aluno não encontrado', 404);
        }
    }

    public function show($id)
    {
        $aluno = Aluno::with('curso')->find($id);
        $disciplinas = Disciplina::with('curso')->where('curso_id', '=', $aluno['curso_id'])->get();
        $matricula = Matricula::with('aluno')->with('disciplina')->where('aluno_id','=', $id)->get();
        if (isset($matricula)) {
            return view('matricula.index', compact('matricula', 'aluno', 'disciplinas'));
        }
        return response('Matricula não encontrada', 404);
    }

    public function update(Request $request, $id)
    {
        $matricula = Matricula::find($id);
        if (isset($matricula)) {
            $aluno = Aluno::find($request->aluno_id);
            if (isset($aluno)) {
                $disciplina = Disciplina::find($request->disciplina_id);
                if (isset($disciplina)) {
                    $matricula = Matricula::find($id);
                    $matricula->aluno()->associate($aluno);
                    $matricula->disciplina()->associate($disciplina);
                    $matricula->save();
                    return json_encode($matricula);
                } else {
                    return response('Disciplina não encontrada', 404);
                }
            }
            else {
                return response('Aluno não encontrado', 404);
            }
        }
        return response('Matricula não encontrada', 404);
    }

    public function destroy($id){
        Matricula::where('aluno_id', '=', $id)->delete();
        return response('OK', 200);
    }

    public function loadJson()
    {
        $matricula = Matricula::with('aluno')->with('disciplina')->get();
        return json_encode($matricula);
    }
}
