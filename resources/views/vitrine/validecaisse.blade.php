<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Validation à  la caisse</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
          <h2>VALIDATION A LA CAISSE</h2>
          <ol>
            <li><a href="index.php">ACCUEIL</a></li>
            <li>Validation à la caisse</li>
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
 

            <form action="{{ route('submit.quittance', ['code_suivi' => $classement->code_suivi]) }}" method="post" enctype="multipart/form-data" role="form" class="php-email-form mt-4">
                @csrf <!-- Protection CSRF -->
                <h3 class="d-flex justify-content-center">Information de la quittance</h3> <br>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="text" name="code_quittance" class="form-control" placeholder="Numéro de la quittance" required>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="file">Envoyez une photo de la quittance</label> <br>
                        <input type="file" name="photo_quittance" class="form-control" required>
                    </div>
                    <p>NB : Après soumission, rendez-vous à la caisse pour obtenir les reçus et continuer les étapes.</p>
                </div>   
                <div class="text-center">
                    <button type="submit">Soumettre</button>
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