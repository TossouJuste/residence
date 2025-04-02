<x-default-layout>

    @section('title', 'Edit City')

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

                        <form action="{{ route('cities.update', $city->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">City Name</label>
                                <input type="text" name="nom" class="form-control" value="{{ old('nom', $city->nom) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="nbr_batiment" class="form-label">Nombre de Bâtiment</label>
                                <input type="number" name="nbr_batiment" class="form-control" value="{{ old('nbr_batiment', $city->nbr_batiment) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4">{{ old('description', $city->description) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update City</button>
                            <a href="{{ route('cities.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-default-layout>
