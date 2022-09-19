@extends('partials.main')
@section('content')
    <!-- Not authorized-->
    <div class="misc-wrapper">
        <h2 class="mb-2 mx-2">Succès !</h2>
        <p class="mb-4 mx-2"> Votre mot de passe a été modifié avec succès.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Retour</a>
        <div class="mt-3">
          <img
            src="../assets/img/illustrations/page-misc-error-light.png"
            alt="page-misc-error-light"
            width="500"
            class="img-fluid"
            data-app-dark-img="illustrations/page-misc-error-dark.png"
            data-app-light-img="illustrations/page-misc-error-light.png"
          />
        </div>
      </div>
    <!-- / Not authorized-->
@endsection