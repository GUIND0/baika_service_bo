@extends('partials.main')
@section('title1')Liste des evenements
@endsection
@section('content')
<div class="row">
    {{-- liste --}}
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-body">
                <div id="toolbar" class="btn-group">
                    <a href="{{ route('evenement.create_or_update') }}" id="addRow" class="btn btn-outline-success">
                        <i class="fa fa-plus"></i> Nouveau Evenement
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
    <div class="modal modal-top fade" id="details_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" style="max-width: 80%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Informations détaillées</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true" aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body" id="modalcontent">
                    <h3>Chargement en cours....</h3>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- end liste --}}
</div>
@endsection
@section('script')
<script>
    $( document ).ready(function() {
      $('body').on('click', '.sositem', function () {
          var id = $(this).data("idd");
          $("#details_modal").modal("show");
          $('#modalcontent').html('<h3>Chargement en cours....</h3>');
          $.ajax({
              url: "{{url('evenement/show')}}/" + id,
              cache: false,
              async: true
          })
          .done(function( html ) {
              $("#modalcontent").html(html);
          });
      });
  });
</script>
<script>

        $('#table-javascript').bootstrapTable({
            data: @json($evenements),
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
                    field: 'image',
                    title: "Apercu",
                    sortable: true,
                    filterControl: "input",
                    formatter: imageFormatter,
                },
                {
                    field: 'description',
                    title: "Description",
                    sortable: true,
                    filterControl: "input",
                },
                 {
                    field: 'lieu',
                    title: "Lieu",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'date',
                    title: "Date",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'heure',
                    title: "Heure",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'ticket_restant',
                    title: "Ticket Restant",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'prix',
                    title: "Prix (XOF)",
                    sortable: true,
                    filterControl: "input",
                    formatter:amountFormatter,
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
        function actifFormatter(value, row, index){
            if(value == 1){
              return '<span class="badge bg-success">Activer</span>';
            }
            return '<span class="badge bg-danger">Desactiver</span>';
        }

        function imageFormatter(value,row,index){
            return `<img src="${value}" alt="..." class="img-thumbnail">`;
        }

        function amountFormatter(value, row, index){
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        }
        function actionsFormatter(value, row, index) {
            return `<form action="{{ route('evenement.delete', '')}}/${value}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="btn-group" role="group">
                        <a title="Détails" href="#" data-idd="${value}" class="sositem btn btn-outline-info waves-effect" >
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('evenement.create_or_update')}}/${value}" class="btn btn-outline-dark waves-effect" data-toggle="tooltip" title="Modifier">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="#" type="button" class="deleteBtn btn btn-outline-danger waves-effect" data-id="${value}" title="Supprimer">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>`;
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
                        url: "{{route('evenement.delete','')}}/"+id,
                        type: 'DELETE',
                        success: function(result) {
                            if(result == 'done'){
                                 Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: 'Suppression du evenement',
                                    text: 'evenement supprimé avec succes !',
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

@endsection
