<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Portfolio Details - Bethany Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

   <!-- Vendor CSS Files -->
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

    @include('vitrine.header');

  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>PAGE DE SUIVI</h2>
          <ol>
            <li><a href="index.php">ACCUEIL</a></li>
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
            <div class="container">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">

                    <h5 class="d-flex justify-content-center">Information personnelle :</h5> <br>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <p><strong>Nom & Prénoms :</strong> {{ $demande->nom ?? 'Non disponible' }} {{ $classement->demande->prenom ?? '' }}</p>
                            <p><strong>Année d'étude et filière :</strong> {{ $demande->annee_etude ?? 'Non disponible'}}<sup>e</sup> année  {{ $demande->filiere ?? '' }}</p>
                            <p><strong>École :</strong> {{ $demande->etablissement ?? 'Non disponible' }}</p>
                        </div>
                    </div>

                    <h5 class="d-flex justify-content-center">Statut de votre demande :</h5> <br>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <p>{{ $message }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <!-- Vérifier si la demande a bien été classée -->
                            @if(isset($classement))
                                <h4 class="d-flex justify-content-center">Information de votre classement :</h4> <br>
                                <p><strong>Cité :</strong> {{ $classement->cabine->batiment->city->nom ?? 'Cité non trouvée' }}</p>
                                <p><strong>Bâtiment :</strong> {{ $classement->cabine->batiment->nom ?? 'Bâtiment non trouvé' }}</p>
                                <p><strong>Cabine :</strong> {{ $classement->cabine->code ?? 'Cabine non trouvée' }}</p>

                                <p><strong>Délais de validation de la cabine :</strong> du 05 novembre au 15 novembre</p>

                                <p><strong>Frais de résidences :</strong></p>
                                <ol>
                                    <li>
                                        Si première vague :
                                        <ul>
                                            <li>Loyer 2500F x 9 mois + caution 5000F = <strong>27 500F</strong></li>
                                        </ul>
                                    </li>
                                    <li>
                                        Si deuxième vague :
                                        <ul>
                                            <li>Loyer 2500F x 7 mois + caution 5000F = <strong>22 500F</strong></li>
                                        </ul>
                                    </li>
                                </ol>

                                <p><strong>Adresse de paiement - Ecobank :</strong> N° 110066174001 intitulé ‹‹ COUS-AC ressources propres »</p>

                                <p><strong>Étapes et critères de validation de votre cabine :</strong>
                                    <a href="{{ route('validation', ['code_suivi' => $classement->demande->code_suivi]) }}" class="btn btn-primary">Validation</a>
                                </p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End formulaire Section -->




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
