<!doctype html>
<html lang="fr">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<title>Instant Messaging - Alexandre Wavelet</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<script type="text/javascript" src="assets/js/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="jumbotron">
		<h1><span class="bleu">Instant</span>Messaging</h1>
		<p>Système de messagerie instantanée réalisée en PHP Objet.</p>
	</div>

	<div class="container">

		<div class="pull-right">
			<h1>Accéder à <span class="bleu">Instant</span>Messaging</h1>
			<form role="form">
				<div class="form-group">
					<label for="login">Login</label>
					<input type="text" class="form-control" id="login" placeholder="Login">
				</div>
				<div class="form-group">
					<label for="mdp">Mot de passe</label>
					<input type="password" class="form-control" id="mdp" placeholder="Mot de passe">		
				</div>
				<button type="submit" class="boutonHome">S'inscrire</button>
				<button type="submit" class="boutonHome">Se connecter</button>
			</form>
		</div>

		<div class="container">
			<h1>Fonctionnalités</h1>
			<p>Fonctionnalités implémentées :</p>
			<ul>
				<li>Classes objet abstraites</li>
				<li>Page d'accueil</li>
			</ul>
			<p>Fonctionnalités à venir :</p>
			<ul>
				<li>Création de la BDD</li>
				<li>Inscription / Connexion</li>
				<li>Interface de discussion / landing</li>
				<li>Liste des connectés</li>
				<li>Système de discussion</li>
				<li>Ajax</li>
			</ul>
			<p>Code source disponible sur GitHub : <a href="">InstantMessaging</a></p>
		</div>

	</div>

</body>
</html>