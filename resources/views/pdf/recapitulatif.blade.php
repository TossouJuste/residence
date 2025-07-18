<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récapitulatif de la demande</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Récapitulatif de la demande de logement</h2>
    <table>
        <tr>
            <th>Nom</th>
            <td>{{ $demande->etudiant->nom }} {{ $demande->etudiant->prenom }}</td>
        </tr>
        <tr>
            <th>Matricule</th>
            <td>{{ $demande->etudiant->matricule }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $demande->etudiant->email }}</td>
        </tr>
        <tr>
            <th>Téléphone</th>
            <td>{{ $demande->etudiant->telephone }}</td>
        </tr>
        <tr>
            <th>Établissement</th>
            <td>{{ $demande->etablissement->nom }}</td>
        </tr>
        <tr>
            <th>Filière</th>
            <td>{{ $demande->filiere }}</td>
        </tr>
        <tr>
            <th>Année d’étude</th>
            <td>{{ $demande->annee_etude }}</td>
        </tr>
        <tr>
            <th>Code de suivi</th>
            <td>{{ $demande->code_suivi }}</td>
        </tr>
    </table>
</body>
</html>
