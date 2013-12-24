<?php
	session_start();

	function __autoload($class)
	{
		static $classDir = '/modeles';
		$file = str_replace('\\', DIRECTORY_SEPARATOR, ltrim($class, '\\')) . '.php';
		require "$classDir/$file";
	}

	include("modeles/Manager.php");

	$monManager = new Manager();

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	}else{
		$action = 0;
	}

	include("includes/header.php");

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
			include("vues/erreur.php");
			break;
	}

	include("includes/footer.php");

?>