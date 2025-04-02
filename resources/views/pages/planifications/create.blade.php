<x-default-layout>
    @section('title', 'Ajouter une Planification')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ajouter une Nouvelle Planification</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('planifications.store') }}" method="POST">
                    @csrf

                   <!-- Description -->
                   <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <select name="description" class="form-control" required>
                        <option value="">Sélectionnez une option</option>
                        <option value="Lancement d'inscription" {{ old('description') == "Lancement d'inscription" ? 'selected' : '' }}>Lancement d'inscription</option>
                        <option value="Résultat" {{ old('description') == "Résultat" ? 'selected' : '' }}>Résultat</option>
                    </select>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                

                    <!-- Sélection de l'année académique -->
                    <div class="mb-3">
                        <label for="annee_academique_id" class="form-label">Année Académique</label>
                        <select name="annee_academique_id" class="form-control" required>
                            <option value="">-- Sélectionner une année académique --</option>
                            @foreach($anneesAcademiques as $annee)
                                <option value="{{ $annee->id }}" {{ old('annee_academique_id') == $annee->id ? 'selected' : '' }}>
                                    {{ $annee->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('annee_academique_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date de début -->
                    <div class="mb-3">
                        <label for="date_debut" class="form-label">Date de début</label>
                        <input type="date" name="date_debut" class="form-control" value="{{ old('date_debut') }}" required>
                        @error('date_debut')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date de fin -->
                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date de fin</label>
                        <input type="date" name="date_fin" class="form-control" value="{{ old('date_fin') }}" required>
                        @error('date_fin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Boutons -->
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <a href="{{ route('planifications.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
