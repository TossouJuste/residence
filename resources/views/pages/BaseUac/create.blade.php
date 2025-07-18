<x-default-layout>
    <x-slot name="title">Créer un nouvel étudiant BaseUAC</x-slot>

    <div class="container">
        <div class="card">

            <div class="card-body">
                <form action="{{ route('base_uac.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-10">
                        <label for="matricule" class="required form-label">Matricule</label>
                        <input type="text" class="form-control form-control-solid" id="matricule" name="matricule" value="{{ old('matricule') }}" required>
                        @error('matricule')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-10">
                        <label for="nom" class="required form-label">Nom</label>
                        <input type="text" class="form-control form-control-solid" id="nom" name="nom" value="{{ old('nom') }}" required>
                        @error('nom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-10">
                        <label for="prenom" class="required form-label">Prénom</label>
                        <input type="text" class="form-control form-control-solid" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                        @error('prenom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-10">
                        <label for="email_uac" class="required form-label">Email UAC</label>
                        <input type="email" class="form-control form-control-solid" id="email_uac" name="email_uac" value="{{ old('email') }}" required>
                        @error('email_uac')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Créer</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-default-layout>
