<x-default-layout>
    @section('title', 'Modifier une Planification')

    <div class="container">
        <h1>Modifier la Planification</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('planifications.update', $planification->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Champ : Description -->
                 <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <select name="description" id="description" class="form-control" required>
        <option value="Lancement d'inscription"
            {{ old('description', $planification->description ?? '') == "Lancement d'inscription" ? 'selected' : '' }}>
            Lancement d'inscription
        </option>
        <option value="Résultat"
            {{ old('description', $planification->description ?? '') == "Résultat" ? 'selected' : '' }}>
            Résultat
        </option>
    </select>

    @error('description')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


                    <!-- Sélection de l'Année Académique -->
                    <div class="mb-3">
                        <label for="annee_academique_id" class="form-label">Année Académique</label>
                        <select name="annee_academique_id" id="annee_academique_id" class="form-control" required>
                            <option value="">Sélectionner une année académique</option>
                            @foreach($anneesAcademiques as $annee)
                                <option value="{{ $annee->id }}" {{ $planification->annee_academique_id == $annee->id ? 'selected' : '' }}>
                                    {{ $annee->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('annee_academique_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ : Date de début -->
                    <div class="mb-3">
                        <label for="date_debut" class="form-label">Date de Début</label>
                        <input type="date" name="date_debut" id="date_debut" class="form-control"
                            value="{{ old('date_debut', \Carbon\Carbon::parse($planification->date_debut)->format('Y-m-d')) }}" required>
                        @error('date_debut')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ : Date de fin -->
                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date de Fin</label>
                        <input type="date" name="date_fin" id="date_fin" class="form-control"
                            value="{{ old('date_fin', \Carbon\Carbon::parse($planification->date_fin)->format('Y-m-d')) }}" required>
                        @error('date_fin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sélection du Statut -->
                    <div class="mb-3">
                        <label for="statut" class="form-label">Statut</label>
                        <select name="statut" id="statut" class="form-control" required>
                            <option value="ouverte" {{ $planification->statut == 'ouverte' ? 'selected' : '' }}>Ouverte</option>
                            <option value="fermée" {{ $planification->statut == 'fermée' ? 'selected' : '' }}>Fermée</option>
                                </select>
                        @error('statut')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ caché : Créé par (Utilisateur) -->
                    <input type="hidden" name="cree_par" value="{{ auth()->user()->id }}">

                    <!-- Boutons d'action -->
                    <button type="submit" class="btn btn-success">Modifier</button>
                    <a href="{{ route('planifications.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
