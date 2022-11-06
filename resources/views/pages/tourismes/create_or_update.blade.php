@extends('partials.main')
@section('title1')Ajout d'un lieu de tourisme
@endsection
@section('content')
<div class="row">
    {{--create form --}}
    <div class="col-md-12">
    <form action="{{ route('tourisme.store') }}" method='POST' enctype="multipart/form-data" role="form" id="form">
            @csrf
        <input type="hidden" name="id" value="{{ $tourisme->id ?? '' }}">
        <div class="card card-box">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <div class="form-group">
                            (<span class="text-danger">*</span>) Champs Obligatoires
                        </div>
                    </div>
                    <div class="divider divider-dark">
                        <div class="divider-text" style="font-size: 28px">Formulaire de saisie</div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <div class="form-group">
                            <label class="control-label">Nom<span class="text-danger">*</span></label>
                            <input type="text" name="nom" class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}"
                                    value="{{ $tourisme != null ? $tourisme->nom : old('nom') }}" placeholder="nom" />
                            @if($errors->has('nom'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('nom') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="statut" class="control-label">Statut</label>
                        <select class="form-select {{ $errors->has('statut') ? 'is-invalid' : ''}}" id="statut" name="statut" aria-label="Default select example" aria-placeholder="Choisir statut ..." required>
                            <option value="">Statut</option>
                            <option value="1" {{ ($tourisme != null ? $tourisme->statut == '1' : old('statut')) == "Activer" ? 'selected' : '' }}>Activer</option>
                            <option value="0" {{ ($tourisme != null ? $tourisme->statut == '0' : old('statut')) == "Desactiver" ? 'selected' : '' }}>Desactiver</option>
                            </select>
                        @if($errors->has('statut'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('statut') }}</li>
                            </span>

                        @endif
                    </div>

                    <div class="mb-3 col-md-6">
                        <div class="form-group">
                            <label class="control-label">Lieu<span class="text-danger">*</span></label>
                            <input type="text"  name="lieu" class="form-control {{ $errors->has('lieu') ? 'is-invalid' : '' }}"
                                    value="{{ $tourisme != null ? $tourisme->lieu : old('lieu') }}" placeholder="Couleur interieure"/>
                            @if($errors->has('lieu'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('lieu') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <div class="form-group">
                            <label class="control-label">Description<span class="text-danger">*</span></label>
                            <input type="text"  name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                    value="{{ $tourisme != null ? $tourisme->description : old('description') }}" placeholder="description" />
                            @if($errors->has('description'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('description') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="divider divider-dark">
                        <div class="divider-text" style="font-size: 28px">Images</div>
                    </div>
                    @if ($tourisme_images)
                        @foreach ( $tourisme_images as $key => $tourisme_image)
                        <div class="col" id="cl">
                            <div class="mb-3">
                                <div id="inputFormRow">
                                <label for="input-file-max-fs">Image {{ $key+1 }}</label>
                                <input type="file" id="input-file-max-fs" value="{{ $tourisme_image->path}}" class="dropify" data-max-file-size="5M" data-default-file="{{ $tourisme_image->path}}"  data-allowed-file-extensions="jpeg png jpg" readonly/>
                                </div>
                            </div>
                            <div class="input-group-append">
                                <button  data-id="{{$tourisme_image->id}}" type="button" class="suppImage btn btn-danger"><i data-id="{{$tourisme_image->id}}" class="fa fa-trash suppImage"></i></button>
                            </div>
                        </div>

                        @endforeach
                    @endif
                    <div class="mb-3 col-md-12">
                        <div id="inputFormRow">
                          <label for="input-file-max-fs">Taille maximum 5Mo <span class="text-danger">*</span></label>
                          <input type="file" id="input-file-max-fs" value="{{ $tourisme !=null ? $tourisme->image : "" }}"  name="images[]" class="dropify {{ $errors->has('image') ? 'is-invalid' : ''}}" data-max-file-size="5M" data-default-file="{{$tourisme !=null ? $tourisme->image : " "}}"  data-allowed-file-extensions="jpeg png jpg" multiple/>
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
                html += '<input type="file" id="input-file-max-fs" value=""  name="images[]" class="dropify" data-max-file-size="5M" data-default-file="{{$tourisme !=null ? $tourisme->image : " "}}"  data-allowed-file-extensions="jpeg png jpg"  multiple/>';
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
                        url: "{{url('tourisme/deleteImage')}}/" + imageid,
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
