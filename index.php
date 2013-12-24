<?php

	session_start();

	function __autoload($class)
	{
		static $classDir = '/modeles';
		$file = str_replace('\\', DIRECTORY_SEPARATOR, ltrim($class, '\\')) . '.php';
		require "$classDir/$file";
	}

	if (isset($_GET['action']) && $_GET['action'] == 'logout') {
		include('modeles/Manager.php');
		$monManager = new Manager();
		$monManager->deconnexionUtilisateur();
		session_unset();
		session_destroy();
	}

?>

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
			<form role="form" method="POST" action="cMessagerie.php?action=login">
				<div class="form-group">
					<label for="login">Login</label>
					<input type="text" class="form-control" id="login" name="login" placeholder="Login">
				</div>
				<div class="form-group">
					<label for="mdp">Mot de passe</label>
					<input type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe">		
				</div>
				<button type="submit" class="boutonHome" id="inscription" name="inscription">S'inscrire</button>
				<button type="submit" class="boutonHome" id="connexion" name="connexion">Se connecter</button>
			</form>
		</div>

		<div class="container">
			<h1>Fonctionnalités</h1>
			<p>Fonctionnalités implémentées :</p>
			<ul>
				<li>Classes objet abstraites</li>
				<li>Page d'accueil</li>
				<li>Création de la BDD</li>
				<li>Inscription / Connexion</li>
			</ul>
			<p>Fonctionnalités à venir :</p>
			<ul>
				<li>Interface de discussion / landing</li>
				<li>Liste des connectés</li>
				<li>Système de discussion</li>
				<li>Ajax (xAjax)</li>
			</ul>
			<p>Code source disponible sur GitHub : <a href="https://github.com/alexandrewavelet/InstantMessaging_POO/">InstantMessaging</a></p>
		</div>

	</div>

</body>
</html>