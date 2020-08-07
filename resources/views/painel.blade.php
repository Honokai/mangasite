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
                    @csrf
                    <div class="form-group">
                        <label for="imagem">Imagem:</label>
                        <input id="imagem" name="imagem" class="form-control-file" type="file" multiple placeholder="Ex.: As crônicas de matsuri">
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome do manga:</label>
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

                    <button type="submit" class="btn btn-primary">Adicionar manga</button>
                </form>
            </div>
        </div>    
    </div>
@endsection