<x-default-layout>
    @section('title', 'Liste des Critères')

    <div class="card">
        <div class="card-header">
            <h3>Critères de Répartition</h3>
            <a href="{{ route('criteres.create') }}" class="btn btn-primary">Ajouter un Critère</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Code Critère</th>
                        <th>Libellé</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($criteres as $critere)
                        <tr>
                            <td>{{ $critere->code_critere }}</td>
                            <td>{{ $critere->libelle }}</td>
                            <td>
                                <a href="{{ route('criteres.show', $critere->id) }}" class="btn btn-info">Voir</a>
                                <a href="{{ route('criteres.edit', $critere->id) }}" class="btn btn-warning">Modifier</a>
                                <form action="{{ route('criteres.destroy', $critere->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-default-layout>
