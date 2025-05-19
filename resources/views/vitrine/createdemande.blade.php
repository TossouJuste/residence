<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Faire une demande</title>
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
  @include('vitrine.header')
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>DEMANDE DE RESIDANCE</h2>
          <ol>
            <li><a href="index.html">Accueil</a></li>
            <li>Demande de résidence</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role='alert'>
                    <strong>Attention !</strong> {{ session('error') }}
                </div>
            @endif

            <!-- ======= Contact Section ======= -->
            <section id="contact" class="contact">
            <div class="container">
                <div class="row">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($errors->has('adresse_residence_parents'))
                <span class="text-danger">{{ $errors->first('adresse_residence_parents') }}</span>
            @endif

            @if ($planification)

            <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                <form action="{{ route('demandes.store') }}" method="POST" enctype="multipart/form-data" class="php-email-form mt-4">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="nom" class="form-control" id="nom" placeholder="NOM" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" name="prenom" class="form-control" id="prenom" placeholder="PRENOM" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="telephone" class="form-control" id="email" placeholder="NUMERO DE TELEPHONE" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="email" name="email" class="form-control" id="email" placeholder="EMAIL" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="date">Date de naissance</label>
                            <input type="date" name="date_naissance" class="form-control" id="date" placeholder="DATE" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="lieu_naissance" class="form-control" id="lieu_naissance" placeholder="LIEU DE NAISSANCE" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" name="domicile" class="form-control" id="domicile" placeholder="DOMICILE" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="etablissement" class="form-control" id="nom" placeholder="ETABLISSEMENT" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" name="filiere" class="form-control" id="filiere" placeholder="FILIERE" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="annee_etude" class="form-control" id="annee_etude" placeholder="ANNEE D'ETUDE" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <select name="statut_aide" class="form-control" required>
                                <option value="">Êtes-vous boursier ou secouru ?</option>
                                <option value="boursier">Boursier</option>
                                <option value="secouru">Secouru</option>
                                <option value="aucun">Aucun</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="fiche">Fiche d'inscription validé de l'année écoulé ou en cours si vous êtes ancien étudiant et relevé de note si nouveau bachelier : </label>
                            <input type="file" name="fiche_inscription" id="fiche" class="form-control"   required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <select name="sexe" id="sexe" class="form-control" required>
                                <option value="">SEXE</option>
                                <option value="M" default>Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" name="nationalite" class="form-control" placeholder="NATIONNALITE"  required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                             <input type="text" name="adresse_personnelle" class="form-control" placeholder="ADRESSE PERSONNELLE"  required>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" name="adresse_residence_parents" class="form-control" placeholder="Adresse et lieu de résidence des parents (pour les contacter en cas de besoin)" >
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Redoublant :</label>
                            <input type="radio" name="redoublant" value="1" required> Oui
                            <input type="radio" name="redoublant" value="0" required> Non
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Salarié :</label>
                            <input type="radio" name="salarie" value="1" required> Oui
                            <input type="radio" name="salarie" value="0" required> Non
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Avez-vous résidé en résidence universitaire dans les 2 dernières années ?</label>
                            <input type="radio" name="ancien_resident" value="1" id="ancien_resident_oui" required> Oui
                            <input type="radio" name="ancien_resident" value="0" id="ancien_resident_non" required> Non
                        </div>
                    </div>

                    <!-- Champ bâtiment masqué par défaut -->
                    <div class="row" id="batiment_field" style="display:none;">
                        <div class="col-md-12 form-group">
                            <input type="text" name="batiments" class="form-control" placeholder="Si oui, précisez les bâtiments comme ceci : I-PIP, F-BID">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Êtes-vous en situation d'handicap ?</label>
                            <input type="radio" name="handicap" value="1" id="handicap_oui" required> Oui
                            <input type="radio" name="handicap" value="0" id="handicap_non" required> Non <br>
                        </div>
                    </div>

                    <!-- Champs type handicap et certificat masqués par défaut -->
                    <div class="row" id="handicap_fields" style="display:none;">
                        <div class="col-md-12 form-group">
                            <input type="text" name="type_handicap" class="form-control" placeholder="Si oui, précisez le type de handicap : moteur, visuel, autres">
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Certificat de handicap (si applicable) délivré par un médecin du COUS-AC</label>
                            <input type="file" name="certificat_handicap" class="form-control">
                        </div>
                    </div>

                    <input type="checkbox" name="certification" required>
                    <label>Je certifie sur l'honneur, l'exactitude de tous les renseignements ci-dessus mentionnés. <br> J'accepte encourir en cas de fausse déclaration, une exclusion des résidences universitaires.</label> <br>
                    <br><b style="color:red;">Attention</b> : Tout le processus étant en ligne, toute les pièces demandé seront physiquement présenté avant votre intégration dans les résidences universitaire si vous êtes retenu.
                    <div class="text-center">
                        <button type="submit">Soumettre la demande</button>
                    </div>

                </form>

            </div>
            @else
                <div class="alert alert-danger alert-dismissible fade show" role='alert'>
                    <strong>Aucune demande n'est autorisé en ce moment. Veuillez revenir plus tard</strong>
                </div>
            @endif

        </div>

      </div>
    </section><!-- End Contact Section -->


        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sélectionner les éléments
        const radioOui = document.getElementById('ancien_resident_oui');
        const radioNon = document.getElementById('ancien_resident_non');
        const batimentField = document.getElementById('batiment_field');

        // Fonction pour afficher/masquer le champ
        function toggleBatimentField() {
            if (radioOui.checked) {
                batimentField.style.display = 'block';
            } else {
                batimentField.style.display = 'none';
            }
        }

        // Écouter les changements sur les boutons radio
        radioOui.addEventListener('change', toggleBatimentField);
        radioNon.addEventListener('change', toggleBatimentField);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sélectionner les éléments
        const radioHandicapOui = document.getElementById('handicap_oui');
        const radioHandicapNon = document.getElementById('handicap_non');
        const handicapFields = document.getElementById('handicap_fields');

        // Fonction pour afficher/masquer les champss
        function toggleHandicapFields() {
            if (radioHandicapOui.checked) {
                handicapFields.style.display = 'block';
            } else {
                handicapFields.style.display = 'none';
            }
        }

        // Écouter les changements sur les boutons radio
        radioHandicapOui.addEventListener('change', toggleHandicapFields);
        radioHandicapNon.addEventListener('change', toggleHandicapFields);
    });
</script>

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
