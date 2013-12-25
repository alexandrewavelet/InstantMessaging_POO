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

	switch ($action) {
		case 'login':
			if (isset($_POST['connexion'])) {
				$message = $monManager->connexionUtilisateur($_POST['login'], $_POST['mdp']);
				include("vues/splashscreen.php");
			}elseif (isset($_POST['inscription'])) {
				$message = $monManager->creerUtilisateur($_POST['login'], $_POST['mdp']);
				include("vues/splashscreen.php");
			}else{
				$messageErreur = "<p>Vous êtes arrivés ici par erreur.</p>";
				include("vues/erreur.php");
			}
			break;
		
		case 'home':
			if ($monManager->estConnecte()) {
				$monManager->MaJListeConnectes();
				include("vues/splashscreen.php");
			}else{
				$messageErreur = "<p>Il faut être connecté pour voir cette page.</p>";
				include("vues/erreur.php");
			}
			break;

		case 'changerPhoto':
			if ($monManager->estConnecte()) {
				if (isset($_FILES['avatar'])) {
					$image = $_FILES['avatar'];
					$message = $monManager->setPhotoUtilisateur($_SESSION['utilisateur']->getId(), $image, $_SESSION['utilisateur']->getPhoto());
				}
				$monManager->MaJListeConnectes();
				include("vues/splashscreen.php");
			}else{
				$messageErreur = "<p>Il faut être connecté pour voir cette page.</p>";
				include("vues/erreur.php");
			}
			break;

		default:
			$messageErreur = "<p>Désolé, une erreur est survenue.</p>";
			include("vues/erreur.php");
			break;
	}

?>