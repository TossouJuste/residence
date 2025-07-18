<x-default-layout>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Liste des Demandes</h3>

            <!-- Bouton Lancer le Classement -->
            <button class="btn btn-success" id="btn-lancer-classement">
                <i class="fas fa-sort"></i> Lancer le Classement
            </button>
        </div>

        <div class="card-body">
            <!-- Formulaire pour changer l'année -->
            <form method="GET" action="{{ route('admin.demandes.index') }}">
    <div class="row mb-4">
        <!-- Année académique -->
        <div class="col-md-3">
            <label for="academic_year">Année académique :</label>
            <select name="academic_year_id" id="academic_year" class="form-control" onchange="this.form.submit()">
                @foreach($academicYears as $year)
                    <option value="{{ $year->id }}" {{ $year->id == $academicYearId ? 'selected' : '' }}>
                        {{ $year->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filtre de demande -->
        <div class="col-md-3">
            <label for="filtre">Filtrer les demandes :</label>
            <select name="filtre" id="filtre" class="form-control" onchange="this.form.submit()">
                <option value="all" {{ $filtre == 'all' ? 'selected' : '' }}>Toutes les demandes</option>
                <option value="classe" {{ $filtre == 'classe' ? 'selected' : '' }}>Demandes classées</option>
                <option value="non_classe" {{ $filtre == 'non_classe' ? 'selected' : '' }}>Demandes non classées</option>
                <option value="classe_non_valide" {{ $filtre == 'classe_non_valide' ? 'selected' : '' }}>Demandes classées non validées</option>
                <option value="classement_invalide" {{ $filtre == 'classement_invalide' ? 'selected' : '' }}>Classements invalides</option>
            </select>
        </div>

        <!-- Export PDF -->
        <div class="col-md-3 mt-4">
            <a href="{{ route('demandes.export.pdf', ['academic_year_id' => $academicYearId, 'filtre' => $filtre]) }}" class="btn btn-danger">
                 Exporter en PDF
            </a>

        </div>
    </div>
</form>


            <div class="table-responsive">
               <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Fiche</th>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Sexe</th>
                            <th>Date Naissance</th>
                            <th>Etablissement</th>
                            <th>Année d'étude</th>
                        </tr>
                    </thead>

                    <tbody>
                    <tbody>
                        @forelse($demandes as $demande)
                            <tr>
                                <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#ficheModal{{ $demande->id }}">
                                        Voir fiche
                                    </a>
                                </td>
                                <td>{{ $demande->etudiant_matricule }}</td>
                                <td>{{ $demande->etudiant->nom }} {{ $demande->etudiant->prenom }}</td>
                                <td>{{ $demande->etudiant->telephone }}</td>
                                <td>{{ $demande->etudiant->email }}</td>
                                <td>{{ $demande->etudiant->sexe }}</td>
                                <td>{{ $demande->etudiant->date_naissance->format('d/m/Y') }}</td>
                                <td>{{ $demande->etablissement->nom }}</td>
                                <td>{{ ucfirst($demande->annee_etude) }}<sup>e</sup> année</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Aucune demande trouvée pour l'année</td>
                            </tr>
                        @endforelse
                    </tbody>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Modal de confirmation -->
    <div class="modal fade" id="confirmLancerModal" tabindex="-1" aria-labelledby="confirmLancerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmLancerModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir lancer le classement ? Cette action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" id="btn-lancer-confirm">Lancer</button>
                </div>
            </div>
        </div>
    </div>

             @foreach($demandes as $demande)
                <div class="modal fade" id="ficheModal{{ $demande->id }}" tabindex="-1" aria-labelledby="ficheModalLabel{{ $demande->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ficheModalLabel{{ $demande->id }}">Fiche de préinscription</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                      </div>
                      <div class="modal-body text-center">
                        @php
                          $path = asset('storage/' . $demande->fiche_preinscription);
                          $extension = pathinfo($path, PATHINFO_EXTENSION);
                        @endphp

                        @if(in_array($extension, ['jpg', 'jpeg', 'png']))
                          <img src="{{ $path }}" alt="Fiche" class="img-fluid">
                        @elseif($extension === 'pdf')
                          <iframe src="{{ $path }}" width="100%" height="600px"></iframe>
                        @else
                          <p>Fichier non pris en charge</p>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach


    <!-- Script pour confirmation avant lancement -->
    <script>
                // Ajouter un événement au bouton pour afficher le modal
        document.getElementById("btn-lancer-classement").addEventListener("click", function () {
            // Afficher le modal de confirmation
            let confirmModal = new bootstrap.Modal(document.getElementById('confirmLancerModal'));
            confirmModal.show();
        });

        // Quand on clique sur "Lancer" dans le modal
        document.getElementById("btn-lancer-confirm").addEventListener("click", function () {
            // Rediriger l'utilisateur vers la route après confirmation
            window.location.href = "{{ route('admin.demandes.classement') }}";
        });

    </script>
</x-default-layout>
