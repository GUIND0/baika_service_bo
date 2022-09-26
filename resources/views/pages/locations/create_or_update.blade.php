@extends('partials.main')

@section('content')
<div class="row">
    {{--create form --}}
    <div class="col-md-12">
    <form action="{{ route('location.store') }}" method='POST' role="form" id="form">
            @csrf
        <input type="hidden" name="id" value="{{ $location->id ?? '' }}">
        <div class="card card-box">
            <div class="card-body">
                <div class="row">
                    <div class="divider divider-primary">
                        <div class="divider-text" style="font-size: 28px">Generale</div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <div class="form-group">
                            <label>Type Location</label><span class="text-danger">*</span>
                            <select class="form-control" name="type_location" id="type_location"  style="width: 100%;">'
                                <option value=""> --- Veuillez selectionner un type de location ---</option>
                                @foreach($type_locations as $type_location)
                                    <option {{ $location != null ? $location->type_location_id == $type_location->id ? 'selected' : '' : old('type_location') == $type_location->id ? 'selected' : '' }} value="{{ $type_location->id }}"> {{ $type_location->libelle }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type_location'))
                                <span class="help-block text-danger">
                                    <ul role="alert"><li>{{ $errors->first('type_location') }}</li></ul>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <div class="form-group">
                            <label class="control-label">Prix(F CFA) <span class="text-danger"> *</span></label>
                            <input type="text" name="prix" class="form-control prix {{ $errors->has('prix') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->prix : old('prix') }}" placeholder="Prix" id="prix" required/>
                            @if($errors->has('prix'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('prix') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="modele" class="control-label">Modele</label>
                        <select class="form-select {{ $errors->has('modele') ? 'is-invalid' : ''}}" id="modele" name="modele" aria-label="Default select example" aria-placeholder="Choisir modele ..." required>
                            <option>---- Selectionner le modele ----</option>
                            <option value="Toyota" {{ ($location != null ? $location->modele == 'Toyota' : old('modele')) == "Toyota" ? 'selected' : '' }}>Toyota</option>
                            <option value="Mercedes" {{ ($location != null ? $location->modele == 'Mercedes' : old('modele')) == "Mercedes" ? 'selected' : '' }}>Mercedes</option>
                            <option value="Nissan" {{ ($location != null ? $location->modele == 'Nissan' : old('modele')) == "Nissan" ? 'selected' : '' }}>Nissan</option>
                            </select>
                        @if($errors->has('modele'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('modele') }}</li>
                            </span>

                        @endif
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="etat" class="control-label">Etat</label>
                        <select class="form-select {{ $errors->has('etat') ? 'is-invalid' : ''}}" id="etat" name="etat" aria-label="Default select example" aria-placeholder="Choisir etat ..." required>
                            <option value="Neuf" {{ ($location != null ? $location->etat == 'Neuf' : old('etat')) == "Neuf" ? 'selected' : '' }}>Neuf</option>
                            <option value="France au revoir" {{ ($location != null ? $location->etat == 'France au revoir' : old('etat')) == "France au revoir" ? 'selected' : '' }}>France au revoir</option>
                            <option value="Mauvaise" {{ ($location != null ? $location->etat == 'Mauvaise' : old('etat')) == "Mauvaise" ? 'selected' : '' }}>Mauvaise</option>
                            </select>
                        @if($errors->has('etat'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('etat') }}</li>
                            </span>

                        @endif
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="carburant" class="control-label">Carburant</label>
                        <select class="form-select {{ $errors->has('carburant') ? 'is-invalid' : ''}}" id="carburant" name="carburant" aria-label="Default select example" aria-placeholder="Choisir carburant ..." required>
                            <option value="Essence" {{ ($location != null ? $location->carburant == 'Essence' : old('carburant')) == "Essence" ? 'selected' : '' }}>Essence</option>
                            <option value="Gazoil" {{ ($location != null ? $location->carburant == 'Gazoil' : old('carburant')) == "Gazoil" ? 'selected' : '' }}>Gazoil</option>
                        </select>
                        @if($errors->has('carburant'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('carburant') }}</li>
                            </span>

                        @endif
                    </div>
                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Version <span class="text-danger">*</span></label>
                            <input type="text" min="1" max="3" name="version" class="form-control {{ $errors->has('version') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->version : old('version') }}" placeholder="version" required/>
                            @if($errors->has('version'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('version') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="statut" class="control-label">Statut</label>
                        <select class="form-select {{ $errors->has('statut') ? 'is-invalid' : ''}}" id="statut" name="statut" aria-label="Default select example" aria-placeholder="Choisir statut ..." required>
                            <option value="1" {{ ($location != null ? $location->statut == '1' : old('statut')) == "Libre" ? 'selected' : '' }}>Libre</option>
                            <option value="0" {{ ($location != null ? $location->statut == '0' : old('statut')) == "Loue" ? 'selected' : '' }}>Loue</option>
                            </select>
                        @if($errors->has('statut'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('statut') }}</li>
                            </span>

                        @endif
                    </div>
                    <div class="mb-3 col-md-3">
                        <div class="form-group">
                            <label class="control-label">Annee <span class="text-danger">*</span></label>
                            <input type="text" min="1" max="3" name="annee" class="form-control {{ $errors->has('annee') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->annee : old('annee') }}" placeholder="Annee" required/>
                            @if($errors->has('annee'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('annee') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="divider divider-primary">
                        <div class="divider-text" style="font-size: 28px">Interieure</div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Couleur Interieure <span class="text-danger">*</span></label>
                            <input type="text" min="1" max="3" name="couleur_interieure" class="form-control {{ $errors->has('couleur_interieure') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->couleur_interieure : old('couleur_interieure') }}" placeholder="couleur_interieure" required/>
                            @if($errors->has('couleur_interieure'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('couleur_interieure') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Salon <span class="text-danger">*</span></label>
                            <input type="text" min="1" max="3" name="salon" class="form-control {{ $errors->has('salon') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->salon : old('salon') }}" placeholder="salon" required/>
                            @if($errors->has('salon'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('salon') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <div class="form-group">
                            <label class="control-label">Nombre de porte <span class="text-danger">*</span></label>
                            <input type="number" min="1" max="3" name="nbre_porte" class="form-control {{ $errors->has('nbre_porte') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->nbre_portes : old('nbre_porte') }}" placeholder="Nombre de porte" required/>
                            @if($errors->has('nbre_porte'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('nbre_porte') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <div class="form-group">
                            <label class="control-label">Nombre de siege <span class="text-danger">*</span></label>
                            <input type="number" min="1" max="3" name="nbre_siege" class="form-control {{ $errors->has('nbre_siege') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->nbre_sieges : old('nbre_siege') }}" placeholder="Nombre de siege" required/>
                            @if($errors->has('nbre_siege'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('nbre_siege') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="vitesse" class="control-label">Vitesse</label>
                        <select class="form-select {{ $errors->has('vitesse') ? 'is-invalid' : ''}}" id="vitesse" name="vitesse" aria-label="Default select example" aria-placeholder="Choisir vitesse ..." required>
                            <option>----Selectionner Vitesse ----</option>
                            <option value="4" {{ ($location != null ? $location->vitesse == '4' : old('vitesse')) == "4" ? 'selected' : '' }}>4</option>
                            <option value="5" {{ ($location != null ? $location->vitesse == '5' : old('vitesse')) == "5" ? 'selected' : '' }}>5</option>
                            <option value="6" {{ ($location != null ? $location->vitesse == '6' : old('vitesse')) == "6" ? 'selected' : '' }}>6</option>
                            </select>
                        @if($errors->has('vitesse'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('vitesse') }}</li>
                            </span>

                        @endif
                    </div>

                    <div class="divider divider-primary">
                        <div class="divider-text" style="font-size: 28px">Exterieure</div>
                    </div>



                    <div class="mb-3 col-md-4">
                        <label for="carburant" class="control-label">Carburant</label>
                        <select class="form-select {{ $errors->has('carburant') ? 'is-invalid' : ''}}" id="carburant" name="carburant" aria-label="Default select example" aria-placeholder="Choisir carburant ..." required>
                            <option value="Essence" {{ ($location != null ? $location->carburant == 'Essence' : old('carburant')) == "Essence" ? 'selected' : '' }}>Essence</option>
                            <option value="Gazoil" {{ ($location != null ? $location->carburant == 'Gazoil' : old('carburant')) == "Gazoil" ? 'selected' : '' }}>Gazoil</option>
                        </select>
                        @if($errors->has('carburant'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('carburant') }}</li>
                            </span>

                        @endif
                    </div>


                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Carrosserie <span class="text-danger">*</span></label>
                            <input type="text" min="1" max="3" name="carrosserie" class="form-control {{ $errors->has('carrosserie') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->carrosserie : old('carrosserie') }}" placeholder="carrosserie" required/>
                            @if($errors->has('carrosserie'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('carrosserie') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Couleur Exterieure <span class="text-danger">*</span></label>
                            <input type="text" min="1" max="3" name="couleur_exterieure" class="form-control {{ $errors->has('couleur_exterieure') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->couleur_exterieure : old('couleur_exterieure') }}" placeholder="couleur_exterieure" required/>
                            @if($errors->has('couleur_exterieure'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('couleur_exterieure') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="divider divider-primary">
                        <div class="divider-text" style="font-size: 28px">Moteur</div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Moteur <span class="text-danger">*</span></label>
                            <input type="text" min="1" max="3" name="moteur" class="form-control {{ $errors->has('moteur') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->moteur : old('moteur') }}" placeholder="moteur" required/>
                            @if($errors->has('moteur'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('moteur') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Transmission <span class="text-danger">*</span></label>
                            <input type="text" min="1" max="3" name="transmission" class="form-control {{ $errors->has('transmission') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->transmission : old('transmission') }}" placeholder="transmission" required/>
                            @if($errors->has('transmission'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('transmission') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Puissance <span class="text-danger">*</span></label>
                            <input type="text" min="1" max="3" name="puissance" class="form-control {{ $errors->has('puissance') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->puissance : old('puissance') }}" placeholder="puissance" required/>
                            @if($errors->has('puissance'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('puissance') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Cylindre <span class="text-danger">*</span></label>
                            <input type="text" min="1" max="3" name="cylindre" class="form-control {{ $errors->has('cylindre') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->cylindre : old('cylindre') }}" placeholder="cylindre" required/>
                            @if($errors->has('cylindre'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('cylindre') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Consommation <span class="text-danger">*</span></label>
                            <input type="text" min="1" max="3" name="consommation" class="form-control {{ $errors->has('consommation') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->consommation : old('consommation') }}" placeholder="consommation" required/>
                            @if($errors->has('consommation'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('consommation') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Description<span class="text-danger">*</span></label>
                            <input type="text" min="1" max="3" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->description : old('description') }}" placeholder="description" required/>
                            @if($errors->has('description'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('description') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Categorie<span class="text-danger">*</span></label>
                            <input type="text" min="1" max="3" name="categorie" class="form-control {{ $errors->has('categorie') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->categorie : old('categorie') }}" placeholder="categorie" required/>
                            @if($errors->has('categorie'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('categorie') }}</li>
                            </span>
                            @endif
                        </div>
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
        </div>
        </form>
    </div>
</div>
@endsection
@section('script')

<script>
   $(function() {
    $('.prix').mask("# ##0", {reverse: true});
  })


</script>
@endsection
