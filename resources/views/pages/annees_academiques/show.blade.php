<x-default-layout>
    @section('title', 'Détails de l\'année académique')

    <div class="container">
        <h1>Détails de l'année académique : {{ $anneeAcademique->nom }}</h1>

        <div class="card">
            <div class="card-body">
                <p><strong>Année académique :</strong> {{ $anneeAcademique->nom }}</p>
                <p><strong>Créé le :</strong> {{ $anneeAcademique->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Dernière mise à jour :</strong> {{ $anneeAcademique->updated_at->format('d/m/Y H:i') }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('annees-academiques.index') }}" class="btn btn-primary">Retour à la liste</a>
                <a href="{{ route('annees-academiques.edit', $anneeAcademique->id) }}" class="btn btn-warning">Éditer</a>

                <form action="{{ route('annees-academiques.destroy', $anneeAcademique->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette année académique ?')">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
