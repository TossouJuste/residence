<x-default-layout>
    @section('title', 'Ajouter une Cabine')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('cabines.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="batiment_id" class="form-label">Bâtiment</label>
                        <select name="batiment_id" class="form-control" required>
                            <option value="">Sélectionner un bâtiment</option>
                            @foreach($batiments as $batiment)
                                <option value="{{ $batiment->id }}" {{ old('batiment_id') == $batiment->id ? 'selected' : '' }}>
                                    {{ $batiment->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('batiment_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
                        @error('code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                   
                    <div class="mb-3">
                        <label for="places_disponibles" class="form-label">Places Disponibles</label>
                        <input type="number" name="places_disponibles" class="form-control" value="{{ old('places_disponibles') }}" required>
                        @error('places_disponibles')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <a href="{{ route('cabines.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
