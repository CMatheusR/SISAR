<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{

    public function curso(){
        return $this->belongsTo('App\Models\Curso');
    }

    public function professor(){
        return $this->belongsTo('App\Models\Professor');
    }

    public function aluno(){
        return $this->belongsToMany('App\Models\Aluno', 'matriculas');
    }
}
