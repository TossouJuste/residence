<h1>Bienvenue {{ $user->name }} !</h1>
<p>Votre compte a été créé avec succès.</p>
<p>Voici vos informations de connexion :</p>
<ul>
    <li>Email : {{ $user->email }}</li>
    <li>Mot de passe : <strong>{{ $password }}</strong></li>
</ul>
<p>Veuillez ne jamais perdre ce code puisqu'il n'est connu que par vous </p>
<p>Personne d'autres ne doit avoir accès a cela puisque toute manipulation a travers votre compte sera a votre compte et péril</p>
