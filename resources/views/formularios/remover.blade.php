@extends('layouts.inicio')

@section('conteudo')
    
    @foreach ($mangas as $item)
        <form action="{{route('manga.destroy',['manga'=>$item->id])}}" method="post">
            @method('delete')
            @csrf
            <strong> {{$item->nome}} </strong>
            <button class="btn btn-dark" type="submit">Remover</button>
        </form>
    @endforeach
    {{$mangas->links()}}
@endsection