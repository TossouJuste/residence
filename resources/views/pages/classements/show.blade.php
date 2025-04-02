<x-default-layout>
    @section('title', 'Détails de la Cabine')

    <div class="container">
        <h1>Détails de la Cabine {{ $cabine->code }}</h1>
        <div class="card"> 
            <div class="card-body">
                <p><strong>Code de cabine:</strong> {{ $cabine->code }}</p>
                <p><strong>Bâtiment:</strong> {{ $cabine->batiment->nom }}</p>
                <p><strong>Nombre de Places:</strong> {{ $cabine->nbr_place }}</p>
                <p><strong>Places en État:</strong> {{ $cabine->places_en_etat }}</p>
                <p><strong>Places Disponibles:</strong> {{ $cabine->places_disponibles }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('cabines.index') }}" class="btn btn-primary">Retour à la liste des cabines</a>
                <a href="{{ route('cabines.edit', $cabine->id) }}" class="btn btn-warning">Éditer</a>
                <form action="{{ route('cabines.destroy', $cabine->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette cabine ?')">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
