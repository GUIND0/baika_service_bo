
@extends('partials.main')
@section('title1')Actualites
@endsection
@section('style')
<style>

</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <form action="{{route('actualite.store')}}" method='POST' actualite="form" id="form" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="actualite_id" value="{{$actualite->id ?? '' }}"/>

                <div class="card-body">
                    <div class="mb-3">
                        <label for="input-file-max-fs">Image |<small>Taille maximum 5Mo</small> <span class="text-danger">*</span></label>
                              <input type="file" id="input-file-max-fs" value="" name="image" class="dropify {{ $errors->has('image') ? 'is-invalid' : ''}}" data-max-file-size="5M" data-default-file=""  data-allowed-file-extensions="jpeg png jpg" />

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
    <div class="col-md-8">
        <div class="card card-box">
            <div class="card-body">
                <div id="toolbar" class="btn-group">
                    <a href="{{ route('actualite.index') }}"  class="btn btn-outline-success">
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
           data: @json($actualites),
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
                    field: 'image',
                    title: "Apercu",
                    sortable: true,
                    filterControl: "input",
                    formatter: imageFormatter,
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

        function imageFormatter(value,row,index){
            return `<img src="${value}" alt="..." class="img-thumbnail">`;
        }

        function ajaxRequest(params) {
            var url = "{{ url('actualite/paginate') }}"

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
                    <div class="btn-group" actualite="group">

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
                        url: "{{route('actualite.delete','')}}/"+id,
                        type: 'DELETE',
                        success: function(result) {
                            if(result == 'done'){
                                whichtr.addClass("bg-danger");
                                whichtr.fadeOut(2000, function(){
                                    this.remove();
                                 Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: 'Suppression du actualite',
                                    text: 'actualite supprimé avec succes !',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                //location.reload();
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
</script>
<script type="text/javascript">

</script>
@endsection
