
@extends('partials.main')
@section('title1')tineraires
@endsection
@section('style')
<style>

</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <form action="{{route('itineraire.store')}}" method='POST' itineraire="form" id="form" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="itineraire_id" value="{{$itineraire->id ?? '' }}"/>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="prix_min" class="form-label">Prix Min</label>
                                <input type="text" id="prix_min" name ="prix_min" class="form-control prix_min {{ $errors->has('prix_min') ? 'is-invalid' : ''}}" id="prix_min" placeholder="Veuillez saisir le prix min..."  value="{{ $itineraire != null ? $itineraire->prix_min : old('prix_min') }}" required>
                                @if($errors->has('prix_min'))
                                    <span class="help-block text-danger">
                                        <li>{{ $errors->first('prix_min') }}</li>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="prix_max" class="form-label">Prix Max</label>
                                <input type="text" id="prix_max" name ="prix_max" class="form-control prix_max {{ $errors->has('prix_max') ? 'is-invalid' : ''}}" id="prix_max" placeholder="Veuillez saisir le prix max..."  value="{{ $itineraire != null ? $itineraire->prix_max : old('prix_max') }}" required>
                                @if($errors->has('prix_max'))
                                    <span class="help-block text-danger">
                                        <li>{{ $errors->first('prix_max') }}</li>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="md-3">
                                <label class="form-label">Depart</label><span class="text-danger"> *</span>
                                <select class="form-control" name="depart" id="depart"  style="width: 100%;">
                                    <option value=""> --- Veuillez selectionner un depart ---</option>
                                    @foreach($quartiers as $quartier)
                                        <option {{ $itineraire != null ? $itineraire->quartier_id == $quartier->id ? 'selected' : '' : old('depart') == $quartier->id ? 'selected' : '' }} value="{{ $quartier->id }}"> {{ $quartier->libelle }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('depart'))
                                    <span class="help-block text-danger">
                                        <ul role="alert"><li>{{ $errors->first('depart') }}</li></ul>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-3">
                                <label class="form-label">Arrive</label><span class="text-danger"> *</span>
                                <select class="form-control" name="arrive" id="arrive"  style="width: 100%;">
                                    <option value=""> --- Veuillez selectionner un arrive ---</option>
                                    @foreach($quartiers as $quartier)
                                        <option {{ $itineraire != null ? $itineraire->quartier_id == $quartier->id ? 'selected' : '' : old('arrive') == $quartier->id ? 'selected' : '' }} value="{{ $quartier->id }}"> {{ $quartier->libelle }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('arrive'))
                                    <span class="help-block text-danger">
                                        <ul role="alert"><li>{{ $errors->first('arrive') }}</li></ul>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-3">
                                <label class="form-label">Chauffeur</label><span class="text-danger"> *</span>
                                <select class="form-control" name="chauffeur" id="chauffeur"  style="width: 100%;">
                                    <option value=""> --- Veuillez selectionner un chauffeur ---</option>
                                    @foreach($chauffeurs as $chauffeur)
                                        <option {{ $itineraire != null ? $itineraire->chauffeur_id == $chauffeur->id ? 'selected' : '' : old('chauffeur') == $chauffeur->id ? 'selected' : '' }} value="{{ $chauffeur->id }}"> {{ $chauffeur->nom }} {{ $chauffeur->prenom }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('chauffeur'))
                                    <span class="help-block text-danger">
                                        <ul role="alert"><li>{{ $errors->first('chauffeur') }}</li></ul>
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
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-body">
                <div id="toolbar" class="btn-group">
                    <a href="{{ route('itineraire.index') }}"  class="btn btn-outline-success">
                        <i class="fa fa-plus"></i> Nouveau
                    </a>
                </div>
                <div class="table-responsive table-scrollable">
                    <table class="table table-bordered table-hover" id="table-javascript">
                        <thead class="thead-light"></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script>
    $('#table-javascript').bootstrapTable({
           data: @json($itineraires),
            toolbar: "#toolbar",
            cache: false,
            striped: true,
            pagination: true,
            pageSize: 10,
            pageList: [10, 25, 50, 100, 200],
            sortOrder: "desc",
            sortName: "libelle",
            locale: "fr-FR",
            search: true,
            searchAlign : "right",
            minimumCountColumns: 2,
            clickToSelect: false,
            toolbar: "#toolbar",
            toggle: "tooltip",
            tooltip: true,
            showFooter: false,
            showLoading: true,
            showExport: true,
            showPaginationSwitch: true,
            exportTypes: ['json', 'xml', 'csv', 'txt', 'excel', 'pdf'],
            exportDataType : "selected",
            mobileResponsive: true,
            showColumns: true,
            showMultiSort: true,
            filterControl: true,
            fixedNumber: 8,
            fixedRightNumber: 10,
            sidePagination: 'server',
            columns: [
                {
                    title: 'state',
                    checkbox: true,
                },
                {
                    field: 'depart',
                    title: "Depart",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'arrive',
                    title: "Arrive",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'prix_min',
                    title: "Prix Min",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'prix_max',
                    title: "Prix Max",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'chauffeur',
                    title: "Chauffeur",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'id',
                    title: "Actions",
                    align: "center",
                    formatter: actionsFormatter,
                    width : "200"
                }
            ]

        });

        function ajaxRequest(params) {
            var url = "{{ url('itineraire/paginate') }}"

            $.get(url + '?' + $.param(params.data)).then(function (res) {
            params.success(res);

            })
        };
        function queryParams(params)
        {
            return params
        }

        function actionsFormatter(value, row, index) {
            return `
                    <div class="btn-group" itineraire="group">
                        <a href="{{ route('itineraire.index','')}}/${value}" class="btn btn-outline-dark waves-effect" data-toggle="tooltip" title="Modifier">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="#" type="button" class="deleteBtn btn btn-outline-danger waves-effect" data-id="${value}" title="Supprimer">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>`;
        }

        $('body').on('click', '.deleteBtn', function (e) {
            e.preventDefault()
            var id = $(this).data("id");
            var whichtr= $(this).closest("tr");
            Swal.fire({
                title: 'Confirmation !',
                text: "Voulez-vous vraiment supprimer cet élément ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: "Annuler",
                customClass: {
                confirmButton: 'btn btn-primary m-2',
                cancelButton: 'btn btn-outline-danger m-2',
                closeOnConfirm: false
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('itineraire.delete','')}}/"+id,
                        type: 'DELETE',
                        success: function(result) {
                            if(result == 'done'){
                                whichtr.addClass("bg-danger");
                                whichtr.fadeOut(2000, function(){
                                    this.remove();
                                 Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: 'Suppression du itineraire',
                                    text: 'itineraire supprimé avec succes !',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                //itineraire.reload();
                            });
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Problème de suppression !'
                                });
                            }

                        },
                        error: function (error) {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Problème de suppression !'
                                });
                        }
                    });
                }
            });

        });
</script>
<script type="text/javascript">

</script>
<script>
    $(function() {
     $('.prix').mask("# ##0", {reverse: true});
   })


 </script>
@endsection
