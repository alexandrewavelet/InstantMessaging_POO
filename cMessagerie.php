<?php

	include("modeles/Manager.php");
	$monManager = new Manager();
	// Ajouter à la session

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	}else{
		$action = 0;
	}

	switch ($action) {
		case 'login':
			if (isset($_POST['connexion'])) {
				$message = "<p>Connexion !</p>";
			}elseif (isset($_POST['inscription'])) {
				$message = $monManager->creerUtilisateur($_POST['login'], $_POST['mdp']);
			}
			include("vues/splashscreen.php");
			break;
		
		default:
			$messageErreur = "<p>Désolé, une erreur est survenue.</p>";
			include("vue/erreur.php");
			break;
	}

?>