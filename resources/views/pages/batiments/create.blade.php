<x-default-layout>
    <x-slot name="title">Créer un Nouveau Bâtiment</x-slot>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('batiments.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="city_id">Cité Associée</label>
                        <select class="form-control" id="city_id" name="city_id" required>
                            <option value="">Sélectionnez une cité</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                    {{ $city->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nom">Nom du bâtiment </label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                        @error('nom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nbr_cabine">Nombre de Cabines</label>
                        <input type="number" class="form-control" id="nbr_cabine" name="nbr_cabine" value="{{ old('nbr_cabine') }}" required>
                        @error('nbr_cabine')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sexe">Sexe</label>
                        <select class="form-control" id="sexe" name="sexe" required>
                            <option value="">Sélectionner...</option>
                            <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Masculin</option>
                            <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Féminin</option>
                        </select>
                        @error('sexe')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Créer</button>
                    <a href="{{ route('batiments.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
