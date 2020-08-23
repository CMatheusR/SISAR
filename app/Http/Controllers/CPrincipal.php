<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CPrincipal extends Controller
{
    public function index()
    {
        return view('principal.index');
    }

}
