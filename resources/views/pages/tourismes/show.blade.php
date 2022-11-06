@extends('partials.main')
@section('title1')Details
@endsection
@section('content')

<div class="row">


    <div class="col-md-4">
        <div class="row">
            <div class="card card-box">
                <div class="card-body">
                    <div class="col-md-12">
                        <h5>Nom  : {{ $tourisme->nom }}</h5>
                        <h5>Lieu :{{ $tourisme->lieu }}</h5>
                        <h5>Description : {{ $tourisme->description }}</h5>
                        <h5>Statut : <span class="badge bg-{{$tourisme->statut == 1 ? 'success' : 'danger'  }}">{{$tourisme->statut == 1 ? 'Activer' : 'Desactiver'  }}</span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap crossfade carousel -->
    <div class="col-md-8">
      @if($images)
      <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            @if ($images )
                @foreach ($images as $key =>  $img )
                    <li data-bs-target="#carouselExample-cf" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : '' }}"></li>
                @endforeach
            @endif
        </ol>
          <div class="carousel-inner">
              @foreach ($images as $key =>  $img )
              <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                  <img style="width: auto; height: auto;" class="img-fluid img-thumbnail" alt="Responsive image" src="{{ $img->path }}" >
              </div>
              @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon"aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
          </a>
      </div>
  @endif
    </div>
</div>

@endsection
@section('script')
@endsection
