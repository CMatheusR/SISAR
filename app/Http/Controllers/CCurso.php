<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CCurso extends Controller
{
    public function index()
    {
        $curso = Curso::all();
        return view('curso.index', compact('curso'));
    }

    public function store(Request $request)
    {
        $curso = new Curso();
        $curso->nome = $request->nome;
        $curso->save();

        return json_encode($curso);
    }

    public function show($id)
    {
        $curso = Curso::find($id);
        if (isset($curso)) {
            return json_encode($curso);
        }
        return response('Curso não encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $curso = Curso::find($id);
        if (isset($curso)) {
            $curso->nome = $request->nome;
            $curso->save();
            return json_encode($curso);
        }
        return response('Curso não encontrado', 404);
    }

    public function loadJson(){
        $curso = Curso::all();
        return json_encode($curso);
    }
}
