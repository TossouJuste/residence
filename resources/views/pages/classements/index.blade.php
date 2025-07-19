<x-default-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <div class="card">
        <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-center">
            <div class="card-title">
                <h3>Classements</h3>
            </div>

            <div>
                @if (in_array(Auth::user()->role,['intendant']))
                    <a href="{{ route('classements.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Faire un classement
                    </a>
                @endif
            </div>
        </div>

       <!-- Formulaire pour filtrer par année académique et type de classement -->
<form method="GET" action="{{ route('classements.index') }}" id="filterForm">
    <div class="row mb-4">
        <!-- Sélecteur d'année académique -->
        <div class="col-md-3">
            <select name="academic_year_id" id="academic_year" class="form-control">
                @foreach($academicYears as $year)
                    <option value="{{ $year->id }}" {{ $year->id == $academicYearId ? 'selected' : '' }}>
                        {{ $year->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filtres de classement -->
        <div class="col-md-6">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filtre" id="filtre_all" value="all" {{ $filtre == 'all' ? 'checked' : '' }}>
                <label class="form-check-label" for="filtre_all">Tous</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filtre" id="filtre_valide" value="valide" {{ $filtre == 'valide' ? 'checked' : '' }}>
                <label class="form-check-label" for="filtre_valide">Validés</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filtre" id="filtre_non_valide" value="non_valide" {{ $filtre == 'non_valide' ? 'checked' : '' }}>
                <label class="form-check-label" for="filtre_non_valide">Non validés</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filtre" id="filtre_invalide" value="invalide" {{ $filtre == 'invalide' ? 'checked' : '' }}>
                <label class="form-check-label" for="filtre_invalide">Invalidés</label>
            </div>
        </div>

        <!-- Export -->
        <div class="col-md-3 mt-4">
            <a href="{{ route('admin.classements.export.pdf', ['academic_year_id' => $academicYearId, 'filtre' => $filtre]) }}" class="btn btn-danger">
                Exporter en PDF
        </a>

        </div>
    </div>
</form>

<!-- Script pour déclencher la soumission auto -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('academic_year').addEventListener('change', function () {
            document.getElementById('filterForm').submit();
        });

        document.querySelectorAll('input[name="filtre"]').forEach(function (input) {
            input.addEventListener('change', function () {
                document.getElementById('filterForm').submit();
            });
        });
    });
</script>



            <div class="table-responsive">
            <!-- Champ de recherche -->
            <div class="d-flex align-items-center position-relative mb-4">
                {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                <input type="text" id="classementSearchInput" class="form-control form-control-solid w-250px ps-13" placeholder="Rechercher un classement"/>
            </div>

                 <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Fiche</th>
                             <th>Matricule</th>
                             <th>Nom & Prénom</th>
                            <th>Code Suivi</th>
                             <th>Date de <br> naissance</th>
                             <th>Sexe</th>
                            <th>Cabine</th>
                            <th>Bâtiment</th>
                            <th>Cabine validée</th>
                             @if (in_array(Auth::user()->role,['caissiere','intendant','admin']))
                                 <th>Frais d'hébergement</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                      @forelse($classements as $classement)
    <tr id="classement-{{ $classement->code_suivi }}">
        <td>
            @if ($classement->demande?->fiche_preinscription)
                <a href="#" data-bs-toggle="modal" data-bs-target="#ficheModal-{{ $classement->id }}">
                    <i class="bi bi-file-earmark-pdf" style="font-size: 20px;"></i>
                </a>
                <!-- Modal pour la fiche -->
                <div class="modal fade" id="ficheModal-{{ $classement->id }}" tabindex="-1" aria-labelledby="ficheModalLabel-{{ $classement->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ficheModalLabel-{{ $classement->id }}">Fiche de préinscription</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body text-center">
                                @php
                                    $extension = pathinfo($classement->demande->fiche_preinscription, PATHINFO_EXTENSION);
                                @endphp
                                @if(in_array($extension, ['jpg', 'jpeg', 'png']))
                                    <img src="{{ asset('storage/' . $classement->demande->fiche_preinscription) }}" class="img-fluid" alt="Fiche de préinscription" />
                                @elseif($extension === 'pdf')
                                    <embed src="{{ asset('storage/' . $classement->demande->fiche_preinscription) }}" type="application/pdf" width="100%" height="600px" />
                                @else
                                    <p>Format de fichier non pris en charge.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                N/A
            @endif
        </td>

        <td>{{ $classement->demande->etudiant_matricule }}</td>
        <td>{{ $classement->demande->etudiant->nom ?? 'N/A' }} {{ $classement->demande->etudiant->prenom ?? 'N/A' }}</td>
        <td>{{ $classement->code_suivi }}</td>
        <td>{{ $classement->demande?->etudiant->date_naissance ? \Carbon\Carbon::parse($classement->demande->etudiant->date_naissance)->format('d/m/Y') : 'N/A' }}</td>
        <td>{{ $classement->demande->etudiant->sexe ?? 'N/A' }}</td>
        <td>{{ $classement->cabine->code ?? 'N/A' }}</td>
        <td>{{ $classement->cabine->batiment->nom ?? 'N/A' }} - {{ $classement->cabine->batiment->city->nom ?? 'N/A' }}</td>
        <td>{{ $classement->est_valide ? 'OUI' : 'NON' }}</td>

        <!-- Nouvelle colonne fusionnée -->
         @if (in_array(Auth::user()->role,['caissiere','intendant','admin']))


        <td>
    @if($classement->paiement)
        <!-- Détection de l'état de validation -->
        @php
            $etatTexte = $classement->est_valide ? 'Payé / Validé' : 'Payé - Non validé';
            $btnClass = $classement->est_valide ? 'btn-success' : 'btn-warning';
        @endphp

        <!-- Bouton dynamique -->
        <button class="btn {{ $btnClass }} btn-sm w-100" data-bs-toggle="modal" data-bs-target="#modalPaiement{{ $classement->id }}">
            {{ $etatTexte }}
        </button>

        <!-- Modal Paiement avec validation intégrée -->
        <div class="modal fade" id="modalPaiement{{ $classement->id }}" tabindex="-1" aria-labelledby="paiementModalLabel{{ $classement->id }}" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paiementModalLabel{{ $classement->id }}">Détails Paiement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Référence :</strong> {{ $classement->paiement->reference }}</p>
                        <p><strong>Montant :</strong> {{ $classement->paiement->montant }} FCFA</p>
                        <p><strong>Téléphone :</strong> {{ $classement->paiement->telephone }}</p>
                        <p><strong>Date :</strong> {{ $classement->paiement->created_at->format('d/m/Y H:i') }}</p>
                        <hr>
                        @if ($classement->est_valide)
                            <span class="badge bg-success w-100">Déjà validé</span>
                        @elseif (!$classement->peut_valider)
                            <button class="btn btn-secondary btn-sm w-100" disabled>Validation désactivée</button>
                        @else
                            <button type="button" class="btn btn-success btn-sm w-100"
                                onclick="confirmValidation('{{ route('classements.validate', $classement->code_suivi) }}', '{{ $classement->code_suivi }}')">
                                Valider
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Badge rouge si pas payé -->
        <span class="badge bg-danger">Non payé</span>
    @endif
</td>
@endif
    </tr>
@empty
    <tr>
        <td colspan="10" class="text-center">Aucun classement trouvé pour l'année académique sélectionnée.</td>
    </tr>
@endforelse

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">

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
                <button type="button" class="btn btn-success" id="confirmBtn">Valider</button>
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

@push('scripts')
<script>
    // Filtrage des classements par la recherche
    document.getElementById('classementSearchInput').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('.table tbody tr');

        rows.forEach(row => {
            let cells = row.querySelectorAll('td');
            let match = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(filter));
            row.style.display = match ? '' : 'none';
        });
    });
</script>
@endpush


</script>




</x-default-layout>
