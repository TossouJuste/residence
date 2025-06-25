<x-default-layout>
    @section('title', 'Ajouter un Établissement')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('etablissements.store') }}" method="POST">
                    @csrf

                    <!-- Nom de l'établissement -->
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom de l’établissement</label>
                        <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
                        @error('nom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Type -->
                    <div class="mb-3">
                        <label for="type" class="form-label">Type d’établissement</label>
                        <select name="type" class="form-control">
                            <option value="">Sélectionner un </option>
                            <option value="Ecole" {{ old('type') == 'ecole' ? 'selected' : '' }}>Ecole</option>
                            <option value="Faculté" {{ old('type') == 'faculte' ? 'selected' : '' }}>Faculté</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Boutons -->
                    <button type="submit" class="btn btn-success">Ajouter</button>
                    <a href="{{ route('etablissements.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
