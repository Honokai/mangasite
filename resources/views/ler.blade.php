@extends('layouts.inicio')

@section('conteudo')

    <div class="container-fluid">
        <div class="row" style="text-align: center">
            <div class="col">
                <select class="custom-select" style="max-width: 300px; margin-top:10px; margin-bottom:10px" name="capitulos" id="">
                    <option value=""></option>
                    @foreach ($Capitulos as $capitulo)
                        <option value="{{$capitulo->id}}">{{$capitulo->nome}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @foreach ($imagens as $imagem)
        <div class="row" style="text-align: center; margin-bottom:10px">
            <div class="col">
                <img style="max-height:300px" src="{{Storage::url($imagem->local)}}" alt="">
            </div>
        </div>
        @endforeach
    </div>
    
@endsection