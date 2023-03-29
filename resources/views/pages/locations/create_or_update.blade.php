@extends('partials.main')
@section('title1')Ajout d'une location
@endsection
@section('content')
<div class="row">
    {{--create form --}}
    <div class="col-md-12">
    <form action="{{ route('location.store') }}" method='POST' enctype="multipart/form-data" role="form" id="form">
            @csrf
        <input type="hidden" name="id" value="{{ $location->id ?? '' }}">
        <div class="card card-box">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            (<span class="text-danger">*</span>) Champs Obligatoires
                        </div>
                    </div>
                    <div class="divider divider-dark">
                        <div class="divider-text" style="font-size: 28px">Generale</div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <div class="form-group">
                            <label>Type Location</label><span class="text-danger"> *</span>
                            <select class="form-control" name="type_location" id="type_location"  style="width: 100%;">'
                                <option value=""> --- Veuillez selectionner un type de location ---</option>
                                @foreach($type_locations as $type_location)
                                    <option {{ $location != null ? $location->type_locations_id == $type_location->id ? 'selected' : '' : old('type_location') == $type_location->id ? 'selected' : '' }} value="{{ $type_location->id }}"> {{ $type_location->libelle }}</option>
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
                        <label for="modele" class="control-label">Modele<span class="text-danger"> *</span></label>
                        <select class="form-select {{ $errors->has('modele') ? 'is-invalid' : ''}}" id="modele" name="modele" aria-label="Default select example" aria-placeholder="Choisir modele ..." required>
                            <option value="">---- Selectionner le modele ----</option>
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
                        <label for="etat" class="control-label">Etat<span class="text-danger"> *</span></label>
                        <select class="form-select {{ $errors->has('etat') ? 'is-invalid' : ''}}" id="etat" name="etat" aria-label="Default select example" aria-placeholder="Choisir etat ..." required>
                            <option value=""> --  Etat  --</option>
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
                        <div class="form-group">
                            <label class="control-label">Version</label>
                            <input type="text" name="version" class="form-control {{ $errors->has('version') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->version : old('version') }}" placeholder="version" />
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
                            <option value="">Statut</option>
                            <option value="1" {{ ($location != null ? $location->statut == '1' : old('statut')) == "Libre" ? 'selected' : '' }}>Libre</option>
                            <option value="0" {{ ($location != null ? $location->statut == '0' : old('statut')) == "Loue" ? 'selected' : '' }}>Loue</option>
                            </select>
                        @if($errors->has('statut'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('statut') }}</li>
                            </span>

                        @endif
                    </div>
                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Annee </label>
                            <input type="numeric"  max="{{ date('Y') }}" name="annee" class="form-control {{ $errors->has('annee') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->annee : old('annee') }}" placeholder="Annee" />
                            @if($errors->has('annee'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('annee') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 col-md-4">
                        <label for="carburant" class="control-label">Carburant</label><span class="text-danger"> *</span>
                        <select class="form-select {{ $errors->has('carburant') ? 'is-invalid' : ''}}" id="carburant" name="carburant" aria-label="Default select example" aria-placeholder="Choisir carburant ..." required>
                            <option value=""> -- Moteur -- </option>
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
                            <label class="control-label">Description</label>
                            <input type="text"  name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->description : old('description') }}" placeholder="description" />
                            @if($errors->has('description'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('description') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Couleur Exterieure <span class="text-danger"> *</span></label>
                            <input type="text" min="1" max="3" name="couleur_exterieure" class="form-control {{ $errors->has('couleur_exterieure') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->couleur_exterieure : old('couleur_exterieure') }}" placeholder="Couleur exterieure" required/>
                            @if($errors->has('couleur_exterieure'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('couleur_exterieure') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- <div class="divider divider-dark">
                        <div class="divider-text" style="font-size: 28px">Interieure</div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <div class="form-group">
                            <label class="control-label">Couleur Interieure</label>
                            <input type="text" min="1" max="3" name="couleur_interieure" class="form-control {{ $errors->has('couleur_interieure') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->couleur_interieure : old('couleur_interieure') }}" placeholder="Couleur interieure"/>
                            @if($errors->has('couleur_interieure'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('couleur_interieure') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <div class="form-group">
                            <label class="control-label">Salon</label>
                            <input type="text" min="1" max="3" name="salon" class="form-control {{ $errors->has('salon') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->salon : old('salon') }}" placeholder="Salon" />
                            @if($errors->has('salon'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('salon') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-2">
                        <div class="form-group">
                            <label class="control-label">Nombre de porte <span class="text-danger">*</span></label>
                            <input type="number" min="2" max="6" name="nbre_porte" class="form-control {{ $errors->has('nbre_porte') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->nbre_portes : old('nbre_porte') }}" placeholder="--"/>
                            @if($errors->has('nbre_porte'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('nbre_porte') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-2">
                        <div class="form-group">
                            <label class="control-label">Nombre de siege</label>
                            <input type="number" min="2" max="12" name="nbre_siege" class="form-control {{ $errors->has('nbre_siege') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->nbre_sieges : old('nbre_siege') }}" placeholder="--"/>
                            @if($errors->has('nbre_siege'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('nbre_siege') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="vitesse" class="control-label">Vitesse</label>
                        <select class="form-select {{ $errors->has('vitesse') ? 'is-invalid' : ''}}" id="vitesse" name="vitesse" aria-label="Default select example" aria-placeholder="Choisir vitesse ..." required>
                            <option>--</option>
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

                    <div class="divider divider-dark">
                        <div class="divider-text" style="font-size: 28px">Exterieure</div>
                    </div>

                    <div class="mb-3 col-md-3">
                        <div class="form-group">
                            <label class="control-label">Categorie</label>
                            <input type="text"  name="categorie" class="form-control {{ $errors->has('categorie') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->categorie : old('categorie') }}" placeholder="categorie"/>
                            @if($errors->has('categorie'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('categorie') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 col-md-3">
                        <div class="form-group">
                            <label class="control-label">Carrosserie </label>
                            <input type="text" min="1" max="3" name="carrosserie" class="form-control {{ $errors->has('carrosserie') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->carrosserie : old('carrosserie') }}" placeholder="carrosserie" />
                            @if($errors->has('carrosserie'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('carrosserie') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>



                    <div class="divider divider-dark">
                        <div class="divider-text" style="font-size: 28px">Moteur</div>
                    </div>



                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Moteur </label>
                            <input type="text" min="1" max="3" name="moteur" class="form-control {{ $errors->has('moteur') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->moteur : old('moteur') }}" placeholder="moteur" />
                            @if($errors->has('moteur'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('moteur') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>



                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Transmission </label>
                            <input type="text" min="1" max="3" name="transmission" class="form-control {{ $errors->has('transmission') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->transmission : old('transmission') }}" placeholder="transmission" />
                            @if($errors->has('transmission'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('transmission') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Puissance </label>
                            <input type="text" min="1" max="3" name="puissance" class="form-control {{ $errors->has('puissance') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->puissance : old('puissance') }}" placeholder="puissance"/>
                            @if($errors->has('puissance'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('puissance') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Cylindre </label>
                            <input type="text" min="1" max="3" name="cylindre" class="form-control {{ $errors->has('cylindre') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->cylindre : old('cylindre') }}" placeholder="cylindre"/>
                            @if($errors->has('cylindre'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('cylindre') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            <label class="control-label">Consommation </label>
                            <input type="text" min="1" max="3" name="consommation" class="form-control {{ $errors->has('consommation') ? 'is-invalid' : '' }}"
                                    value="{{ $location != null ? $location->consommation : old('consommation') }}" placeholder="consommation"/>
                            @if($errors->has('consommation'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('consommation') }}</li>
                            </span>
                            @endif
                        </div>
                    </div> --}}
                    <div class="divider divider-dark">
                        <div class="divider-text" style="font-size: 28px">Images</div>
                    </div>
                    @if ($location_images)
                        @foreach ( $location_images as $key => $location_image)
                        <div class="col" id="cl">
                            <div class="mb-3">
                                <div id="inputFormRow">
                                <label for="input-file-max-fs">Image {{ $key+1 }}</label>
                                <input type="file" id="input-file-max-fs" value="{{ $location_image->path}}" class="dropify" data-max-file-size="5M" data-default-file="{{ $location_image->path}}"  data-allowed-file-extensions="jpeg png jpg" readonly/>
                                </div>
                            </div>
                            <div class="input-group-append">
                                <button  data-id="{{$location_image->id}}" type="button" class="suppImage btn btn-danger"><i data-id="{{$location_image->id}}" class="fa fa-trash suppImage"></i></button>
                            </div>
                        </div>

                        @endforeach
                    @endif
                    <div class="mb-3 col-md-12">
                        <div id="inputFormRow">
                          <label for="input-file-max-fs">Taille maximum 5Mo <span class="text-danger">*</span></label>
                          <input type="file" id="input-file-max-fs" value="{{ $location !=null ? $location->image : "" }}"  name="images[]" class="dropify {{ $errors->has('image') ? 'is-invalid' : ''}}" data-max-file-size="5M" data-default-file="{{$location !=null ? $location->image : " "}}"  data-allowed-file-extensions="jpeg png jpg" multiple/>
                          @if($errors->has('image'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('image') }}</li>
                            </span>
                          @endif
                        </div>
                    </div>
                    <div id="newRow"></div>
                    <div class="mb-2">
                        <div class="row">
                            <div class="col-md-5">
                                <button id="addRow" type="button" class="btn btn-success mt-1 pull-left"><i class="fa fa-plus"></i></button>
                            </div>
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

<script type="text/javascript">
      // Add Row
      $("#addRow").click(function () {
        var html = '';
        html += '<div class="mb-3 col-md-12">';
            html += '<div id="inputFormRow">';
                html += '<label for="input-file-max-fs">Taille maximum 5Mo <span class="text-danger">*</span></label>';
                html += '<input type="file" id="input-file-max-fs" value=""  name="images[]" class="dropify" data-max-file-size="5M" data-default-file="{{$location !=null ? $location->image : " "}}"  data-allowed-file-extensions="jpeg png jpg"  multiple/>';
                html += '<div class="col-md-2">';
                    html += '<div class="input-group-append">';
                        html += '<button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                    html += '</div>';
                html += '</div>';
            html += '</div>';
        html += '</div>';
        $('#newRow').append(html);
    });

    // Remove Row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });

   $(function() {
    $('.prix').mask("# ##0", {reverse: true});
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

    $('body').on('click', '.suppImage', function (e) {
            e.preventDefault()
            var imageid = $(this).data('id');

            var cl = $(this).closest("#cl");

            Swal.fire({
                title: 'Confirmation !',
                text: "Voulez-vous vraiment supprimer cet élément ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: "Annuler",
                customClass: {
                    confirmButton: 'btn btn-primary m-1',
                    cancelButton: 'btn btn-outline-danger m-1',
                    closeOnConfirm: false
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{url('location/deleteImage')}}/" + imageid,
                        type: 'GET',
                        cache: false,
                        async: true,
                        success: function(result) {
                            if (result == 'done') {
                                cl.remove();
                                $.toast({
                                    heading: "Suppression alerte audio",
                                    text: "Alert audio supprimé avec succes",
                                    position: 'top-right',
                                    loaderBg:'green',
                                    icon: 'success',
                                    hideAfter: 15000,
                                    stack: 6,
                                });
                            } else {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Problème de suppression !'
                                });
                            }

                        },
                        error: function(error) {

                        }
                    }).done(function( rs ) {

                  if(rs == 1){
                    _cl.remove();
                  }
                });
                }
            });

        });

</script>
@endsection
