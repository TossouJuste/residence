<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Confirmation au CB</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <?php
    include('header.php');
  ?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>CONFIRMATION AU CHEF BATIMENT</h2>
          <ol>
            <li><a href="index.php">ACCUEIL</a></li>
            <li>Confirmation au chef batiment</li>
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

            <form action="forms/contact.php" method="post" role="form" class="php-email-form mt-4">
            <h3 class="d-flex justify-content-center">Information de confirmation</h3> <br>
              <div class="row">
                <div class="col-md-12 form-group">
                  <input type="text" name="numrecu" class="form-control" id="name" placeholder="Numéro du réçu du loyer" required>
                </div>
                <div class="col-md-12 form-group">
                  <label for="file2">Envoyez votre photo d'identité</label> <br>
                  <input type="file" name="photoid" class="form-control" id="file2"  required>
                </div>
              </div>
              <div class="text-center"><button type="submit">Soumettre</button></div>
            </form>
          </div>
        </div>

        <h3 class="d-flex justify-content-center pt-2">Liste des pièces à déposer pour prendre sa clé  </h3> <br>
              <div class="row">
                <div class="col-md-12">
                      <p>Télécharger le contrat ici <a href="contrat.pdf">CONTRAT</a></p>
                      <p>- Fiche de préinscription de l'année antérieure ou la fiche de préinscription valider de l'année en cours pour les anciens étudiants</p>
                      <p>- Relever de note du Bac ou attestation de bac ou la fiche de préinscription valider de l'année en cours pour les nouveaux bacheliers</p>
                      <p>- Certificat d'informité délivré par un médécin du COUS-AC pour les handicapés </p>
                      <p>- Carte d'étudiant ou carte nationale ou CIP ou Passeport </p>
                      <p>- Reçu des frais de logement</p>
                      <p>- deux exemplaires du contrat </p>
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
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
