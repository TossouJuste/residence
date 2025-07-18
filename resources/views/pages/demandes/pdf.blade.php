<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Export PDF - Demandes</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h3>Liste des demandes – Année académique : {{ $academicYear->nom ?? 'Inconnue' }}</h3>

     <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Sexe</th>
                <th>Date naissance</th>
                <th>Filière</th>
            </tr>
        </thead>
        <tbody>
            @forelse($demandes as $index => $demande)
                <tr>
                    <td>{{ $loop->iteration }} </td>
                    <td>{{ $demande->etudiant->nom }}</td>
                    <td>{{ $demande->etudiant->prenom }}</td>
                    <td>{{ $demande->etudiant->telephone }}</td>
                    <td>{{ $demande->etudiant->email }}</td>
                    <td>{{ $demande->etudiant->sexe }}</td>
                    <td>{{ \Carbon\Carbon::parse($demande->etudiant->date_naissance)->format('d/m/Y') }}</td>
                    <td>{{ $demande->filiere }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Aucune demande pour cette année académique.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
