<x-default-layout>
    <x-slot name="title">Liste des étudiants UAC</x-slot>

    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Étudiants enregistrés dans la base UAC</h3>
                <a href="{{ route('base_uac.create') }}" class="btn btn-primary">Ajouter un étudiant</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email UAC</th>
                            <th>Date d'ajout</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($etudiants as $etu)
                            <tr>
                                <td>{{ $etu->matricule }}</td>
                                <td>{{ $etu->nom }}</td>
                                <td>{{ $etu->prenom }}</td>
                                <td>{{ $etu->email_uac }}</td>
                                <td>{{ $etu->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucun étudiant trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $etudiants->links() }}
                </div>
            </div>
        </div>
    </div>
</x-default-layout>
