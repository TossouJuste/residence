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
                <th>Statut aide</th>
            </tr>
        </thead>
        <tbody>
            @forelse($demandes as $index => $demande)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $demande->nom }}</td>
                    <td>{{ $demande->prenom }}</td>
                    <td>{{ $demande->telephone }}</td>
                    <td>{{ $demande->email }}</td>
                    <td>{{ $demande->sexe }}</td>
                    <td>{{ $demande->date_naissance }}</td>
                    <td>{{ $demande->filiere }}</td>
                    <td>{{ ucfirst($demande->statut_aide) }}</td>
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
