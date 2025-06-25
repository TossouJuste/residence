<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Faire une demande</title>
  <meta content="Système de gestion des résidences universitaires" name="description" />
  <link href="assets/media/logos/logo-cousac.jpeg" rel="icon" />
  <link href="assets/media/logos/logo-cousac.jpeg" rel="cous-ac" />

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

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css2/style.css') }}" rel="stylesheet" />
</head>

<body>
  <!-- ======= Header ======= -->
  @include('vitrine.header')
  <!-- End Header -->

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
        <h2 class="text-center my-4">Formulaire de demande simplifiée</h2>
        <p class="text-center center my-4"><a href="/demande">Est-ce la première fois vous faites une demande ? </a></p>
        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Attention !</strong> {{ session('error') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if ($planification)
          <form action="{{ route('demandes.store.simple') }}" method="POST" enctype="multipart/form-data" class="php-email-form mt-4">
            @csrf

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label for="matricule">Matricule <span class="text-danger">*</span></label>
                <input type="text" name="matricule" id="matricule" class="form-control" required />
              </div>
              <div class="col-md-6 form-group mb-3">
                <label for="etablissement_id">Établissement <span class="text-danger">*</span></label>
                <select name="etablissement_id" id="etablissement_id" class="form-control" required>
                  <option value="" disabled selected>Choisissez votre établissement</option>
                  @foreach ($etablissements as $etablissement)
                    <option value="{{ $etablissement->id }}">
                      {{ $etablissement->nom }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label for="filiere">Filière <span class="text-danger">*</span></label>
                <input type="text" name="filiere" id="filiere" class="form-control" required />
              </div>
               <div class="col-md-6 form-group mb-3">
                <label for="annee_etude">Année d'étude <span class="text-danger">*</span></label>
                <select name="annee_etude" id="annee_etude" class="form-control" required>
                  <option value="" disabled selected>Choisissez votre année d'étude</option>
                  <option value="1">1ère année</option>
                  <option value="2">2ème année</option>
                  <option value="3">3ème année</option>
                </select>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group mb-3">
                    <label for="fiche_inscription">
                    Fiche de pré inscription validée ou non de l'année en cours <span class="text-danger">*</span>
                    </label>
                    <input type="file" name="fiche_inscription" id="fiche_inscription" class="form-control" required />
                </div>
            </div>

            <div class="form-group mb-3">
              <input type="checkbox" name="certification" id="certification" required />
              <label for="certification">
                Je certifie sur l'honneur l'exactitude de tous les renseignements ci-dessus mentionnés.<br />
                J'accepte encourir en cas de fausse déclaration une exclusion des résidences universitaires.
              </label>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Soumettre la demande</button>
            </div>
          </form>
        @else
          <div class="alert alert-danger">
            <strong>Aucune demande n'est autorisée en ce moment. Veuillez revenir plus tard.</strong>
          </div>
        @endif
      </div>
    </section>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const radioHandicapOui = document.getElementById('handicap_oui');
      const radioHandicapNon = document.getElementById('handicap_non');
      const handicapFields = document.getElementById('handicap_fields');

      function toggleHandicapFields() {
        if (radioHandicapOui.checked) {
          handicapFields.style.display = 'block';
        } else {
          handicapFields.style.display = 'none';
        }
      }

      if (radioHandicapOui && radioHandicapNon) {
        radioHandicapOui.addEventListener('change', toggleHandicapFields);
        radioHandicapNon.addEventListener('change', toggleHandicapFields);
      }
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
