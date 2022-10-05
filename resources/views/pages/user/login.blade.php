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
		height: 150%;

		/* Center and scale the image nicely */
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		}


	</style>
  </head>

  <body class="bg">
    <!-- Content -->
@include('flash-toastr::message')

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y ">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card" style="background-color: rgba(240, 240, 240,0.9);">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="" class="app-brand-link gap-2 justify-content-center">
                  <img src="{{ asset('files/images/logo.png') }}"  width="250" height="250" alt="">
                </a>
              </div>
              <!-- /Logo -->
              <h4>BienvenueBEKST</h4>
              <p>Veuillez-vous connecter.</p>
              @if(isset($message))
                <div class="alert alert-success mt-1 alert-validation-msg" role="alert">
                    <div class="alert-body">
                        <i class="fa fa-check mr-1"></i>
                        <span>{{ $message }}</span>
                    </div>
                </div>
            @endif
              <form id="formAuthentication" class="mb-3" action="#" method="POST">
                @csrf
                    @if($errors->has('login'))
                        <span class="help-block text-danger">
                            <li>{{ $errors->first('login') }}</li>
                        </span>
                    @endif
                <div class="mb-3">
                  <label for="telephone" class="form-label">Telephone</label>
                  <input
                    type="text"
                    class="form-control"
                    value="{{ old('telephone') }}" pattern="[0-9]{8}" name="telephone" id="telephone"
                    placeholder="telephone"
                    autofocus
                  />
                  @if($errors->has('telephone'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('telephone') }}</li>
                    </span>
                  @endif
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Mot de passe</label>
                    {{-- <a href="{{ route('mot_de_passe.form') }}">
                      <small>Mot de passe oublié?</small>
                    </a> --}}
                  </div>
                  <div class="input-group input-group-merge">
                    <input type="password" class="form-control" name="password" id="password" placeholder="......"  aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                  @if($errors->has('password'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('password') }}</li>
                    </span>
                 @endif
                </div>

                {{-- <div class="g-recaptcha" data-sitekey="{{ config('app.reCAPTCHA') }}"></div>
                @if($errors->has('g-recaptcha-response'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('g-recaptcha-response') }}</li>
                    </span>
                 @endif --}}
                <div class="mt-2 mb-3">
                  <button class="btn btn-success d-grid w-100" type="submit">Se connecter</button>
                </div>
              </form>
              {{-- <a class="btn btn-primary d-grid w-100" href="{{route('dashboard.index')}}">Se connecter</a> --}}

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
