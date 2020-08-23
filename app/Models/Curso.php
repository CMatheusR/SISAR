<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public function disciplina() {
        return $this->hasMany('App\Models\Disciplina');
    }

    public function aluno() {
        return $this->hasMany('App\Models\Aluno');
    }
}
