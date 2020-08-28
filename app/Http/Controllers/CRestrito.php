<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CRestrito extends Controller
{
    public function index(){
        return view('acessoRestrito.index');
    }
}
