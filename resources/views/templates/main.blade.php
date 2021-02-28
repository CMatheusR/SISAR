<html>
<head>
    <title>SISAR - @yield('titulo')</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            @if($tag=="MENU")
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img\home_ico.png') }}" width="30" height="30"
                         class="d-inline-block align-bottom"
                         alt="">
                    Menu
                </a>
            @endif
            @if($tag=="CUR")
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img\cursop_ico.png') }}" width="30" height="30"
                         class="d-inline-block align-bottom"
                         alt="">
                    Cursos
                </a>
            @endif
            @if($tag=="DIS")
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img\disciplinap_ico.png') }}" width="30" height="30"
                         class="d-inline-block align-bottom"
                         alt="">
                    Disciplina
                </a>
            @endif
            @if($tag=="PROF")
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img\professor_ico.png') }}" width="30" height="30"
                         class="d-inline-block align-bottom"
                         alt="">
                    Professor
                </a>
            @endif
            @if($tag=="ALUNO")
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img\alunop_ico.png') }}" width="30" height="30"
                         class="d-inline-block align-bottom"
                         alt="">
                    Aluno
                </a>
            @endif
            @if($tag=="MATRI")
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img\conceito_ico.png') }}" width="30" height="30"
                         class="d-inline-block align-bottom"
                         alt="">
                    Aluno
                </a>
            @endif
            @if($tag=="RESTRITO")
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img\restrito.png') }}" width="30" height="30"
                         class="d-inline-block align-bottom"
                         alt="">
                    Restrito
                </a>
            @endif
        </a>

        <span class="navbar-brand">SISAR - Sistema de Avaliação Remota</span>
        <div class="row">
            @guest
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="navbar-brand dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </div>
    </div>
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

