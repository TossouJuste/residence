<x-default-layout>
    @section('title', 'Détails de l\'Établissement')

    <div class="container">
        <h1>Détails de l’établissement {{ $etablissement->nom }}</h1>
        <div class="card">
            <div class="card-body">
                <p><strong>Nom de l’établissement :</strong> {{ $etablissement->nom }}</p>
                <p><strong>Catégorie :</strong> {{ $etablissement->type ?? 'Non spécifié' }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('etablissements.index') }}" class="btn btn-success">Retour à la liste des établissements</a>
                <a href="{{ route('etablissements.edit', $etablissement->id) }}" class="btn btn-warning">Éditer</a>
                <form action="{{ route('etablissements.destroy', $etablissement->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet établissement ?')">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
