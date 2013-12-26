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
	<div class="row gris">
		<div class="col-md-3 col-md-offset-1">
			<h1><span class="bleu">Instant</span>Messaging</h1>
			<a href="cMessagerie.php?action=home"><button class="boutonHome petit"><span class="glyphicon glyphicon-home"></span></button></a>
			<a href="index.php?action=logout"><button class="boutonHome sansMarge">Déconnexion</button></a>
		</div>
		<div class="col-md-8">
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-md-offset-1">
			<h2>Conversations</h2>
			<?php echo $_SESSION['listeConnectes']->afficherListe(); ?>
		</div>
		<div class="col-md-8">