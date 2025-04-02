<x-default-layout>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Liste des Demandes</h3>

            <!-- Bouton Lancer le Classement -->
            <button class="btn btn-primary" id="btn-lancer-classement">
                <i class="fas fa-sort"></i> Lancer le Classement
            </button>
        </div>

        <div class="card-body">
            <!-- Formulaire pour changer l'année -->
            <form method="GET" action="{{ route('admin.demandes.index') }}">
                <div class="row mb-4">
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
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Sexe</th>
                            <th>Date Naissance</th>
                            <th>Filière</th>
                            <th>Boursier / secouru</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($demandes as $demande)
                            <tr>
                                <td>{{ $demande->nom }}</td>
                                <td>{{ $demande->prenom }}</td>
                                <td>{{ $demande->telephone }}</td>
                                <td>{{ $demande->email }}</td>
                                <td>{{ $demande->sexe }}</td>
                                <td>{{ $demande->date_naissance }}</td>
                                <td>{{ $demande->filiere }}</td>
                                <td>{{ ucfirst($demande->statut_aide) }}</td> 
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Aucune demande trouvée pour l'année </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $demandes->links() }}
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
                    <button type="button" class="btn btn-primary" id="btn-lancer-confirm">Lancer</button>
                </div>
            </div>
        </div>
    </div>



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
