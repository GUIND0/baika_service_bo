
@extends('partials.main')
@section('title1')Demande Auto Encours
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
           data: @json($demande_auto_encours),
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
                    field: 'automobile',
                    title: "Automobile",
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


        function actionsFormatter(value, row, index) {
            return `
                    <div class="btn-group" quartier="group">
                        <a href="" class="etatTraite btn btn-outline-success waves-effect" data-id="${value}" data-toggle="tooltip" title="Traiter">
                            Traiter
                        </a>
                        <a href="" data-id="${value}" class="etatRejete btn btn-outline-danger waves-effect" data-toggle="tooltip" title="Rejeter">
                            Rejeter
                        </a>
                    </div>`;
        }

        $('body').on('click', '.etatTraite', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Confirmation !',
                text: "Voulez-vous vraiment changer l'etat a traite ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, mettre a jour!',
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
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });
                    $.ajax({
                        url: `{{ route('demande_auto_change_etat','')}}/${id}?etat=traite`,
                        method: 'get',
                        cache: false,

                        success:function(result){
                            if(result=="ok"){
                               window.location.href = "{{ route('demande_auto_encours.index')}}";
                            }
                        }
                    });
                  }
            });
        });

        $('body').on('click', '.etatRejete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Confirmation !',
                text: "Voulez-vous vraiment changer l'etat a rejete ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, mettre a jour!',
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
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });
                    $.ajax({
                        url: `{{ route('demande_auto_change_etat','')}}/${id}?etat=rejete`,
                        method: 'get',
                        cache: false,

                        success:function(result){
                            if(result=="ok"){
                               window.location.href = "{{ route('demande_auto_encours.index')}}";
                            }
                        }
                    });
                  }
            });
        });
</script>
<script type="text/javascript">

</script>
@endsection
