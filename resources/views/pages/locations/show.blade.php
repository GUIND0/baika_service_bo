@extends('partials.main')
@section('title1')Details
@endsection
@section('content')

<div class="row">

    <div class="col-md-6">
        <div class="accordion mt-3" id="accordionExample">
            {{-- General  --}}
            <div class="card accordion-item shadow-none bg-transparent border border-warning mb-3 active" >
              <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne" disabled>
                  Generale
                </button>
              </h2>

              <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body m-2">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Type de Location :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->type_location }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Prix :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5> {{number_format($location->prix, 0, ' ', ' ')}} Fcfa</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Modele :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->modele }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Etat :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->etat }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Version :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->version }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Statut :</h5>
                        </div>
                        <div class="col-md-6">
                            @if($location->statut =="1" )
                            <span class="badge bg-success">Libre</span>
                            @else
                            <span class="badge bg-success">Loue</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Annee :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->annee }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Description :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->description }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Couleure Exterieure :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->couleur_exterieure }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Carburant :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->carburant }}</h5>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            {{-- <div class="card accordion-item shadow-none bg-transparent border border-success mb-3">
              <h2 class="accordion-header" id="headingTwo">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                  Exterieure
                </button>
              </h2>
              <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Categorie :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->categorie }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Carrosserie :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->carrosserie }}</h5>
                        </div>
                    </div>

                </div>
              </div>
            </div>
            <div class="card accordion-item shadow-none bg-transparent border border-primary mb-3">
              <h2 class="accordion-header" id="headingThree">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
                 Interieure
                </button>
              </h2>
              <div id="accordionThree" class="accordion-collapse collapse " aria-labelledby="headingThree" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Couleure Interieure :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->couleur_interieure }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Salon :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->salon }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Nombre de siege :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->nbre_sieges }} sieges</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Nombre de porte :</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->nbre_portes }} portes</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Vitesse:</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->vitesse }} vitesses</h5>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="card accordion-item shadow-none bg-transparent border border-info mb-3">
                <h2 class="accordion-header" id="headingFour">
                  <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFour" aria-expanded="false" aria-controls="accordionFour">
                   Moteur
                  </button>
                </h2>
                <div id="accordionFour" class="accordion-collapse collapse " aria-labelledby="headingFour" data-bs-parent="#accordionExample" style="">
                  <div class="accordion-body">

                      <div class="row">
                          <div class="col-md-6">
                              <h5>Moteur :</h5>
                          </div>
                          <div class="col-md-6">
                              <h5>{{ $location->carburant }}</h5>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <h5>Transmission :</h5>
                          </div>
                          <div class="col-md-6">
                              <h5>{{ $location->transmission }}</h5>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <h5>Puissance :</h5>
                          </div>
                          <div class="col-md-6">
                              <h5>{{ $location->puissance }}</h5>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <h5>Cylindre:</h5>
                          </div>
                          <div class="col-md-6">
                              <h5>{{ $location->cylindre }}</h5>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                            <h5>Consommation:</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $location->consommation }}</h5>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
          </div> --}}
    </div>
    </div>
    <!-- Bootstrap crossfade carousel -->
    <div class="col-md-6">
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
                  <img style="width: auto; height: 300px;" class="img-fluid img-thumbnail" alt="Responsive image" src="{{ $img->path }}" >
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
