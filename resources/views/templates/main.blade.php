<html>
<head>
    <title>SISAR - @yield('titulo')</title>
    <meta charset="UTF-8">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/padrao.css') }}" rel="stylesheet">
    <style>
        body {
            padding: 40px;
        }

        .navbar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark align-content-center">
    @if($tag=="MENU")
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img\home_ico.png') }}" width="30" height="30" class="d-inline-block align-bottom"
                 alt="">
            Menu
        </a>
    @endif
    @if($tag=="CUR")
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img\cursop_ico.png') }}" width="30" height="30" class="d-inline-block align-bottom"
                 alt="">
            Cursos
        </a>
    @endif
    @if($tag=="DIS")
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img\disciplinap_ico.png') }}" width="30" height="30" class="d-inline-block align-bottom"
                 alt="">
            Disciplina
        </a>
    @endif
    @if($tag=="PROF")
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img\professor_ico.png') }}" width="30" height="30" class="d-inline-block align-bottom"
                 alt="">
            Professor
        </a>
    @endif
    @if($tag=="ALUNO")
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img\alunop_ico.png') }}" width="30" height="30" class="d-inline-block align-bottom"
                 alt="">
            Aluno
        </a>
    @endif
    @if($tag=="MATRI")
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img\conceito_ico.png') }}" width="30" height="30" class="d-inline-block align-bottom"
                 alt="">
            Aluno
        </a>
    @endif
    <span class="navbar-brand">SISAR - Sistema de Avaliação Remota</span>
    <a class="navbar-brand" href="{{route('principal.index')}}">| HOME |</a>
</nav>
<div>
    @yield('conteudo')
</div>
<hr>
</body>
<footer>
    <b>&copy;2020 - Claudio Matheus do Rosario.</b>
</footer>
<script src="{{asset('js/app.js')}}" type="text/javascript"></script>

@yield('script')

</html>

