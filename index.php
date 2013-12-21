<!doctype html>
<html lang="fr">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<title>Instant Messaging</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<script type="text/javascript" src="assets/js/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</head>
<body>
	<?php include("assets/js/toggleFormsHome.js"); ?>
	<div class="jumbotron">
		<h1><span class="bleu">Instant</span>Messaging</h1>
		<p>Système de messagerie instantanée réalisée en PHP Objet.</p>
		<button class="boutonHome inscription">Inscription</button><button class="boutonHome connexion">Connexion</button>
		<div class="pull-right formulaire formHome">
			<form role="form">
				<div class="form-group">
					<label for="login">Login</label>
					<input type="text" class="form-control" id="login" placeholder="Login">
				</div>
				<div class="form-group">
					<label for="mdp">Mot de passe</label>
					<input type="password" class="form-control" id="mdp" placeholder="Mot de passe">		
				</div>
				<button type="submit" class="bleu btnInscr invisible">S'inscrire</button>
				<button type="submit" class="bleu btnConn invisible">Se connecter</button>
			</form>
		</div>
	</div>
</body>
</html>