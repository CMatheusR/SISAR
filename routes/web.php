<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/', 'CPrincipal');
Route::resource('aluno', 'CAluno');
Route::resource('curso', 'CCurso');
Route::resource('disciplina', 'CDisciplina');
Route::resource('matricula', 'CMatricula');
Route::resource('professor', 'CProfessor');
Route::resource('principal', 'CPrincipal');
