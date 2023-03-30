<nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
    <a href="" class="navbar-brand p-0">

            <h1 class="m-0">  <img class="img-fluid wow zoomIn" data-wow-delay="0.5s" src="{{ url('site/img/logoback.png')}}">BEKST-EXPRESS</h1>
        <!-- <img src="img/logo.png" alt="Logo"> -->
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('site.index') }}" class="nav-item nav-link active">Accueil</a>
            <a href="{{  route('login')  }}" class="nav-item nav-link">Admin</a>
            {{-- <a href="{{  route('site.domaine')  }}" class="nav-item nav-link">Domaine</a> --}}
            {{-- <a href="{{  route('site.contact')  }}" class="nav-item nav-link">Contact</a> --}}
        </div>
    </div>
</nav>
