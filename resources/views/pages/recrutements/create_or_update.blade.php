@extends('partials.main')
@section('title1')Ajout d'un recrutement
@endsection
@section('content')
<div class="row">
    {{--create form --}}
    <div class="col-md-12">
    <form action="{{ route('recrutement.store') }}" method='POST' role="form" id="form" enctype="multipart/form-data">
            @csrf
        <input type="hidden" name="id" value="{{ $recrutement->id ?? '' }}">
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
                                    value="{{ $recrutement != null ? $recrutement->nom : old('nom') }}" placeholder="nom" required/>
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
                                    value="{{ $recrutement != null ? $recrutement->prenom : old('prenom') }}" placeholder="prenom" required/>
                            @if($errors->has('prenom'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('prenom') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="control-label">Telephone <span class="text-danger"> *</span></label>
                            <input type="text" name="telephone" class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}"
                                    value="{{ $recrutement != null ? $recrutement->telephone : old('telephone') }}" placeholder="telephone" required/>
                            @if($errors->has('telephone'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('telephone') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                   <div class="col-6">
                        <div class="form-group">
                            <label class="control-label">Descrition <span class="text-danger"> *</span></label>
                            <input type="text" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                    value="{{ $recrutement != null ? $recrutement->description : old('description') }}" placeholder="description" required/>
                            @if($errors->has('description'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('description') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="statut" class="form-label">Statut</label><span class="text-danger"> *</span>
                        <select class="form-control {{ $errors->has('statut') ? 'is-invalid' : ''}}" id="statut" name="statut" aria-label="Default select example" aria-placeholder="Choisir statut ..." required>
                            <option value="">-- Statut --</option>
                            <option value="1" {{ ($recrutement != null ? $recrutement->statut == '1' : old('statut')) == "Activer" ? 'selected' : '' }}>Activer</option>
                            <option value="0" {{ ($recrutement != null ? $recrutement->statut == '0' : old('statut')) == "Desactiver" ? 'selected' : '' }}>Desactiver</option>
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
                          <input type="file" id="input-file-max-fs" value="{{ $recrutement_image ? $recrutement_image->path : ""}}" name="image" class="dropify {{ $errors->has('image') ? 'is-invalid' : ''}}" data-max-file-size="5M" data-default-file="{{ $recrutement_image !=null ? $recrutement_image->path : ""}}"  data-allowed-file-extensions="jpeg png jpg" />
                          @if($errors->has('image'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('image') }}</li>
                            </span>
                          @endif
                        </div>
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
