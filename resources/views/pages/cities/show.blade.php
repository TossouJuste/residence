<x-default-layout>

    @section('title')
        Cités
    @endsection



<div class="container">
    <h1>Détails de la Cité {{ $city->nom }}</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Nom de la cité :</strong> {{ $city->nom }}</p>
            <p><strong>Nombre de bâtiments :</strong> {{ $city->nbr_batiment }}</p>
            <p><strong>Description:</strong> {{ $city->description }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('cities.index') }}" class="btn btn-primary">Retour à la liste des cités</a>
            <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-warning">Éditer</a>
            <form action="{{ route('cities.destroy', $city->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette cité ?')">Supprimer</button>
            </form>
        </div>
    </div>
</div>


</x-default-layout>

