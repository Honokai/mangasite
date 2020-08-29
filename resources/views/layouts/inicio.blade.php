<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mangas</title>
    <link rel="stylesheet" href="{{route('inicio')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{route('inicio')}}/css/perso.css">
    <script src="{{route('inicio')}}/js/jquery-3.2.1.slim.min.js"></script>
    <script src="{{route('inicio')}}/js/popper.min.js"></script>
    <script src="{{route('inicio')}}/js/bootstrap.min.js"></script>
    @if (Route::currentRouteName() == 'painel')
        <link rel="stylesheet" href="{{route('inicio')}}/css/select2.min.css">
        <script src="{{route('inicio')}}/js/select2.min.js"></script>
        <script src="{{route('inicio')}}/js/perso.js"></script>
    @endif
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{route('inicio')}}">{{config('app.name')}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('inicio')}}">Inicio<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Lista de mangas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Atualizados recentemente</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                @if (Auth::user())
                    <li class="nav-item">
                        <a class="nav-link" href="#"> Bem-vindo, <span class="usuario">{{Auth::user()->nome}}</span> </a>
                    </li>
                    @if (Auth::user()->acesso == 1 and Route::currentRouteName() != 'painel')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('painel')}}"> Gerenciar </a>
                        </li>    
                    @endif
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"> Sair </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}"> Entrar </a>    
                    </li>
                @endif
                <li>
                    <img class='tema' id='TemaSeletor' src="https://image.flaticon.com/icons/svg/702/702471.svg" alt="Tema escuro">
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        @yield('conteudo')
    </div>

</body>
</html>