
@extends('partials.main')
@section('title1')Colis Livraison Traite
@endsection
@section('style')
<style>

</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-body">

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
           data: @json($colis_livraison_traite),
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
                    field: 'prenom',
                    title: "Prenom",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'nom',
                    title: "Nom",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'telephone',
                    title: "Telephone",
                    sortable: true,
                    filterControl: "input",
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
                    field: 'colis',
                    title: "Type de Coli",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'poids',
                    title: "Poids",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'valeur',
                    title: "Valeur",
                    sortable: true,
                    filterControl: "input",
                },
                // {
                //     field: 'id',
                //     title: "Actions",
                //     align: "center",
                //     formatter: actionsFormatter,
                //     width : "200"
                // }
            ]

        });


        function actionsFormatter(value, row, index) {
            return `
                    <div class="btn-group" quartier="group">
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
                        url: "{{route('quartier.delete','')}}/"+id,
                        type: 'DELETE',
                        success: function(result) {
                            if(result == 'done'){
                                whichtr.addClass("bg-danger");
                                whichtr.fadeOut(2000, function(){
                                    this.remove();
                                 Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: 'Suppression du quartier',
                                    text: 'Quartier supprimé avec succes !',
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
</script>
<script type="text/javascript">

</script>
@endsection
