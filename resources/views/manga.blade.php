@extends('layouts.inicio')

@section('conteudo')
    <div class="conteudo">
        <div class="row">
            <div class="col-12">
                <div class="header">
                    <img class="capa" src="{{route('inicio')}}{{Storage::url($manga->imagem)}}" alt="Imagem manga">
                    <div class="manga-titulo">
                        {{$manga->nome}}
                    </div>
                    <div class="manga-descricao">
                        {{$manga->descricao}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 cap">
                <h3>Lista de capítulos</h3>
                <div class="capitulos">
                @isset($capitulos)
                    @foreach ($capitulos as $capitulo)
                        <a href="{{route('ler',['manga'=>$manga->nome,'capitulo'=>$capitulo->nome])}}">{{$capitulo->nome}}</a>
                    @endforeach
                @endisset
                </div>
            </div>
        </div>
    </div>
@endsection