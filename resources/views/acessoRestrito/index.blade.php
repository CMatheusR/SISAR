<!-- https://material.io/resources/icons/?icon=delete&style=baseline -->

@extends('templates.main', ['titulo' => "Restrito", 'tag' => "RESTRITO"])

@section('titulo') Restrito @endsection

@section('conteudo')

    <div class="col ">
        <div class="row justify-content-center">
            <h1 class="" href="#">
                <b>Acesso Restrito</b>
            </h1>
        </div>
        <div class="row justify-content-center">
            <img src="{{ asset('img\restrito.png') }}" class="d-inline-block align-bottom row" alt="">
        </div>
    </div>
    <br>
@endsection
