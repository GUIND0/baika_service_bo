@extends('layout.full')

@section('title','Erreur 500')

@section('page-style')
<style>
    .limiter~.limiter {
    display: none;
}
</style>
@endsection  

@section('content')
    <!-- Not authorized-->
    <div class="misc-wrapper">
        <a class="navbar-brand" href="{{ route("home") }}">
            <h2 class="brand-logo text-primary mt-1 ml-1">
                {{ config('app.name') }}
            </h2>
        </a>
        <div class="misc-inner p-2 p-sm-3">
            <div class="w-100 text-center">
                <h2 class="mb-1">Internal Server Error</h2>
                <p class="mb-2">
                    Veuillez contacter l'administrateur du système.
                </p>
                <a class="btn btn-primary mb-1 btn-sm-block" href="{{ url()->previous() }}"> <i class="fa fa-arrow-left"></i> Retour</a>
            </div>
        </div>
    </div>
    <!-- / Not authorized-->
@endsection 

@section('page-script')

@endsection