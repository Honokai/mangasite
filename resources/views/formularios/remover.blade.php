@extends('layouts.inicio')

@section('conteudo')
    <form action="" method="post">
        @csrf
        @method('delete')
        <select name="manga" id="manga" onchange="url(this)">
            <option value=""></option>
            @foreach ($mangas as $item)
            <option value="{{$item->id}}">{{$item->nome}}</option>
            @endforeach
        </select>
        <button class="btn btn-primary" type="submit">Apagar Mangá</button>
    </form>
    
@endsection