<x-default-layout>
    @section('title', 'Modifier une Année Académique')

    <div class="container">
        <h1>Modifier l'Année Académique {{ $anneeAcademique->nom }}</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('annees-academiques.update', $anneeAcademique->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Champ : Nom de l'année académique -->
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom de l'Année Académique</label>
                        <input type="text" name="nom" id="nom" class="form-control"
                               value="{{ old('nom', $anneeAcademique->nom) }}" required>
                        @error('nom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                   <!-- Champ : Date de début -->
                    <div class="mb-3">
                        <label for="date_debut" class="form-label">Date de Début</label>
                        <input type="date" name="date_debut" id="date_debut" class="form-control"
                            value="{{ old('date_debut', $anneeAcademique->date_debut->format('Y-m-d')) }}" required>
                        @error('date_debut')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ : Date de fin -->
                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date de Fin</label>
                        <input type="date" name="date_fin" id="date_fin" class="form-control"
                            value="{{ old('date_fin', $anneeAcademique->date_fin->format('Y-m-d')) }}" required>
                        @error('date_fin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Boutons d'action -->
                    <button type="submit" class="btn btn-success">Modifier</button>
                    <a href="{{ route('annees-academiques.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
