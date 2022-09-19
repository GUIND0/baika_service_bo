@extends('partials.main')
@section('title1')Roles - Permissions
@endsection
@section('style')
    <style>

    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Vous éditez les permissions du role {{$role->libelle}}</h5>
            </div>
        </div>
    </div>
    <form action="{{route('role.permission_store')}}" method='POST' role="form" id="form" class="form-horizontal" >
        <div class="row">
                @csrf
        <input type="hidden" name="role_id" value="{{$role->id ?? '' }}"/>
        @foreach($data as $controller => $value)
        <div class="col-lg-6 mb-4 mb-xl-0 row-eq-height">
            <div class="demo-inline-spacing mt-3">
                <div class="list-group">
                    <a         href="#"
                               data-bs-toggle="collapse"
                               data-bs-target="#{{$controller}}"
                               aria-expanded="false"
                               aria-controls="{{$controller}}"
                               class="list-group-item list-group-item-action active">
                        {{$controller}}
                    </a>
                    <div class="collapse" id="{{$controller}}">
                        @foreach($value as $a=>$arr)
                            @foreach($arr as $c=>$action)
                                <label class="list-group-item">
                                    <input class="form-check-input me-1" name="controllers[]" type="checkbox" value="{{$controller}}.{{$action}}" {{ in_array($controller.".".$action,$selected) ?  'checked' : '' }} />
                                    {{$action}}
                                </label>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
            <div class="mb-3">
                <div class="row d-flex justify-content-center">
                    <div class="demo-inline-spacing d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">
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
@endsection
