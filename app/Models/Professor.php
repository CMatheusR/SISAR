<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    public function disciplina()
    {
        $this->hasMany('App\Models\Disciplina');
    }
}
