@extends('layouts.inicio')

@section('conteudo')
    <div class="conteudo">
        <div class="row">
            <div class="col-4">
                <div class="header">
                    <img class="capa" src="{{route('inicio')}}{{Storage::url($manga->imagem)}}" alt="Imagem manga">
                </div>
            </div>
            <div class="col-8">
                <div class="manga-titulo">
                    {{$manga->nome}}
                </div>
                <div class="manga-descricao">
                    {{$manga->descricao}}
                    @error('Erro')
                        <p></p>
                        <div class='warning'>
                            {{$message}} 
                        </div>
                    @enderror
                    @if (Session::has('mensagem'))
                    <p></p>
                    <div class="aviso-sucesso">
                        {{Session::get('mensagem')}}
                    </div>
                    @endif
                    
                </div>
                <div class="botoes">
                    <form action="{{route('favoritos.store')}}" method="post">
                        @csrf
                        <input hidden type="number" name="manga" value="{{$manga->id}}">
                        @isset(Auth::user()->id)
                        <input hidden type="text" name="usuario" value="{{Auth::user()->id}}">
                        <button class="btn btn-primary" href="{{route('favoritos.store')}}">Adicionar aos favoritos</button>
                        @endisset
                    </form>
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