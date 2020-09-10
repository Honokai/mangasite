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
        <select name="manga" id="manga" onchange="url(this)">
            <option value=""></option>
            @foreach ($mangas as $item)
            <option value="{{$item->id}}">{{$item->nome}}</option>
            @endforeach
        </select>
        <button class="btn btn-primary" type="submit">Apagar Mangá</button>
    </form>
    
@endsection