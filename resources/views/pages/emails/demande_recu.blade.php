<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de votre demande</title>
</head>
<body>
    <h1>Bonjour {{ $nom }},</h1>
    <p>Nous avons bien reçu votre demande. Voici les informations :</p>

    <ul>
        <li><strong>Email :</strong> {{ $email }}</li>
        <li><strong>Code de suivi :</strong> {{ $code_suivi }}</li>
    </ul>

    <p>Utilisez ce code pour suivre l'état de votre demande.</p>

    <p>Merci de nous faire confiance.</p>

    <p>Cordialement,</p>
    <p>L'équipe de support</p>
</body>
</html>
