<x-default-layout>

    @section('title')
        Bâtiments
    @endsection

    <div class="container">
        <h1>Détails du Bâtiment {{ $batiment->nom }} </h1>
        <div class="card">
            <div class="card-body">
                <p><strong>Cité associée:</strong> {{ $batiment->city->nom }}</p>
                <p><strong>Nom du bâtiment :</strong> {{ $batiment->nom }}</p>
                <p><strong>Nombre de cabine:</strong> {{ $batiment->nbr_cabine }}</p>
                <p><strong>Sexe :</strong> {{ $batiment->sexe }}</p>
                <p><strong>Description:</strong> {{ $batiment->description }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('batiments.index') }}" class="btn btn-success">Retour à la liste des bâtiments</a>
                <a href="{{ route('batiments.edit', $batiment->id) }}" class="btn btn-warning">Éditer</a>
                <form action="{{ route('batiments.destroy', $batiment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bâtiment ?')">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

</x-default-layout>
