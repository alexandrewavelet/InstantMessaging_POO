<?php
	session_start();

	include("modeles/Manager.php");

	$monManager = new Manager();

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	}else{
		$action = 0;
	}

	switch ($action) {
		case 'login':
			if (isset($_POST['connexion'])) {
				$message = $monManager->connexionUtilisateur($_POST['login'], $_POST['mdp']);
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