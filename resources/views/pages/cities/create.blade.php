<x-default-layout>
    <x-slot name="title">Créer une nouvelle cité</x-slot>

    <div class="container">
        <div class="card">

            <div class="card-body">
                <form action="{{ route('cities.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-10">
                        <label for="nom" class="required form-label">Nom</label>
                        <input type="text" class="form-control form-control-solid" id="nom" name="nom" value="{{ old('nom') }}" required>
                        @error('nom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-10">
                        <label for="nbr_batiment" class="required form-label">Nombre de Bâtiments</label>
                        <input type="number" class="form-control form-control-solid" id="nbr_batiment" name="nbr_batiment" value="{{ old('nbr_batiment') }}" required>
                        @error('nbr_batiment')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-10">
                        <label for="description" class="required form-label">Description</label>
                        <textarea class="form-control form-control-solid" id="description" name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">

                    <button type="submit" class="btn btn-success">Créer</button>
                    <a href="{{ route('cities.index') }}" class="btn btn-secondary">Retour à la liste</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
