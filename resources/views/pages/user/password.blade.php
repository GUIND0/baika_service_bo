<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/new/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ config('app.name') }} - Modification mot de passe </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/new/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/new/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/new/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/new/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/new/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/new/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/new/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="/new/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/new/assets/js/config.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-text demo text-body fw-bolder">{{ config('app.name') }}</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Modification du mot de passe </h4>
              <p class="mb-4"></p>

              <form class="auth-login-form mt-1" action="#" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $userPassword->users_id }}">
                <input type="hidden" name="id" value="{{ $userPassword->id }}">
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                      <label class="form-label" for="password">Nouveau mot de passe</label>
                    </div>
                    <div class="input-group input-group-merge">
                      <input type="password" id="password" class="form-control  {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="Nouveau mot de passe" aria-describedby="password">
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    @if($errors->has('password'))
                        <span class="help-block text-danger">
                            <ul role="alert"><li>{{ $errors->first('password') }}</li></ul>
                        </span>
                    @endif
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                      <label class="form-label" for="password_confirmation">Confirmation</label>
                    </div>
                    <div class="input-group input-group-merge">
                      <input type="password" id="password_confirmation" class="form-control  {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" placeholder="Confirmer le nouveau mot de passe" aria-describedby="password_confirmation">
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    @if($errors->has('password_confirmation'))
                        <span class="help-block text-danger">
                            <ul role="alert"><li>{{ $errors->first('password_confirmation') }}</li></ul>
                        </span>
                    @endif
                </div>
                <div class="mt-2 mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Valider</button>
                </div>
              </form>
              <br>
              <div class="text-center">
                <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                    <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                    Retour à la page connexion
                </a>
             </div>

            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/new/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/new/assets/vendor/libs/popper/popper.js"></script>
    <script src="/new/assets/vendor/js/bootstrap.js"></script>
    <script src="/new/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/new/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="/new/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
