<x-default-layout>
    @section('title', 'Détails de la planification')

    <div class="container">
        <h1>Détails de la planification</h1>

        <div class="card">
            <div class="card-body">
                <p><strong>Description :</strong> {{ $planification->description ?? 'Aucune description' }}</p>
                <p><strong>Année académique :</strong> {{ $planification->anneeAcademique->nom ?? 'Non spécifié' }}</p>
                <p><strong>Date de début :</strong> {{ $planification->date_debut->format('d/m/Y') }}</p>
                <p><strong>Date de fin :</strong> {{ $planification->date_fin->format('d/m/Y') }}</p>
                <p><strong>Statut :</strong> {{ ucfirst($planification->statut) }}</p>
                <p><strong>Créé par :</strong> {{ $planification->createur->name ?? 'Inconnu' }}</p>
                <p><strong>Créé le :</strong> {{ $planification->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Dernière mise à jour :</strong> {{ $planification->updated_at->format('d/m/Y H:i') }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('planifications.index') }}" class="btn btn-primary">Retour à la liste</a>
                <a href="{{ route('planifications.edit', $planification->id) }}" class="btn btn-warning">Éditer</a>

                <form action="{{ route('planifications.destroy', $planification->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette planification ?')">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
