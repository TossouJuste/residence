<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Validation</title>
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

    @include('vitrine.header');

  <!-- End Header -->

  <main id="main">
 <!-- ======= Breadcrumbs ======= -->
 <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Validation</h2>
        <ol>
          <li><a href="index.php">ACCUEIL</a></li>
          <li>Validation de résidence</li>
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

              <h5 class="d-flex justify-content-center">Etapes de validation :</h5> <br>
               <div class="row">
                  <div class="col-md-12 form-group">

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                     <!-- Étape 1 : Paiement et validation à la caisse -->
                    <p>1 - Paiement et validation à la caisse
                        @if($classement->validation_quittance)
                        <!-- Si la validation quittance est validée -->
                        <button type="button" class="btn btn-success">Validé</button>
                    @elseif($classement->code_quittance)
                        <!-- Si une quittance a été soumise mais pas encore validée -->
                        <button type="button" class="btn btn-warning">En cours de validation</button>
                    @else
                        <!-- Si la validation quittance n'est pas encore validée et aucune quittance n'a été soumise -->
                        <button type="button" class="btn btn-danger">Non validé</button>
                        <a href="{{ route('validation.quittance', ['code_suivi' => $classement->code_suivi]) }}" class="btn btn-primary">Valider</a>
                    @endif

                    </p>



                     <!-- Étape 2 : Confirmation au niveau du Chef Cité -->

                     <p>2 - Confirmation au niveau du Chef Cité et bâtiment
                        @if($classement->validation_quittance && $classement->cabine_valide)
                            <!-- Si le reçu de loyer et la cabine sont validés -->
                            <button type="button" class="btn btn-success">Validé</button>
                        @elseif($classement->validation_quittance && $classement->photo_recu_loyer && !$classement->cabine_valide)
                            <!-- Si la validation quittance et la photo du reçu de loyer sont validées, mais la cabine n'est pas encore validée -->
                            <button type="button" class="btn btn-warning">En cours de validation</button>
                        @elseif($classement->validation_quittance && !$classement->photo_recu_loyer)
                            <!-- Si seulement la validation quittance est faite mais pas encore la validation du reçu de loyer -->
                            <button type="button" class="btn btn-danger">Non validé</button>
                            <a href="{{ route('validation.recu_loyer', ['code_suivi' => $classement->code_suivi]) }}" class="btn btn-primary">Valider</a>
                        @else
                            <!-- Si la validation quittance n'est pas encore validée -->
                            <button type="button" class="btn btn-danger">Non validé</button>
                        @endif
                    </p>


                     <!-- Étape 3 : Présentation des pièces au niveau du CB -->
                    <p>3 - Présentation des pièces au niveau du CB avant l'intégration en cabine
                        @if($classement->validation_quittance && $classement->cabine_valide)
                            <button type="button" class="btn btn-success">Validé</button>
                        @elseif($classement->validation_recu_loyer)
                            <button type="button" class="btn btn-danger">Non validé</button>
                        @else
                            <button type="button" class="btn btn-danger">Non validé</button>
                        @endif
                    </p>


                  </div>
              </div>

              <h5 class="d-flex justify-content-center">Dossier a présenter physiquement au niveau du CB avant la prise de clé :</h5> <br>
               <div class="row">
                  <div class="col-md-12">
                      <p>- Fiche de préinscription de l'année antérieure ou la fiche de préinscription valider de l'année en cours pour les anciens étudiants</p>
                      <p>- Relever de note du Bac ou attestation de bac ou la fiche de préinscription valider de l'année en cours pour les nouveaux bacheliers</p>
                      <p>- Certificat d'informité délivré par un médécin du COUS-AC pour les handicapés </p>
                      <p>- Carte d'étudiant ou carte nationale ou CIP ou Passeport </p>
                      <p>- Reçu des frais de logement</p>
                      <p>- deux exemplaires du contrat </p>
                  </div>
              </div>
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
