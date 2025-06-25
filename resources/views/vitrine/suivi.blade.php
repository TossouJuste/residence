<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Suivre une demande</title>
  <meta content="" name="Système de gestion des résidences universitaires">
  <meta content="" name="cousac, résidence, uac">

  <!-- Favicons -->
  <link href="assets/media/logos/logo-cousac.jpeg" rel="icon">
  <link href="assets/media/logos/logo-cousac.jpeg" rel="cous-ac">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Inclure les fichiers CSS dans votre fichier Blade -->
<link href="{{ asset('assets/vendor2/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor2/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor2/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor2/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor2/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor2/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor2/swiper/swiper-bundle.min.css') }}" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css2/style.css') }}" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  @include('vitrine.header')
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>SUIVRE UNE DEMANDE</h2>
          <ol>
            <li><a href="/">ACCUEIL</a></li>
            <li>Suivre une demande</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

      <!-- ======= formulaire Section ======= -->
      <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">

                    <!-- Formulaire pour entrer le code de suivi -->
                    <form action="{{ route('suivi.demande') }}" method="post" role="form" class="php-email-form mt-4">
                        @csrf
                        <h3 class="d-flex justify-content-center">Saisissez votre code de suivi</h3> <br>
                         <!-- Si un message d'erreur est défini, on l'affiche dans une alerte rouge -->
                         @if (session('error'))
                         <div class="alert alert-danger" role="alert">
                             {{ session('error') }}
                         </div>
                         @endif

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <input type="text" name="tracking_code" class="form-control" id="tracking_code" placeholder="Votre code de suivi" required>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit">Suivre la demande</button>
                        </div>
                    </form>

                </div>
            </div>


        </div>
      </section><!-- End formulaire Section -->



        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor2/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor2/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor2/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor2/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor2/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor2/swiper/swiper-bundle.min.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js2/main.js') }}"></script>

</body>

</html>
