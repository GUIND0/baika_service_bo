
@extends('partials.main')
@section('title1')Utilisateurs
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Mon compte</a>
            </li>

        </ul>
        <div class="card mb-12">
            <h3 class="card-header">{{ucfirst(auth()->user()->prenom)}} {{ucfirst(auth()->user()->nom)}}</h3>
            <!-- Account -->
            <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img
                  src="{{ url('/app-assets/images/avatars/profil.jpg')}}"
                  alt="user-avatar"
                  class="d-block rounded"
                  height="100"
                  width="100"
                  id="uploadedAvatar"
                />
                <div class="row">
                    <div class="col-md-12">
                        <h5>Email : <strong>{{ auth()->user()->email}}</strong></h5>
                    </div>
                    <div class="col-md-12">
                        <h5>Telephone : <strong>{{ auth()->user()->telephone}}</strong></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Localité : <strong>{{ auth()->user()->localite->nom}}</strong></h5>
                    </div>
                    <div class="col-md-12">
                        <h5>Role : <strong>{{ auth()->user()->role->libelle}}</strong></h5>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <h5>Etat :

                        @if (auth()->user()->etat == "actif")
                        <span class="badge bg-success">Actif</span>
                        @else
                        <span class="badge bg-danger">Inactif</span>
                        @endif

                    </div>
                </div>

              </div>
            </div>
            <div class="divider divider-primary">
                <div class="divider-text" style="font-size: 28px;">Changer de mot de passe</div>
            </div>
            <form action="{{route('user.password')}}" method='POST' role="form" id="form" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="region_id" value="{{$region->id ?? '' }}"/>
                <div class="card-body">
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                          <label class="form-label" for="ancien_mot_de_passe">Ancien mot de passe</label>
                        </div>
                        <div class="input-group input-group-merge">
                          <input type="password" id="ancien_mot_de_passe" class="form-control  {{ $errors->has('ancien_mot_de_passe') ? 'is-invalid' : '' }}" name="ancien_mot_de_passe" placeholder="Ancien mot de passe" aria-describedby="ancien_mot_de_passe">
                          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        @if($errors->has('ancien_mot_de_passe'))
                            <span class="help-block text-danger">
                                <ul role="alert"><li>{{ $errors->first('ancien_mot_de_passe') }}</li></ul>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                          <label class="form-label" for="password">Nouveau mot de passe</label>
                        </div>
                        <div class="input-group input-group-merge">
                          <input type="password" id="password" class="form-control  {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="Nouveau mot de passe" aria-describedby="password">
                          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        @if($errors->has('password'))
                            <span class="help-block text-danger">
                                <ul role="alert"><li>{{ $errors->first('password') }}</li></ul>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                          <label class="form-label" for="password_confirmation">Confirmation</label>
                        </div>
                        <div class="input-group input-group-merge">
                          <input type="password" id="password_confirmation" class="form-control  {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" placeholder="Confirmer le nouveau mot de passe" aria-describedby="password_confirmation">
                          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        @if($errors->has('password_confirmation'))
                            <span class="help-block text-danger">
                                <ul role="alert"><li>{{ $errors->first('password_confirmation') }}</li></ul>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row d-flex justify-content-center">
                        <div class="demo-inline-spacing d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save mr-1"></i> Enregistrer
                            </button>
                            <button type="reset" class="btn btn-danger">
                                <i class="fa fa-times mr-1"></i>  Annuler
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section("script")

@endsection
