<x-default-layout>
    @section('title', 'Modifier un Établissement')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('etablissements.update', $etablissement->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nom -->
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom de l’établissement</label>
                        <input type="text" name="nom" class="form-control" value="{{ old('nom', $etablissement->nom) }}" required>
                        @error('nom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                   <!-- Type -->
                    <div class="mb-3">
                        <label for="type" class="form-label">Catégorie d’établissement</label>
                        <select name="type" class="form-control" required>
                            <option value="">Sélectionner un type</option>
                            <option value="Ecole" {{ old('type', $etablissement->type) == 'Ecole' ? 'selected' : '' }}>Ecole</option>
                            <option value="Faculté" {{ old('type', $etablissement->type) == 'Faculté' ? 'selected' : '' }}>Faculté</option>
                        </select>
                        @error('type')
                         <div class="text-danger">{{ $message }}</div>
                     @enderror
                    </div>


                    <!-- Boutons -->
                    <button type="submit" class="btn btn-success">Modifier</button>
                    <a href="{{ route('etablissements.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
