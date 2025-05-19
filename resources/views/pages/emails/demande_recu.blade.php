<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de votre demande</title>
</head>
<body>
    <h2>Bonjour {{ $demande->nom }} {{ $demande->prenom }},</h2>

    <p>Votre demande de logement universitaire a bien été enregistrée.</p>

    <p><strong>Code de suivi :</strong> {{ $demande->code_suivi }}</p>

    <p>Merci de conserver ce code pour suivre l’évolution de votre demande</p>

    <p>Cordialement,<br>L'équipe de gestion des résidences COUS AC</p>
</body>
</html>
