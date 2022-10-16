@extends('partials.main')
@section('title1')Ajout d'un evenement
@endsection
@section('content')
<div class="row">
    {{--create form --}}
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Formulaire d'enregistrement.
                <a href="{{ route('evenement.index') }}" class="btn btn-outline-success pull-right">
                    <i class="fa fa-arrow-left"></i> Retour
                </a>
            </h5>
            <form action="{{ route('evenement.store') }}" method='POST' role="form" id="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $evenement->id ?? '' }}">
                <div class="card-body">
                    <div class="mb-3 col-md-6">
                        <div class="form-group">
                            (<span class="text-danger">*</span>)Champs Obligatoires
                        </div>
                    </div>
                   <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="control-label">Ticket Restant <span class="text-danger"> *</span></label>
                            <input type="numeric" name="ticket_restant" class="form-control {{ $errors->has('ticket_restant') ? 'is-invalid' : '' }}"
                                    value="{{ $evenement != null ? $evenement->ticket_restant : old('ticket_restant') }}" placeholder="Ticket Restant" required/>
                            @if($errors->has('ticket_restant'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('ticket_restant') }}</li>
                            </span>
                            @endif
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Prix(F CFA) <span class="text-danger"> *</span></label>
                                <input type="text" name="prix" class="form-control prix {{ $errors->has('prix') ? 'is-invalid' : '' }}"
                                        value="{{ $evenement != null ? $evenement->prix : old('prix') }}" placeholder="Prix" id="prix" required/>
                                @if($errors->has('prix'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('prix') }}</li>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Date <span class="text-danger"> *</span></label>
                                <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date" name="date"  id="html5-time-input"
                                value="{{ $evenement != null ? $evenement->date : old('date') }}" placeholder="Date de l'evenement" required />
                                @if($errors->has('date'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('date') }}</li>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Heure <span class="text-danger"> *</span></label>
                                <input type="time" name="heure" class="form-control  {{ $errors->has('heure') ? 'is-invalid' : '' }}"
                                        value="{{ $evenement != null ? $evenement->heure : old('heure') }}" placeholder="Heure de l'evenement" required/>
                                @if($errors->has('heure'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('heure') }}</li>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Lieu <span class="text-danger"> *</span></label>
                                <input type="text" name="lieu" class="form-control  {{ $errors->has('lieu') ? 'is-invalid' : '' }}"
                                        value="{{ $evenement != null ? $evenement->lieu : old('lieu') }}" placeholder="lieu de l'evenement" required/>
                                @if($errors->has('lieu'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('lieu') }}</li>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Description <span class="text-danger"> *</span></label>
                                <input type="text" name="description" class="form-control  {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                        value="{{ $evenement != null ? $evenement->description : old('description') }}" placeholder="description de l'evenement" required/>
                                @if($errors->has('description'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('description') }}</li>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 col-md-12">
                            <div id="inputFormRow">
                              <label for="input-file-max-fs">Image |<small>Taille maximum 5Mo</small> <span class="text-danger">*</span></label>
                              <input type="file" id="input-file-max-fs" value="{{ $evenement_image ? $evenement_image->path : ""}}" name="image" class="dropify {{ $errors->has('image') ? 'is-invalid' : ''}}" data-max-file-size="5M" data-default-file="{{ $evenement_image !=null ? $evenement_image->path : ""}}"  data-allowed-file-extensions="jpeg png jpg" />
                              @if($errors->has('image'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('image') }}</li>
                                </span>
                              @endif
                            </div>
                        </div>


                        <div class="mb-3 col-6">
                            <label for="statut" class="form-label">Statut</label><span class="text-danger"> *</span>
                            <select class="form-control {{ $errors->has('statut') ? 'is-invalid' : ''}}" id="statut" name="statut" aria-label="Default select example" aria-placeholder="Choisir statut ..." required>
                                <option value="">-- Statut --</option>
                                <option value="1" {{ ($evenement != null ? $evenement->statut == '1' : old('statut')) == "Activer" ? 'selected' : '' }}>Activer</option>
                                <option value="0" {{ ($evenement != null ? $evenement->statut == '0' : old('statut')) == "Desactiver" ? 'selected' : '' }}>Desactiver</option>
                                </select>
                            @if($errors->has('statut'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('statut') }}</li>
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
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')

<script>
   $(function() {
    $('.prix').mask("# ##0", {reverse: true});
  })


</script>
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


