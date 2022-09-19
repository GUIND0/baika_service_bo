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

    <title>{{ config('app.name') }} - Page de connexion</title>

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
    <style>
		.bg {
		/* The image used */
		background-image: url("files/images/login.jpg");

		/* Full height */
		height: 100%;

		/* Center and scale the image nicely */
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		}


	</style>
  </head>

  <body class="bg">
    <!-- Content -->
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card" style="background-color: rgba(240, 240, 240,0.9);">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2 justify-content-center">
                    <img src="{{ asset('files/images/logo.png') }}"  width="300" height="250" alt="">
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Mot de passe oublié ? 🔒</h4>
              <p class="mb-4"> Veuillez saisir votre adresse e-mail pour récuperer votre mot de passe.</p>
            @if(isset($message))
                <div class="alert alert-success mt-1 alert-validation-msg" role="alert">
                    <div class="alert-body">
                        <i class="fa fa-check mr-1"></i>
                        <span>{{ $message }}</span>
                    </div>
                </div>
            @endif
              <form class="auth-login-form mt-1" action="#" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    autofocus
                  />
                </div>
                @if($errors->has('email'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('email') }}</li>
                    </span>
                @endif
                {{-- <button class="btn btn-primary d-grid w-100">Envoyer</button> --}}
              </form>
              <a class="btn btn-primary d-grid w-100" href="{{route('login')}}">Envoyer</a>
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
