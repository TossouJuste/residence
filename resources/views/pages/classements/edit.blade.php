<x-default-layout>
    @section('title', 'Modifier un Classement')

    <div class="container">
        <h1>Modifier le Classement</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('classements.update', $classement->code_suivi) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="code_suivi" class="form-label">Code de Suivi</label>
                        <input type="text" class="form-control" id="code_suivi" name="code_suivi" value="{{ $classement->code_suivi }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="cabine_id" class="form-label">Cabine</label>
                        <select name="cabine_id" id="cabine_id" class="form-control">
                            @foreach($cabines as $cabine)
                                <option value="{{ $cabine->id }}" {{ $classement->cabine_id == $cabine->id ? 'selected' : '' }}>
                                    {{ $cabine->code }} - Places restantes : {{ $cabine->places_disponibles }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="est_valide" class="form-label">Validation</label>
                        <select name="est_valide" id="est_valide" class="form-control">
                            <option value="1" {{ $classement->est_valide ? 'selected' : '' }}>Oui</option>
                            <option value="0" {{ !$classement->est_valide ? 'selected' : '' }}>Non</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <a href="{{ route('classements.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
