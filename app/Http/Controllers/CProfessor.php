<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\Professor;
use Illuminate\Http\Request;

class CProfessor extends Controller
{
    public function index()
    {
        $professor = Professor::all();
        return view('professor.index', compact('professor'));
    }

    public function store(Request $request)
    {
        $professor = new Professor();
        $professor->nome = $request->nome;
        $professor->email = $request->email;
        $professor->save();

        return json_encode($professor);
    }

    public function show($id)
    {
        $professor = Professor::find($id);
        if (isset($professor)) {
            return json_encode($professor);
        }
        return response('Professor não encontrada', 404);
    }

    public function update(Request $request, $id)
    {
        $professor = Professor::find($id);
        if (isset($professor)) {
            $professor->nome = $request->nome;
            $professor->email = $request->email;
            $professor->save();
            return json_encode($professor);
        }
        return response('Professor não encontrada', 404);
    }

    public function loadJson(){
        $professor = Professor::all();
        return json_encode($professor);
    }
}
