@extends('layouts.inicio')
@section('conteudo')

<div class="conteudo">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          @foreach ($atualizados as $item)  
            @if ($contador == 0)
            <div class="carousel-item active">
              <img class="d-block w-100" src="{{Storage::url($item->imagem)}}" alt="{{$item->nome}}">
              <a href="{{route('mangas.show',['manga'=>$item->nome])}}" class="manga-link-nome">
                <span><h3>{{$item->nome}}</h3></span>
              </a>
            </div>
            @php
                $contador++;
            @endphp
            @else
            <div class="carousel-item">
              <img class="d-block w-100" src="{{Storage::url($item->imagem)}}" alt="{{$item->nome}}">
              <a href="{{route('mangas.show',['manga'=>$item->nome])}}" class="manga-link-nome">
                <span><h3>{{$item->nome}}</h3></span>
              </a>
            </div>
            
            @endif
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Anterior</span>
        </a>
        
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Próximo</span>
        </a>
    </div>
    <div class="row">
        <div class="col-9">
            @foreach ($mangas as $item)
            <div class="card" style="width: 18rem; text-align: center">
                <div class="img">
                  <img class="card-img-top" src="{{Storage::url($item->imagem)}}" alt="Card image cap">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$item->nome}}</h5>
                    <div class="card-text">
                        {{$item->descricao}} 
                    </div>
                    <a href="{{route('mangas.show',['manga'=>$item->nome])}}" class="btn btn-primary">Ler</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-3">
            <div class="sidebar">
                <h4>Mais visualizados</h4>
            </div>    
        </div>
    </div>    
    <div class="row">
      <div class="col-9 centro">
          {{$mangas->links()}}
      </div>
    </div>
</div>
@endsection