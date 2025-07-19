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
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">

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

    <!-- ... (tout le head reste inchangé, tu peux le garder tel quel) ... -->

    <body>
        <style>
            .hidden {
                display: none;
            }

            .btn-success {
                padding: 8px 12px;
                background-color: #28a745;
                color: white;
                border: none;
                border-radius: 5px;
            }

            .alert-success {
                background-color: #d4edda;
                color: #155724;
                padding: 10px;
                border-radius: 4px;
            }
        </style>

        @include('vitrine.header')

        <main id="main">

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
            </section>

            <section id="portfolio-details" class="portfolio-details">
                <div class="container">
                    <div class="row gy-4">
                        <section id="contact" class="contact">
                            <div class="container">
                                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                                    <h5 class="d-flex justify-content-center">Informations personnelles :</h5><br>
                                    <table class="table table-bordered w-100 table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Nom & Prénoms</td>
                                                <td>{{ $demande->etudiant->nom ?? 'Non disponible' }}
                                                    {{ $demande->etudiant->prenom ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Année d'étude et filière</td>
                                                <td>{{ $demande->annee_etude ?? 'Non disponible' }}<sup>e</sup> année
                                                    {{ $demande->filiere ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>École</td>
                                                <td>{{ $demande->etablissement->nom ?? 'Non disponible' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <h5 class="d-flex justify-content-center">Statut de votre demande :</h5><br>
                                    <table class="table table-bordered w-100">
                                        <tbody>
                                            <tr
                                                class="@php
echo match($message) {
                                            'Demande en cours de traitement.' => 'table-warning text-dark',
                                            'Félicitations ! Vous avez été retenu.' => 'table-success text-dark',
                                            'Désolé, vous n’avez pas été retenu.' => 'table-danger text-dark',
                                            default => 'bg-light'
                                        }; @endphp">
                                                <td colspan="2">{{ $message }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    @if (isset($classement))
                                        <h4 class="d-flex justify-content-center">Information de votre classement :</h4>
                                        <br>
                                        <table class="table table-bordered w-100">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Cité :</strong></td>
                                                    <td>{{ $classement->cabine->batiment->city->nom ?? 'Cité non trouvée' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Bâtiment :</strong></td>
                                                    <td>{{ $classement->cabine->batiment->nom ?? 'Bâtiment non trouvé' }}
                                                    </td>
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
                                                            <li>Première vague : 2500F x 9 mois + caution 5000F =
                                                                <strong>27 500F</strong></li>
                                                            <li>Deuxième vague : 2500F x 7 mois + caution 5000F =
                                                                <strong>22 500F</strong></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        @if (!$classement->paiement)
                                                            <button class="btn-success"
                                                                onclick="afficherFormulaire()">Payer les frais de
                                                                résidence</button>

                                                            <div id="formulairePaiement" class="hidden mt-3">
                                                                <form
                                                                    action="{{ route('paiement.make', $classement->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <table>
                                                                        <td>
                                                                            <div class="mb-3">
                                                                                <label for="telephone">Téléphone
                                                                                    :</label>
                                                                                <input type="tel" name="telephone"
                                                                                    required class="form-control"
                                                                                    placeholder="Ex : 61000000"
                                                                                    id="telephone">
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="mb-3">
                                                                                <label for="email">Email :</label>
                                                                                <input type="email" name="email"
                                                                                    required class="form-control"
                                                                                    placeholder="Ex : test@example.com"
                                                                                    id="email">
                                                                            </div>
                                                                        </td>
                                                                    </table>
                                                                    <button type="submit"
                                                                        class="btn-success">Payer</button>
                                                                </form>
                                                            </div>
                                                        @else
                                                            <div class="alert alert-success">
                                                                ✅ Vous avez déjà payé les frais de résidence.
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                                 <script>
            const paymentForm = document.getElementById('formulairePaiement');
            const telephone_input = document.getElementById('telephone');
            const email_input = document.getElementById('email');

            paymentForm.addEventListener('submit', function(event) {
                // Prevent the default form submission
                event.preventDefault();
                if (telephone_input.value == '' || email_input.value == '') {
                    // Prevent the default form submission
                    event.preventDefault();
                    alert('Veuillez remplir tous les champs');
                } else {
                    const telephone = telephone_input.value;
                    const email = email_input.value;

                    openKkiapayWidget({
                        amount: "100",
                        position: "center",
                        callback: "{{ route('paiement.callback', ['classement_id' => $classement->id]) }}",
                        data: "",
                        theme: "green",
                        sandbox: true,
                        phone: telephone,
                        email: email,
                        key: "{{ env('KKIAPAY_PUBLIC_KEY') }}"
                    })

                }



                // Perform further actions, such as sending data to a server
            });

            addSuccessListener(response => {
                console.log(response);
            });

            addFailedListener(error => {
                console.log(error);
            });
        </script>

                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </main>

        <script>
            function afficherFormulaire() {
                document.getElementById("formulairePaiement").classList.remove("hidden");
            }
        </script>

        <script src="https://cdn.kkiapay.me/k.js"></script>

       
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-up-short"></i>
        </a>

        <!-- Vendor JS Files -->
        <script src="{{ asset('assets/vendor2/purecounter/purecounter_vanilla.js') }}"></script>
        <script src="{{ asset('assets/vendor2/aos/aos.js') }}"></script>
        <script src="{{ asset('assets/vendor2/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor2/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('assets/vendor2/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendor2/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js2/main.js') }}"></script>

    </body>

    </html>
