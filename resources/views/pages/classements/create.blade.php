<x-default-layout>

    <div class="card">
        <div class="card-header">
            <h3>Faire un Classement</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('classements.store') }}" method="POST">
                @csrf

                <!-- Sélection de la Demande (dernière année académique uniquement) -->
                <div class="form-group">
                    <label for="code_suivi">Code de suivi</label>
                    <input list="demandesList" id="code_suivi" name="code_suivi" class="form-control" placeholder="Commencez à taper un code de suivi..." required>

                    <datalist id="demandesList">
                        @foreach($demandes as $demande)
                            <option value="{{ $demande->code_suivi }}">
                                {{ $demande->nom }} {{ $demande->prenom }}
                            </option>
                        @endforeach
                    </datalist>
                </div>


                <!-- Sélection de la Cabine (Seulement celles avec des places disponibles) -->
                <div class="form-group">
                    <label for="cabine_id">Cabine (Places disponibles)</label>
                    <select name="cabine_id" id="cabine_id" class="form-control" required>
                        <option value="">Sélectionnez une cabine</option>
                        @foreach($cabines as $cabine)
                            <option value="{{ $cabine->id }}">
                                {{ $cabine->code }} - {{ $cabine->batiment->nom }} ({{ $cabine->batiment->city->nom }})
                                - {{ $cabine->places_disponibles }} places restantes
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Enregistrer le Classement</button>
            </form>
        </div>
    </div>
</x-default-layout>
