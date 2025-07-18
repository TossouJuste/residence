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
        <h2 class="text-center my-4">Formulaire de demande de logement étudiant</h2>
        <p class="text-center center my-4"><a href="/demande/simple">Avez-vous soumis une demande auparavant ? </a></p>
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
          <form action="{{ route('demandes.store') }}" method="POST" enctype="multipart/form-data" class="php-email-form mt-4">
            @csrf

            <div class="row">
                <div class="col-md-6 form-group mb-3">
                <label for="matricule">Matricule <span class="text-danger">*</span></label>
                <input type="text"
                        name="matricule_display"
                        id="matricule"
                        class="form-control"
                        value="{{ session('matricule_verifie') }}"
                        disabled
                />
                <input type="hidden" name="matricule" value="{{ session('matricule_verifie') }}">
                <input type="hidden" name="verification_matricule_id" value="{{ \App\Models\VerificationMatricule::where('matricule', session('matricule_verifie'))->value('id') }}">

                </div>

              <div class="col-md-6 form-group mb-3">
                <label for="nom">Nom <span class="text-danger">*</span></label>
                <input type="text" name="nom" id="nom" class="form-control"  required />
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label for="prenom">Prénom <span class="text-danger">*</span></label>
                <input type="text" name="prenom" id="prenom" class="form-control" required />
              </div>
              <div class="col-md-6 form-group mb-3">
                <label for="telephone">Téléphone <span class="text-danger">*</span></label>
                <input type="tel" name="telephone" id="telephone" class="form-control"  required />
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control"  required />
              </div>
              <div class="col-md-6 form-group mb-3">
                <label for="date_naissance">Date de naissance <span class="text-danger">*</span></label>
                <input type="date" name="date_naissance" id="date_naissance" class="form-control" required />
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label for="lieu_naissance">Lieu de naissance <span class="text-danger">*</span></label>
                <input type="text" name="lieu_naissance" id="lieu_naissance" class="form-control"  required />
              </div>
              <div class="col-md-6 form-group mb-3">
                <label for="adresse_personnelle">Adresse personnelle <span class="text-danger">*</span></label>
                <input type="text" name="adresse_personnelle" id="adresse_personnelle" class="form-control" required />
              </div>
            </div>

            <div class="row">
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

              <div class="col-md-6 form-group mb-3">
                <label for="filiere">Filière <span class="text-danger">*</span></label>
                <input type="text" name="filiere" id="filiere" class="form-control"  required />
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label for="annee_etude">Année d'étude <span class="text-danger">*</span></label>
                <select name="annee_etude" id="annee_etude" class="form-control" required>
                  <option value="" disabled selected>Choisissez votre année d'étude</option>
                  <option value="1">1ère année</option>
                  <option value="2">2ème année</option>
                  <option value="3">3ème année</option>
                </select>
               </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="fiche_inscription">
                    Fiche de pré inscription validée ou non de l'année en cours <span class="text-danger">*</span>
                    </label>
                    <input type="file" name="fiche_inscription" id="fiche_inscription" class="form-control" required />
                </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label for="sexe">Sexe <span class="text-danger">*</span></label>
                <select name="sexe" id="sexe" class="form-control" required>
                  <option value="" disabled selected>Choisissez le sexe</option>
                  <option value="M">Masculin</option>
                  <option value="F">Féminin</option>
                </select>
              </div>
              <div class="col-md-6 form-group mb-3">
                <label for="nationalite">Nationalité <span class="text-danger">*</span></label>
                <input type="text" name="nationalite" id="nationalite" class="form-control" required />
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label>Êtes-vous en situation d'handicap ? <span class="text-danger">*</span></label><br />
                <input type="radio" name="handicap" value="1" id="handicap_oui" required />
                <label for="handicap_oui">Oui</label>
                <input type="radio" name="handicap" value="0" id="handicap_non" required />
                <label for="handicap_non">Non</label>
              </div>
            </div>

            <div class="row" id="handicap_fields" style="display:none;">
              <div class="col-md-12 form-group mb-3">
                <label for="type_handicap">Si oui, précisez le type de handicap (moteur, visuel, autre)</label>
                <input type="text" name="type_handicap" id="type_handicap" class="form-control" />
              </div>
              <div class="col-md-12 form-group mb-3">
                <label for="certificat_handicap">Certificat de handicap (délivré par un médecin du COUS-AC)</label>
                <input type="file" name="certificat_handicap" id="certificat_handicap" class="form-control" />
              </div>
            </div>

           <div class="form-check mb-4">
                <input
                    class="form-check-input"
                    type="checkbox"
                    name="certification"
                    id="certification"
                    required
                />
                <label class="form-check-label" for="certification">
                    <strong>Je certifie sur l'honneur</strong> l'exactitude de tous les renseignements mentionnés ci-dessus et j'accepte d'encourir, en cas de fausse déclaration, une <strong>exclusion des résidences universitaires</strong>.
                </label>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-success">Soumettre la demande</button>
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

      // Handicap fields
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
