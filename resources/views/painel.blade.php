@extends('layouts.inicio')

@section('conteudo')

    <div class="conteudo">
        <div class="row">
            <div class="col-3">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('manga.create')}}">Adicionar mangas</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('capitulos.create')}}">Adicionar capítulos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('manga.formularioRemover')}}">Remover mangá</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Remover capítulos</a>
                    </li>
                </ul>
            </div>

            <div class="col-9" >
               @yield('formulario')
            </div>
        </div>    
    </div>

@endsection