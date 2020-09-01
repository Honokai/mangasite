@extends('layouts.inicio')

@section('conteudo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                @isset($favoritos)
                <ul>
                    @foreach ($favoritos as $item)
                    <li><a href="#">{{$item}}</a></li>
                    @endforeach    
                </ul>
                @endisset   
            </div>
        </div>
    </div>
@endsection