@extends('partials.main')
@section('title1')Liste des locations
@endsection
@section('content')
<div class="row">
    {{-- liste --}}
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-body">
                <div id="toolbar" class="btn-group">
                    <a href="{{ route('location.create_or_update') }}" id="addRow" class="btn btn-outline-primary">
                        <i class="fa fa-plus"></i> Nouveau location
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
    {{-- end liste --}}
</div>
@endsection
@section('script')

<script>

        $('#table-javascript').bootstrapTable({
            data: @json($locations),
            toolbar: "#toolbar",
            cache: false,
            striped: true,
            pagination: true,
            pageSize: 10,
            pageList: [10, 25, 50, 100, 200],
            sortOrder: "asc",
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
            columns: [
                {
                    title: 'state',
                    checkbox: true,
                },
                {
                    field: 'modele',
                    title: "Modele",
                    sortable: true,
                    filterControl: "input",
                },
                 {
                    field: 'etat',
                    title: "Etat",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'version',
                    title: "Version",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'nbre_portes',
                    title: "Nombre de porte",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'nbre_sieges',
                    title: "Nombre de siege",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'couleur_exterieure',
                    title: "Couleur Exterieure",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'prix',
                    title: "Prix (XOF)",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'statut',
                    title: "Statut",
                    sortable: true,
                    filterControl: "input",
                    align : "center",
                    formatter: actifFormatter,
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

        function actionsFormatter(value, row, index) {
            return `<form action="{{ route('location.delete', '')}}/${value}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="btn-group" role="group">
                        <a href="{{ route('location.create_or_update')}}/${value}" class="btn btn-outline-primary waves-effect" data-toggle="tooltip" title="Modifier">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="#" type="button" class="deleteBtn btn btn-outline-danger waves-effect" data-id="${value}" title="Supprimer">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>`;
        }

        function actifFormatter(value, row, index){
            if(value == 1){
              return '<span class="badge bg-success">Disponible</span>';
            }
            return '<span class="badge bg-danger">Loue</span>';
        }

        function amountFormatter(value, row, index){
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        }

         $('body').on('click', '.deleteBtn', function (e) {
            e.preventDefault()
            var id = $(this).data("id");

            Swal.fire({
                title: 'Confirmation !',
                text: "Voulez-vous vraiment supprimer cet élément ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: "Annuler",
                customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ml-1',
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
                        url: "{{route('location.delete','')}}/"+id,
                        type: 'DELETE',
                        success: function(result) {
                            if(result == 'done'){
                                 Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: 'Suppression du location',
                                    text: 'Location supprimé avec succes !',
                                    showConfirmButton: false,
                                    timer: 5000
                                });
                                location.reload();
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
<script>
  $(function() {
    $('#toFormat1').maskMoney();
    $('#toFormat2').maskMoney();
    $('#toFormat3').maskMoney();
  })
</script>
@endsection
