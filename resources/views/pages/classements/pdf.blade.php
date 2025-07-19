<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Export PDF - Classements</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h3>Liste des classements – Année académique : {{ $academicYear->nom ?? 'Inconnue' }}</h3>


    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom & Prénom</th>
                <th>Date <br> Naissance</th>
                <th>Ets</th>
                <th>Année <br> d'étude</th>
                <th>Sexe</th>
                <th>Lieu <br> résidence</th>
                <th>Handicapé</th>
                <th>Batiment</th>
                <th>Cabine</th>
            </tr>
        </thead>
        <tbody>
            @forelse($classements as $index => $classement)
                <tr>
                    <td>{{ $loop->iteration }} </td>
                    <td>{{ $classement->demande->etudiant->nom }} {{ $classement->demande->etudiant->prenom ?? 'N/A' }}</td>
                   <td>{{ $classement->demande->etudiant->date_naissance ? \Carbon\Carbon::parse($classement->demande->etudiant->date_naissance)->format('d/m/Y') : 'N/A' }}</td>
                    <td>{{ $classement->demande->etablissement->nom ?? 'N/A' }}</td>
                    <td>{{ $classement->demande->annee_etude ?? 'N/A' }}</td>
                    <td>{{ $classement->demande->etudiant->sexe ?? 'N/A' }}</td>
                    <td>{{ $classement->demande->etudiant->adresse_personnelle ?? 'N/A' }}</td>

                    @php
                         $handicap = (int) $classement->demande->handicap;
                    @endphp
                    <td>
                        {{ $handicap === 1 ? 'Oui' : ($handicap === 0 ? 'Non' : 'N/A') }}
                    </td>

                    <td>{{ $classement->cabine->batiment->nom }}-{{ $classement->cabine->batiment->city->nom ?? 'N/A' }}</td>
                    <td>{{ $classement->cabine->code ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucun classement disponible pour cette année.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
