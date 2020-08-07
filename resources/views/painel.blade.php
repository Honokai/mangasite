@extends('layouts.inicio')

@section('conteudo')
    <div class="conteudo">
        <div class="row">
            <div class="col-3">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#"> Gerenciar mangas </a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Gerenciar capítulos</a>
                    </li>
                </ul>
            </div>

            <div class="col-9" >
                <form action="{{route('am')}}" method="POST" enctype="multipart/form-data">
                    <h2>Adicionar manga</h2>
                    @csrf
                    <div class="form-group">
                        <label for="imagem">Imagem de capa:</label>
                        <input id="imagem" name="imagem" class="form-control-file" type="file" placeholder="Ex.: As crônicas de matsuri">
                    </div>
                    <div class="form-group">
                        <label for="nomemanga">Nome do manga:</label>
                        <input id="nomemanga" name="nomemanga" class="form-control @error('nomemanga') is-invalid @enderror" value="{{ old('nomemanga') }}"  type="text" placeholder="Ex.: As crônicas de matsuri">
                        @error('nomemanga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" class="form-control @error('descricao') is-invalid @enderror" value="{{ old('descricao') }}" type="text" placeholder="Ex.: As crônicas de matsuri"> </textarea>
                        @error('descricao')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Adicionar manga</button>
                </form>

                <form action="{{route('adicionar capitulo')}}" method="POST" enctype="multipart/form-data">
                    <h2>Adicionar capítulo</h2>
                    @csrf
                    <div class="form-group">
                        <label for="manga">Escolha o manga:</label><br>
                        <select id="manga" name="manga" required class="form-control">
                            @isset($mangas)
                                @foreach ($mangas as $manga)
                                    <option value="{{$manga->id}}">{{$manga->nome}}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label for="imagem">Imagens do capítulo:</label>
                        <input id="imagem" name="imagem[]" class="form-control-file @error('imagem') is-invalid @enderror" value="{{ old('imagem') }}" type="file" multiple='multiple'>
                        @error('imagem')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome do capítulo:</label>
                        <input id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}"  type="text" placeholder="Ex.: As crônicas de matsuri">
                        @error('nome')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" class="form-control @error('descricao') is-invalid @enderror" value="{{ old('descricao') }}" type="text" placeholder="Ex.: As crônicas de matsuri"> </textarea>
                        @error('descricao')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Adicionar capitulo</button>
                </form>
            </div>
        </div>    
    </div>
@endsection