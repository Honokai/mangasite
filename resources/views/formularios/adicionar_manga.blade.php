@extends('painel')
@section('formulario')
<form action="{{route('manga.store')}}" method="POST" enctype="multipart/form-data">
                    
    <h2>Adicionar manga</h2>
    @csrf

    <div class="form-group">
        <label for="imagem">Imagem de capa:</label>
        <input id="imagem" name="imagem" class="form-control form-control-file @error('imagem') is-invalid @enderror" value="{{ old('imagem') }}" type="file">
        @error('imagem')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
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
@endsection