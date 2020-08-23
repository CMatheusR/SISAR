<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('aluno/load', 'CAluno@loadJson');
Route::resource('aluno', 'CAluno');
Route::get('curso/load', 'CCurso@loadJson');
Route::resource('curso', 'CCurso');
Route::get('disciplina/load', 'CDisciplina@loadJson');
Route::resource('disciplina', 'CDisciplina');
Route::get('matricula/load', 'CMatricula@loadJson');
Route::resource('matricula', 'CMatricula');
Route::get('professor/load', 'CProfessor@loadJson');
Route::resource('professor', 'CProfessor');

