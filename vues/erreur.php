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
			<h1>Erreur</h1>
			<?php if (isset($messageErreur)) {
				echo $messageErreur;
			}
			?>
		</div>
	</div>

		<div class="container">
			<h1>Fonctionnalités</h1>
			<p>Fonctionnalités implémentées :</p>
			<ul>
				<li>Classes PHP</li>
				<li>Page d'accueil</li>
				<li>Création de la BDD</li>
				<li>Inscription / Connexion</li>
				<li>Splashscreen (et inteface connectés, dialogue) : en cours</li>
				<li>Changement d'avatar</li>
				<li>Liste des connectés</li>
				<li>Système de discussion</li>
			</ul>
			<p>Fonctionnalités à venir :</p>
			<ul>
				<li>Fix affichage de l'envoyeur du message</li>
				<li>Page d'erreur</li>
				<li>finition design</li>
				<li>Sécurité</li>
				<li>Ajax (xAjax)</li>
			</ul>
			<p>Code source disponible sur GitHub : <a href="https://github.com/alexandrewavelet/InstantMessaging_POO/">InstantMessaging</a></p>
		</div>

	</div>

</body>
</html>