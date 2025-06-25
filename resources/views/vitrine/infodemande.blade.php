<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Suivi de demande</title>
  <meta content="" name="Système de gestion des résidences universitaires">
  <meta content="" name="cousac, résidence, uac">

   <!-- Favicons -->
  <link href="assets/media/logos/logo-cousac.jpeg" rel="icon">
  <link href="assets/media/logos/logo-cousac.jpeg" rel="cous-ac">

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
            <li><a href="/">ACCUEIL</a></li>
            <li>Suivi de demande</li>
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

          <h5 class="d-flex justify-content-center">Informations personnelles :</h5><br>
          <table class="table table-bordered w-100 table-striped">
            <tbody>
              <tr>
                <td>Nom & Prénoms </td>
                <td>{{ $demande->nom ?? 'Non disponible' }} {{ $demande->prenom ?? '' }}</td>
              </tr>
              <tr>
                <td>Année d'étude et filière </td>
                <td>{{ $demande->annee_etude ?? 'Non disponible'}} {{ $demande->filiere ?? '' }}</td>
              </tr>
              <tr>
                <td>École </td>
                <td>{{ $demande->etablissement ?? 'Non disponible' }}</td>
              </tr>
            </tbody>
          </table>

<h5 class="d-flex justify-content-center">Statut de votre demande :</h5><br>
<table class="table table-bordered w-100">
  <tbody>
    <tr>
      <td colspan="2"
          @php
              $bgClass = 'bg-light'; // couleur par défaut
              if ($message === 'Demande en cours de traitement.') {
                  $bgClass = 'table-warning text-dark';
              } elseif ($message === 'Félicitations ! Vous avez été retenu.') {
                  $bgClass = 'table-success text-dark';
              } elseif ($message === 'Désolé, vous n’avez pas été retenu.') {
                  $bgClass = 'table-danger text-dark';
              }
          @endphp
          class="{{ $bgClass }}">
          {{ $message }}
      </td>
    </tr>
  </tbody>
</table>




          @if(isset($classement))
          <h4 class="d-flex justify-content-center">Information de votre classement :</h4><br>
          <table class="table table-bordered w-100">
            <tbody>
              <tr>
                <td><strong>Cité :</strong></td>
                <td>{{ $classement->cabine->batiment->city->nom ?? 'Cité non trouvée' }}</td>
              </tr>
              <tr>
                <td><strong>Bâtiment :</strong></td>
                <td>{{ $classement->cabine->batiment->nom ?? 'Bâtiment non trouvé' }}</td>
              </tr>
              <tr>
                <td><strong>Cabine :</strong></td>
                <td>{{ $classement->cabine->code ?? 'Cabine non trouvée' }}</td>
              </tr>
              <tr>
                <td><strong>Délais de validation :</strong></td>
                <td>du 05 novembre au 15 novembre</td>
              </tr>
              <tr>
                <td><strong>Frais de résidences :</strong></td>
                <td>
                  <ul>
                    <li>Si première vague : Loyer 2500F x 9 mois + caution 5000F = <strong>27 500F</strong></li>
                    <li>Si deuxième vague : Loyer 2500F x 7 mois + caution 5000F = <strong>22 500F</strong></li>
                  </ul>
                </td>
              </tr>
              <tr>
                <td><strong>Adresse de paiement :</strong></td>
                <td>Ecobank N° 110066174001 intitulé ‹‹ COUS-AC ressources propres ››</td>
              </tr>
            </tbody>
          </table>
          @endif

        </div>
      </div>
    </div>
  </div>
</section>
<!-- End formulaire Section -->


<style>
  .table.borderless td, .table.borderless th {
    border: none !important;
  }
</style>

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
