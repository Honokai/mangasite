@extends('layouts.inicio')
@section('conteudo')

<div class="conteudo">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="img/1.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src=".../800x400?auto=yes&bg=666&fg=444&text=Second slide" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src=".../800x400?auto=yes&bg=555&fg=333&text=Third slide" alt="Third slide">
          </div>
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
                    <a href="manga/{{$item->nome}}" class="btn btn-primary">Ler</a>
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