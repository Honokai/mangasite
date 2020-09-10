@extends('layouts.inicio')

@section('conteudo')
    @if (Session::has('mensagem'))
        <h3>{{Session::get('mensagem')}}</h3>
    @endif
    <form action="{{route('manga.update',$manga->id)}}" method="post">
        @method('patch')
        @csrf
        <input type="hidden" name="id" value="{{$manga->id}}">
        <input type="text" name="nome" value="{{$manga->nome}}">
        <input type="text" name="descricao" value="{{$manga->descricao}}">
        <button type="submit">Enviar</button>
    </form>

@endsection