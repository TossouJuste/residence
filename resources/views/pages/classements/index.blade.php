<x-default-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <div class="card">
        <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-center">
            <div class="card-title">
                <h3>Classements</h3>
            </div>
            <div>
                <a href="{{ route('classements.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Faire un classement
                </a>
            </div>
        </div>

        <div class="card-body">
            <!-- Formulaire pour sélectionner une année académique -->
            <form method="GET" action="{{ route('classements.index') }}">
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
                            <th>Code Suivi</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Cabine</th>
                            <th>Bâtiment</th>
                            <th>Cabine validée</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classements as $classement)
                            <tr>
                                <td>{{ $classement->code_suivi }}</td>
                                <td>{{ $classement->demande->nom ?? 'N/A' }}</td>
                                <td>{{ $classement->demande->prenom ?? 'N/A' }}</td>
                                <td>{{ $classement->cabine->code ?? 'N/A' }}</td>
                                <td>{{ $classement->cabine->batiment->nom ?? 'N/A' }}-{{ $classement->cabine->batiment->city->nom ?? 'N/A' }}</td>
                                <td>{{ $classement->est_valide ? 'OUI' : 'NON' }}</td>
<td>
    @if (!$classement->est_valide)
        <button type="button" class="btn btn-sm btn-warning"
            onclick="confirmValidation('{{ route('classements.validate', $classement->code_suivi) }}', '{{ $classement->code_suivi }}')">
            Valider
        </button>
    @else
        <span class="badge bg-success">Validé</span>
    @endif
</td>



                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Aucun classement trouvé pour l'année académique sélectionnée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $classements->links() }}
            </div>
        </div>
    </div>


    <!-- Modal de confirmation -->
<div class="modal fade" id="confirmValidationModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir valider cette cabine ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="confirmBtn">Valider</button>
            </div>
        </div>
    </div>
</div>


<script>
   function confirmValidation(url, codeSuivi) {
    // Sauvegarde l'URL et le codeSuivi dans des attributs data
    document.getElementById('confirmBtn').setAttribute('data-url', url);
    document.getElementById('confirmBtn').setAttribute('data-code', codeSuivi);

    // Afficher le modal Bootstrap
    let confirmModal = new bootstrap.Modal(document.getElementById('confirmValidationModal'));
    confirmModal.show();
}

// Quand on clique sur "Valider" dans le modal, on exécute la requête
document.getElementById('confirmBtn').addEventListener('click', function () {
    let url = this.getAttribute('data-url');
    let codeSuivi = this.getAttribute('data-code');

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Fermer le modal
            let confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmValidationModal'));
            confirmModal.hide();

            // Mettre à jour l'affichage
            let element = document.getElementById(`classement-${codeSuivi}`);
            if (element) {
                element.innerHTML = '<span class="badge bg-success">Déjà validé</span>';
            }

            // Recharger la page après un court délai
            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            alert("Erreur : " + (data.message || "Une erreur inconnue s'est produite."));
        }
    })
    .catch(error => {
        console.error("Erreur :", error);
        alert("Une erreur est survenue. Vérifie la console (F12 → Console).");
    });
});


</script>




</x-default-layout>
