@extends('layout.main')
@section('title1','Gestion des utilisateurs')
@section('first')
    <a href="#">Accueil</a>
@endsection
@section('second')
    <a href="#">Utilisateur</a>
@endsection
@section('third')
    <a href="#">Modifier</a>
@endsection
@section('page-style')

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('user.update', $user->id) }}" method='POST' role="form" id="form" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card card-box">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Prénom <span class="text-danger">*</span></label>
                                <input type="text" name="prenom" class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}"
                                        value="{{ $user->prenom }}" placeholder="Prénom" required/>
                                @if($errors->has('prenom'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('prenom') }}</li>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" name="nom" class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}"
                                        value="{{ $user->nom }}" placeholder="Nom" required/>
                                @if($errors->has('nom'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('nom') }}</li>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Genre">Genre <span class="text-danger">*</span></label>
                                <select data-placeholder="Choisir genre ..." class="select2 form-control" id="genre" name="genre" required>
                                    <option></option>
                                    <option value="Homme" {{ $user->genre == "Homme" ? 'selected' : '' }}>Homme</option>
                                    <option value="Femme" {{ $user->genre == "Femme" ? 'selected' : '' }}>Femme</option>
                                </select>
                                @if($errors->has('genre'))
                                <span class="help-block text-danger">
                                    <ul role="alert"><li>{{ $errors->first('genre') }}</li></ul>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="profil">Profil <span class="text-danger">*</span></label>
                                <select data-placeholder="Choisir profil ..." class="select2 form-control" id="profil" name="profil" required>
                                    <option></option>
                                    @foreach ($profils as $p)
                                    <option value="{{ $p->id }}" {{ $user->profil_id == $p->id ? 'selected' : '' }}>{{ $p->libelle }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('profil'))
                                <span class="help-block text-danger">
                                    <ul role="alert"><li>{{ $errors->first('profil') }}</li></ul>
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">E-mail <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                        value="{{ $user->email }}" placeholder="E-mail" required/>
                                @if($errors->has('email'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('email') }}</li>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="centre">Centre <span class="text-danger">*</span></label>
                                <select data-placeholder="Choisir centre ..." class="select2 form-control" id="centre" name="centre" required>
                                    <option></option>
                                    @foreach ($centres as $c)
                                    <option value="{{ $c->id }}" {{ $user->centre_id == $c->id ? 'selected' : '' }}>{{ $c->libelle }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('centre'))
                                <span class="help-block text-danger">
                                    <ul role="alert"><li>{{ $errors->first('centre') }}</li></ul>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Téléphone </label>
                                <input type="text" name="telephone" class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}"
                                        value="{{ $user->telephone }}" placeholder="Téléphone" pattern="[0-9]{8}"/>
                                @if($errors->has('telephone'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('telephone') }}</li>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account-company">Photo</label>
                                <input type="file" value="{{ json_decode(auth()->user()->photo) }}"  name="photo" class="form-control {{ $errors->has('photo') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('photo'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('photo') }}</li>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-success">
                                        <p class="mb-50">Actif</p>
                                        <input type="checkbox" class="form-control custom-control-input" name="active" placeholder="Actif" value="1" id="customSwitch111" {{ $user->active == '1' ? 'checked' : '' }} />
                                        <label class="custom-control-label" for="customSwitch111">
                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-switch-success">
                                    <p class="mb-50">Accès au module "Cartes grises"</p>
                                    <input type="checkbox" class="form-control custom-control-input" name="access_m_cg" placeholder="Actif" value="1" id="customSwitchmcg" {{ $user->access_m_cg == '1' ? 'checked' : '' }} />
                                    <label class="custom-control-label" for="customSwitchmcg">
                                        <span class="switch-icon-left"><i data-feather="check"></i></span>
                                        <span class="switch-icon-right"><i data-feather="x"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-switch-success">
                                    <p class="mb-50">Accès au module "Permis"</p>
                                    <input type="checkbox" class="form-control custom-control-input" name="access_m_p" placeholder="Actif" value="1" id="customSwitchmp" {{ $user->access_m_p == '1' ? 'checked' : '' }} />
                                    <label class="custom-control-label" for="customSwitchmp">
                                        <span class="switch-icon-left"><i data-feather="check"></i></span>
                                        <span class="switch-icon-right"><i data-feather="x"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-switch-success">
                                    <p class="mb-50">Accès au module "Cartes de transport"</p>
                                    <input type="checkbox" class="form-control custom-control-input" name="access_m_ct" placeholder="Actif" value="1" id="customSwitchmct" {{ $user->access_m_ct == '1' ? 'checked' : '' }} />
                                    <label class="custom-control-label" for="customSwitchmct">
                                        <span class="switch-icon-left"><i data-feather="check"></i></span>
                                        <span class="switch-icon-right"><i data-feather="x"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-switch-success">
                                    <p class="mb-50">Accès au module "Rapport"</p>
                                    <input type="checkbox" class="form-control custom-control-input" name="access_m_rp" placeholder="Actif" value="1" id="customSwitchmrp" {{ $user->access_m_rp == '1' ? 'checked' : '' }} />
                                    <label class="custom-control-label" for="customSwitchmrp">
                                        <span class="switch-icon-left"><i data-feather="check"></i></span>
                                        <span class="switch-icon-right"><i data-feather="x"></i></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="offset-md-1 col-md-12">
                            <button type="submit" class="btn btn-gradient-primary">Enregistrer</button>
                            <button type="reset" class="btn btn-outline-danger ml-1">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection

@section('page-script')
    <script>

    </script>
@endsection
