@extends('partials.main')

@section('title1')Gestion des utilisateurs
@endsection
@section('content')
<div class="row">
    {{-- liste --}}
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-body">
                <div id="toolbar" class="btn-group">
                    <a href="{{ route('user.create') }}" class="btn btn-outline-primary">
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
    {{-- end liste --}}
</div>
@endsection
@section('script')

<script>

        $('#table-javascript').bootstrapTable({
            //data: @json($users),
             ajax:"ajaxRequest",
            queryParams: "queryParams",
            toolbar: "#toolbar",
            cache: false,
            striped: true,
            pagination: true,
            pageSize: 10,
            pageList: [10, 25, 50, 100, 200],
            sortOrder: "desc",
            //sortName: "libelle",
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
                    title: "Prénom",
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
                    field: 'role',
                    title: "Role",
                    sortable: true,
                    filterControl: "select",
                },
                {
                    field: 'localite',
                    title: "Localité",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'email',
                    title: "E-mail",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'etat',
                    title: "Etat",
                    sortable: true,
                    filterControl: "input",
                    align : "center",
                    formatter: actifFormatter,
                },
                {
                    field: 'last_login_at',
                    title: "Derniere connexion",
                    sortable: true,
                    filterControl: "input",
                    formatter:actionsFormatterDate,
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
            var url = "{{ url('user/paginate') }}"

            $.get(url + '?' + $.param(params.data)).then(function (res) {
            params.success(res);
          
            })
        };
        function queryParams(params)
        {
            return params
        }

        function actionsFormatter(value, row, index) {
            return `<form action="{{ route('user.destroy', '')}}/${value}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="btn-group" role="group">
                        <a href="#" class="reset btn btn-outline-dark waves-effect" data-id="${value}" data-toggle="tooltip title="Réinitialiser">
                            <i class="fa fa-key"></i>
                        </a>
                        <a href="{{ url('user/create/')}}/${value}" class="btn btn-outline-primary waves-effect" data-toggle="tooltip" title="Modifier">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="#" type="button" class="deleteBtn btn btn-outline-danger waves-effect" data-id="${value}" title="Supprimer">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>`;
        }

        function actifFormatter(value, row, index){
            if(value == 'actif'){
              return '<span class="badge bg-success">Actif</span>';
            }
            return '<span class="badge bg-danger">Inactif</span>';
        }
        function actionsFormatterDate(value,row,index){
            if(value){
               let d = new Date(value);
                let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
                let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
                let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
                let hour = new Intl.DateTimeFormat('en', { hour12: false, hour: 'numeric' }).format(d);
                let minute = new Intl.DateTimeFormat('en', { minute: '2-digit' }).format(d);
                   if(parseInt(minute)<10){
                            minute = "0"+minute;
                        }
                    let date =`${da}/${mo}/${ye} ${hour}:${minute}`;
                        return date;
            }
        }

       
        
        $('body').on('click', '.reset', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Confirmation !',
                text: "Voulez-vous vraiment réinitialiser le mot de passe de cet utilisateur ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, réinitialiser!',
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
                        url: "{{ route('user.reset') }}",
                        method: 'post',
                        cache: false,
                        async: true,
                        data: {
                            id: id
                        },
                        success:function(result){
                            if(result=="ok"){
                                window.location.href = "{{ route('user.index')}}";
                            }
                        }
                    });
                  }
            });
        });

        

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
                        url: "{{route('user.destroy','')}}/"+id,
                        type: 'DELETE',
                        success: function(result) {
                            if(result == 'done'){
                                whichtr.addClass("bg-danger");
                                whichtr.fadeOut(2000, function(){
                                    this.remove();
                                 Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: 'Suppression d\'utlisateur ',
                                    text: 'Utilisateur supprimé avec succes !',
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
@endsection
