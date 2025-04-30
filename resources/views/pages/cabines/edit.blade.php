<x-default-layout>
    @section('title', 'Modifier une Cabine')

    <div class="container">
        <h1>Modifier la Cabine {{ $cabine->code }}</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('cabines.update', $cabine->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="batiment_id" class="form-label">Bâtiment</label>
                        <select name="batiment_id" class="form-control" required>
                            <option value="">Sélectionner un bâtiment</option>
                            @foreach($batiments as $batiment)
                                <option value="{{ $batiment->id }}" {{ $cabine->batiment_id == $batiment->id ? 'selected' : '' }}>
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
                        <input type="text" name="code" class="form-control" value="{{ old('code', $cabine->code) }}" required>
                        @error('code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="places_initiales" class="form-label">Nombre de places initiales</label>
                        <input type="number" name="places_initiales" class="form-control" value="{{ old('places_initiales', $cabine->places_initiales) }}" required>
                        @error('places_initiales')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                    <a href="{{ route('cabines.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
