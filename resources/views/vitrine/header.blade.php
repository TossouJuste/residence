<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container">
      <div class="header-container d-flex align-items-center justify-content-between">
        <div class="logo">
             <a href="{{ url('/') }}">
                 <span>
                    <img src="{{ asset('assets/media/logos/logo-cousac.jpeg') }}" alt="Logo Cousac"">


                 </span>
             </a>


          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html"><img src="assets/img2/logo.png" alt="" class="img-fluid"></a>-->
        </div>

            <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="/">Accueil</a></li>
                <li><a class="nav-link scrollto" href="/demande">Demande de logement</a></li>
                <li><a class="nav-link scrollto" href="/suivre">Suivre une demande</a></li>

                @if(session()->has('matricule_verifie'))
                <li>
                    <form action="{{ route('verification_matricule.logout') }}" method="GET" class="d-inline">
                    <button type="submit" class="btn btn-sm btn-danger ms-2">
                        <i class="bi bi-box-arrow-right me-1"></i> Quitter
                    </button>
                    </form>
                </li>
                @endif
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->


      </div><!-- End Header Container -->
    </div>
  </header>
