<x-default-layout>
    @section('title', 'Créer un Critère')

    <div class="card">
        <div class="card-header">
            <h3>Créer un nouveau Critère</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('criteres.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="code_critere">Code Critère</label>
                    <input type="text" name="code_critere" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="libelle">Libellé</label>
                    <input type="text" name="libelle" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Ajouter</button>
            </form>
        </div>
    </div>
</x-default-layout>
