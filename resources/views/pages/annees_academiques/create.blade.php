<x-default-layout>
    @section('title', 'Ajouter une Année Académique')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('annees-academiques.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nom" class="form-label">Année Académique</label>
                        <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" placeholder="Ex: 2024-2025" required>
                        @error('nom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_debut" class="form-label">Date de début</label>
                        <input type="date" name="date_debut" class="form-control" value="{{ old('date_debut') }}" placeholder="Ex: 01/09/2024" required>
                        @error('date_debut')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date de fin</label>
                        <input type="date" name="date_fin" class="form-control" value="{{ old('date_fin') }}" placeholder="Ex: 01/08/2025" required>
                        @error('date_fin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <a href="{{ route('annees-academiques.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
