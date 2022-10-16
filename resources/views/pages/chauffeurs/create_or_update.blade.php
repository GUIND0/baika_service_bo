@extends('partials.main')
@section('title1')Ajout d'un chauffeur
@endsection
@section('content')
<div class="row">
    {{--create form --}}
    <div class="col-md-12">
    <form action="{{ route('chauffeur.store') }}" method='POST' role="form" id="form" enctype="multipart/form-data">
            @csrf
        <input type="hidden" name="id" value="{{ $chauffeur->id ?? '' }}">
        <div class="card card-box">
            <div class="card-body">
                <div class="mb-3 col-md-12">
                    <div class="form-group">
                        (<span class="text-danger">*</span>) Champs Obligatoires
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <div class="form-group">
                            <label class="control-label">Nom <span class="text-danger"> *</span></label>
                            <input type="text" name="nom" class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}"
                                    value="{{ $chauffeur != null ? $chauffeur->nom : old('nom') }}" placeholder="nom" required/>
                            @if($errors->has('nom'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('nom') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="control-label">Prenom <span class="text-danger"> *</span></label>
                            <input type="text" name="prenom" class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}"
                                    value="{{ $chauffeur != null ? $chauffeur->prenom : old('prenom') }}" placeholder="prenom" required/>
                            @if($errors->has('prenom'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('prenom') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-6">
                            <label  class="form-label">Categorie Permi</label><span class="text-danger"> *</span>
                            <select class="form-control {{ $errors->has('categorie_permi') ? 'is-invalid' : ''}}" name="categorie_permi" id="categorie_permi"  style="width: 100%;" required>
                                <option value=""> --- Veuillez selectionner un type auto ---</option>
                                @foreach($categorie_permis as $categorie_permi)
                                    <option {{ $chauffeur != null ? $chauffeur->categorie_permis_id == $categorie_permi->id ? 'selected' : '' : old('categorie_permi') == $categorie_permi->id ? 'selected' : '' }} value="{{ $categorie_permi->id }}"> {{ $categorie_permi->libelle }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('categorie_permi'))
                                <span class="help-block text-danger">
                                    <ul role="alert"><li>{{ $errors->first('categorie_permi') }}</li></ul>
                                </span>
                            @endif
                    </div>
                    <div class="mb-3 col-6">
                        <label for="statut" class="form-label">Statut</label><span class="text-danger"> *</span>
                        <select class="form-control {{ $errors->has('statut') ? 'is-invalid' : ''}}" id="statut" name="statut" aria-label="Default select example" aria-placeholder="Choisir statut ..." required>
                            <option value="">-- Statut --</option>
                            <option value="1" {{ ($chauffeur != null ? $chauffeur->statut == '1' : old('statut')) == "Activer" ? 'selected' : '' }}>Activer</option>
                            <option value="0" {{ ($chauffeur != null ? $chauffeur->statut == '0' : old('statut')) == "Desactiver" ? 'selected' : '' }}>Desactiver</option>
                            </select>
                        @if($errors->has('statut'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('statut') }}</li>
                            </span>

                        @endif
                    </div>

                    <div class="mb-3 col-md-12">
                        <div id="inputFormRow">
                          <label for="input-file-max-fs">Image |<small>Taille maximum 5Mo</small> <span class="text-danger">*</span></label>
                          <input type="file" id="input-file-max-fs" value="{{ $chauffeur_image ? $chauffeur_image->path : ""}}" name="image" class="dropify {{ $errors->has('image') ? 'is-invalid' : ''}}" data-max-file-size="5M" data-default-file="{{ $chauffeur_image !=null ? $chauffeur_image->path : ""}}"  data-allowed-file-extensions="jpeg png jpg" />
                          @if($errors->has('image'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('image') }}</li>
                            </span>
                          @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label>Charger le cv</label>
                        <input type="file" accept="application/pdf" name="cv"  id="cv" class=""   {{ $errors->has('file') ? 'is-invalid' : '' }} required>
                         @if($errors->has('file'))
                            <span class="help-block text-danger">
                                <ul role="alert"><li>{{ $errors->first('file') }}</li></ul>
                            </span>
                        @endif
                    </div>
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
        </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
  $(function() {
    $('#toFormat1').maskMoney();
    $('#toFormat2').maskMoney();
    $('#toFormat3').maskMoney();
  })
  $('.dropify').dropify({
        messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, fichier trop volumineux'
        },
        error: {
            'fileSize': 'Désolé, fichier trop volumineux.',
            'imageFormat': 'Seul les formats (xxx sont autorisés).'
        }
    });
  $('.timepicker').datetimepicker({
    format: 'HH:mm',

  })
</script>
@endsection
