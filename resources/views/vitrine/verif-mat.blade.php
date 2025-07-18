<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Faire une demande</title>
  <meta content="Système de gestion des résidences universitaires" name="description" />
  <link href="{{ asset('assets/media/logos/logo-cousac.jpeg') }}" rel="icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Raleway:300,400,600|Poppins:300,400,600" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor2/aos/aos.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor2/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor2/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor2/boxicons/css/boxicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor2/glightbox/css/glightbox.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor2/remixicon/remixicon.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor2/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css2/style.css') }}" rel="stylesheet" />
</head>

<body>
  @include('vitrine.header')

  <main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>DEMANDE DE LOGEMENT</h2>
          <ol>
            <li><a href="/">Accueil</a></li>
            <li>Demande de logement</li>
          </ol>
        </div>
      </div>
    </section>

    <section class="portfolio-details">
      <div class="container">
        <h2 class="text-center my-4">Vérification de numéro matricule</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
        @endif

        @if(session('message'))
          <div class="alert alert-info">
            {{ session('message') }}
          </div>
        @endif

        @if(session('show_code'))
        {{-- Formulaire de vérification du code --}}
        <form action="{{ route('verification_matricule.verify_code') }}" method="POST" class="php-email-form mt-4">
          @csrf
          <input type="hidden" name="matricule" value="{{ session('matricule') }}">

          <div class="form-group mb-3">
            <label for="code">Code de vérification <span class="text-danger">*</span></label>
            <input type="text" name="code_verification" id="code" class="form-control" required />
          </div>

          <button type="submit" class="btn btn-primary">Vérifier le code</button>
        </form>
        @else
        {{-- Formulaire de saisie du matricule --}}
        <form action="{{ route('verification_matricule.check') }}" method="POST" class="php-email-form mt-4">
          @csrf
          <div class="form-group mb-3">
            <label for="matricule">Numéro matricule <span class="text-danger">*</span></label>
            <input type="text" name="matricule" id="matricule" class="form-control" required value="{{ old('matricule') }}" />
          </div>

          <button type="submit" class="btn btn-success">Continuer</button>
        </form>
        @endif

        @if($errors->any())
          <div class="alert alert-danger mt-3">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
    </section>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- JS Files -->
  <script src="{{ asset('assets/vendor2/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor2/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor2/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor2/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor2/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor2/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js2/main.js') }}"></script>
</body>
</html>
