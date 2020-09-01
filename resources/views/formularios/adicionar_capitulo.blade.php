@extends('painel')
@section('formulario')
<form action="{{route('capitulos.store')}}" method="POST" enctype="multipart/form-data">
                    
    @error('Falha')
        <span class="invalid-feedback" role="alert" style="display: block">
            <h3> {{ $message }} </h3>
        </span>
    @enderror
    <h2>Adicionar capítulo</h2>
    @csrf
    <div class="form-group">
        <label for="manga">Escolha o manga:</label><br>
        <select id="manga" name="manga" required class="form-control">
            <option value=""></option>
            @isset($mangas)
                @foreach ($mangas as $manga)
                    <option value="{{$manga->id}}">{{$manga->nome}}</option>
                @endforeach
            @endisset
        </select>
    </div>
    @error('resposta')
        <span class="invalid-feedback" role="alert" style="display: block">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    
    <div class="form-group">
        <label for="imagem">Imagens do capítulo:</label>
        <input id="imagem" name="imagem[]" class="form-control-file @error('imagem') is-invalid @enderror" value="{{ old('imagem[]') }}" type="file" multiple='multiple'>
        @foreach ($errors->get('imagem.*') as $message)
            @if (is_array($message))
                @foreach ($message as $item)
                    <span class="invalid-feedback" role="alert" style="display: block">
                        <strong>{{ $item }}</strong>
                    </span>
                @endforeach
            @else
                <span class="invalid-feedback" role="alert" style="display: block">
                    <strong>{{ $message }}</strong>
                </span>
            @endif
        @endforeach
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
@endsection