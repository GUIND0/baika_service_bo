@extends('layout.full')
@section('title1','Authentification')
@section('page-style')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-auth.css') }}">
    <!-- END: Page CSS-->
    <style>
        .blank-page {
            background-image : url("{{ url('/app-assets/images/background/background_1120.jpg') }}");
            height: 100%;
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endsection
@section('content')
<div class="auth-wrapper auth-v1">
    <div class="col-5 py-2">
        <!-- Login v1 -->
        <div class="card mb-0">
            <div class="card-body">
                <a href="javascript:void(0);" class="brand-logo">
                    <h2 class="brand-text text-primary ml-1">{{ config('app.name') }}</h2>
                </a>

                <div class="alert alert-danger  px-1" role="alert">

                    <p>Bonjour {{ $user->prenom .' '. $user->nom }}, Votre mot de passe actuel a expiré.</p>
                    <p>Veuillez choisir un nouveau mot de passe.</p>
                    <hr>
                    <p class="mb-0">Le nouveau mot de passe doit être different de l'actuel mot de passe.</p>
                </div>

                <form action="{{ route('changePasswordStore',$user->id) }}" method='POST' class="validate-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ancien_mot_de_passe">Ancien mot de passe <span class="text-danger">*</span></label>
                                <div class="input-group form-password-toggle input-group-merge">
                                    <input type="password" value="{{ old('ancien_mot_de_passe') }}" class="form-control {{ $errors->has('ancien_mot_de_passe') ? 'is-invalid' : '' }}" id="ancien_mot_de_passe" name="ancien_mot_de_passe" placeholder="Ancien mot de passe" />
                                    <div class="input-group-append">
                                        <div class="input-group-text cursor-pointer">
                                            <i data-feather="eye"></i>
                                        </div>
                                    </div>
                                </div>
                                @if($errors->has('ancien_mot_de_passe'))
                                <span class="help-block text-danger">
                                    <ul role="alert"><li>{{ $errors->first('ancien_mot_de_passe') }}</li></ul>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password">Nouveau mot de passe <span class="text-danger">*</span></label>
                                <div class="input-group form-password-toggle input-group-merge">
                                    <input type="password" value="{{ old('password') }}" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Nouveau mot de passe" />
                                    <div class="input-group-append">
                                        <div class="input-group-text cursor-pointer">
                                            <i data-feather="eye"></i>
                                        </div>
                                    </div>
                                </div>
                                @if($errors->has('password'))
                                    <span class="help-block text-danger">
                                        <ul role="alert"><li>{{ $errors->first('password') }}</li></ul>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password_confirmation">Confirmation <span class="text-danger">*</span></label>
                                <div class="input-group form-password-toggle input-group-merge">
                                    <input type="password" value="{{ old('password_confirmation') }}" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" name="password_confirmation" placeholder="Confirmation" />
                                    <div class="input-group-append">
                                        <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                    </div>
                                </div>
                                @if($errors->has('password_confirmation'))
                                    <span class="help-block text-danger">
                                        <ul role="alert"><li>{{ $errors->first('password_confirmation') }}</li></ul>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mt-1">Enregistrer</button>
                            <button type="reset" class="btn btn-outline-danger mt-1 ml-1">Réinitialiser</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Login v1 -->
    </div>
</div>


@endsection

@section('page-script')
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
@endsection
