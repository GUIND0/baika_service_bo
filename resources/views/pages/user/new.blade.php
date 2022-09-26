@extends('partials.main')

@section('title1')
    Ajout d'un utilisateur
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Formulaire d'enregistrement.  <a href="{{ route('user.index') }}" class="btn btn-outline-primary pull-right">
                    <i class="fa fa-arrow-left"></i> Retour
                </a></h5>
                <form action="{{ route('user.store') }}" method='POST' user="form" id="form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                <input type="hidden" name="user_id" value="{{$user->id ?? '' }}"/>

                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control {{ $errors->has('nom') ? 'is-invalid' : ''}}" id="nom" placeholder="Veuillez saisir le nom..."  value="{{ $user != null ? $user->nom : old('nom') }}" required>
                            @if($errors->has('nom'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('nom') }}</li>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control {{ $errors->has('prenom') ? 'is-invalid' : ''}}" id="prenom" placeholder="Veuillez saisir le prénom..."  value="{{ $user != null ? $user->prenom : old('prenom') }}" required>
                            @if($errors->has('prenom'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('prenom') }}</li>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" id="email" placeholder="Veuillez saisir l'email..."  value="{{ $user != null ? $user->email : old('email') }}">
                            @if($errors->has('email'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('email') }}</li>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Télephone (8 chiffres)</label>
                            <input type="text" name="telephone" pattern="[0-9]{8}" class="form-control {{ $errors->has('telephone') ? 'is-invalid' : ''}}" id="telephone" placeholder="Veuillez saisir le télephone..."  value="{{ $user != null ? $user->telephone : old('telephone') }}" required>
                            @if($errors->has('telephone'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('telephone') }}</li>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select data-placeholder="Choisir role ..." class="form-select" id="role" name="role" aria-label="Choisir un role" required>
                                <option value=""> --- Veuillez selectionner un role ---</option>
                                @foreach($roles as $role)
                                    <option {{ ($user == null ? '' : ($user->roles_id == $role->id))  ? 'selected' : ''  }} {{ old('role') == $role->id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->libelle }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('role'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('role') }}</li>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="etat" class="form-label">Statut</label>
                            <select class="form-select {{ $errors->has('etat') ? 'is-invalid' : ''}}" id="etat" name="etat" aria-label="Default select example" aria-placeholder="Choisir statut ..." required>
                                <option value="1" {{ ($user != null ? $user->statut == 1 : old('etat')) == "Actif" ? 'selected' : '' }}>Actif</option>
                                <option value="0" {{ ($user != null ? $user->statut == 0 : old('etat') )== "Inactif" ? 'selected' : '' }}>Inactif</option>
                                </select>
                            @if($errors->has('etat'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('etat') }}</li>
                                </span>

                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="Genre">Sexe <span class="text-danger">*</span></label>
                                <select data-placeholder="Choisir genre ..." class="form-select" id="genre" name="genre" ria-placeholder="Choisir sexe ..." >
                                    <option></option>
                                    <option value="H" {{ ($user != null ? $user->sexe == "H" : old('genre')) == "Homme" ? 'selected' : ''}}>Homme</option>
                                    <option value="F" {{($user != null ? $user->sexe == "F" : old('genre')) == "Femme" ? 'selected' : '' }}>Femme</option>
                                </select>
                                @if($errors->has('genre'))
                                <span class="help-block text-danger">
                                    <ul user="alert"><li>{{ $errors->first('genre') }}</li></ul>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row d-flex justify-content-center">
                            <div class="demo-inline-spacing d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">
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

@section('script')
    <script>

    </script>
@endsection
