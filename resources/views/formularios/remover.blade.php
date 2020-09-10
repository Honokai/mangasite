@extends('layouts.inicio')

@section('conteudo')
<script>
/*
    var item = (elemento) => {
        elemento.parentElement.action = window.location.href + "/" + elemento.value
        console.log(elemento.parentElement.action)

        return true
    }

    function item(elemento) {
        alert('HELLO')
    }
*/
</script>
    <form action="" method="post">
        @csrf
        @method('delete')
        <select class="custom-select" name="manga" id="manga">
            <option value=""></option>
            @foreach ($mangas as $item)
            <option value="{{$item->id}}">{{$item->nome}}</option>
            @endforeach
        </select>
        <button class="btn btn-primary" type="submit">Apagar Mangá</button>
    </form>
    
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