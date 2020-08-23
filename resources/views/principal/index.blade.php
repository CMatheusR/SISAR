@extends('templates.main', ['titulo' => "Principal", 'tag' => "MENU"])

@section('titulo') Principal @endsection


@section('conteudo')

    <div class='row justify-content-around text-center'>
        <div class='col justify-content-center'>
            <a class="navbar-brand" href="{{route('curso.index')}}" >
                <img src="{{ asset('img/curso_ico.png') }}" height="128" width="128">
                <div class="w-100"></div>
                <b>Curso</b>
            </a>
        </div>
        <div class='col justify-content-center'>
            <a class="navbar-brand" href="{{route('disciplina.index')}}">
                <img src="{{ asset('img/disciplina_ico.png') }}" height="128" width="128">
                <div class="w-100"></div>
                <b>Disciplina</b>
            </a>
        </div>
        <div class='col justify-content-center'>
            <a class="navbar-brand" href="{{route('professor.index')}}">
                <img src="{{ asset('img/professor_ico.png') }}" height="128" width="128">
                <div class="w-100"></div>
                <b>Professor</b>
            </a>
        </div>
        <div class='col justify-content-center'>
            <a class="navbar-brand" href="{{route('aluno.index')}}">
                <img src="{{ asset('img/aluno_ico.png') }}" height="128" width="128">
                <div class="w-100"></div>
                <b>Aluno</b>
            </a>
        </div>
    </div>


@endsection


