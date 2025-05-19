<x-default-layout>

    @section('title', 'Modifier le Bâtiment')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('batiments.update', $batiment->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="city_id" class="form-label">Cité Associée</label>
                                <select name="city_id" class="form-control" required>
                                    <option value="">Sélectionnez une cité</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ old('city_id', $batiment->city_id) == $city->id ? 'selected' : '' }}>
                                            {{ $city->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom du Bâtiment</label>
                                <input type="text" name="nom" class="form-control" value="{{ old('nom', $batiment->nom) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="nbr_cabine" class="form-label">Nombre de Cabines</label>
                                <input type="number" name="nbr_cabine" class="form-control" value="{{ old('nbr_cabine', $batiment->nbr_cabine) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="sexe" class="form-label">Sexe</label>
                                <select name="sexe" class="form-control" required>
                                    <option value="">Sélectionner...</option>
                                    <option value="M" {{ old('sexe', $batiment->sexe) == 'M' ? 'selected' : '' }}>Masculin</option>
                                    <option value="F" {{ old('sexe', $batiment->sexe) == 'F' ? 'selected' : '' }}>Féminin</option>
                                </select>
                                @error('sexe')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4">{{ old('description', $batiment->description) }}</textarea>
                            </div>



                            <button type="submit" class="btn btn-success">Mettre à Jour</button>
                            <a href="{{ route('batiments.index') }}" class="btn btn-secondary">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-default-layout>
