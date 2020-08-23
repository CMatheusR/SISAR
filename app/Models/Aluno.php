<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    public function disciplina() {
        return $this->belongsToMany('App\Models\Disciplina', 'matriculas');
    }
    public function curso(){
        return $this->belongsTo('App\Models\Curso');
    }
}
