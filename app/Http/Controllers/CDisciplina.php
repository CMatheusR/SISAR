<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Professor;
use Illuminate\Http\Request;

class CDisciplina extends Controller
{
    public function index()
    {
        $disciplina = Disciplina::with('curso')->with('professor')->get();
        return view('disciplina.index', compact('disciplina'));
    }

    public function store(Request $request)
    {
        $curso = Curso::find($request->curso_id);
        if(isset($curso)){
            $professor = Professor::find($request->professor_id);
            if (isset($professor)){
                $disciplina = new Disciplina();
                $disciplina->nome = $request->nome;
                $disciplina->professor()->associate($professor);
                $disciplina->curso()->associate($curso);
                $disciplina->save();
                return json_encode($disciplina);
            }
            else{
                return response('Professor não encontrado', 404);
            }
        }
        else {
            return response('Curso não encontrado', 404);
        }

    }

    public function show($id)
    {
        $disciplina = Disciplina::find($id);
        if (isset($disciplina)) {
            return json_encode($disciplina);
        }
        return response('Disciplina não encontrada', 404);
    }

    public function update(Request $request, $id)
    {
        $disciplina = Disciplina::with('curso')->with('professor')->find($id);
        if (isset($disciplina)) {
            $curso = Curso::find($request->curso_id);
            if(isset($curso)){
                $professor = Professor::find($request->professor_id);
                if (isset($professor)){
                    $disciplina->nome = $request->nome;
                    $disciplina->professor()->associate($professor);
                    $disciplina->curso()->associate($curso);
                    $disciplina->save();
                    return json_encode($disciplina);
                }
                else{
                    return response('Professor não encontrado', 404);
                }
            }
            else {
                return response('Curso não encontrado', 404);
            }
        }
        return response('Disciplina não encontrada', 404);
    }

    public function loadJson(){
        $disciplina = Disciplina::with('curso')->with('professor')->get();
        return json_encode($disciplina);
    }
}
