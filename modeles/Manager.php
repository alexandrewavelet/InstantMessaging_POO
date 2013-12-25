<?php

	class Manager{
	
		protected $connexion;
		
		function __construct(){ // Constructeur, initialisation d'un objet ConnexionBDD
			$this->connexion = new ConnexionBDD();
		}

		function creerUtilisateur($login, $motDePasse){ // Créée un utilisateur dans la BDD et renvoie son objet
			try{
				$reqLogin = $this->connexion->getConnexion()->prepare('SELECT COUNT(id) as nombre FROM utilisateurs WHERE login = ?');
				$reqLogin->execute(array($login));
				$loginExiste = $reqLogin->fetch()['nombre'];
				if ($loginExiste > 0) {
					$message = "<p>Le login que vous avez choisi est déjà pris, veuillez en choisir un nouveau.</p>";
				}else{
					$req = $this->connexion->getConnexion()->prepare('INSERT INTO utilisateurs VALUES (0, ?, ?, "defaut.jpg")');
					$req->execute(array($login,md5($motDePasse)));
					$idUtilisateur = $this->connexion->getConnexion()->lastInsertId();
					$_SESSION['utilisateur'] = new Utilisateur($idUtilisateur, $login, "defaut.jpg");
					$this->ajoutConnecte($res['id']);
					$message = "<p>Inscription réussie, vous pouvez commencer à utiliser la messagerie.</p>";
				}
			}catch(PDOException $e){
				$message = "<p>une erreur est survenue, veuillez réessayer.</p>";
			}
			return $message;
		}

		function estConnecte(){ // Retourne vrai si un utilisateur est connecté, faux sinon
			$booleen = false;
			if (isset($_SESSION['utilisateur'])) {
				$booleen = true;
			}
			return $booleen;
		}

		function connexionUtilisateur($login, $motDePasse){ // Connecte un utilisateur : renvoie une chaîne et place l'objet utilisateur en session
			try{
				$motDePasse = md5($motDePasse);
				$req = $this->connexion->getConnexion()->prepare('SELECT id, photo FROM utilisateurs WHERE login = ? AND mdp = ?');
				$req->execute(array($login, $motDePasse));
				$res = $req->fetch();
				if (isset($res['id'])) {
					$_SESSION['utilisateur'] = new Utilisateur($res['id'], $login, $res['photo']);
					$message = "<p>Connexion réussie.</p>";
					$this->ajoutConnecte($res['id']);
				}else{
					$message = "<p>La combinaison login/mot de passe est incorrecte.</p>";
				}
			}catch(PDOException $e){
				$message = "<p>Une erreur est survenue, veuillez réessayer.</p>";
			}
			return $message;
		}

		function setPhotoUtilisateur($idUtilisateur, $image, $nomImage){
			if($image['error'] = 0){
				$info = "Erreur lors du transfert de l'image";
			}else{
				$extensions_valides = array('jpg','jpeg');
				$extension_upload = strtolower(substr(strrchr($image['name'],'.'),1));
				if(in_array($extension_upload,$extensions_valides)){
					if($nomImage == "defaut.jpg") {
						$nomImage = md5(uniqid(rand(), true));
						$nomImage = $nomImage.".".$extension_upload;
						$_SESSION['utilisateur']->setPhoto($nomImage);
						$req = $this->connexion->getConnexion()->prepare('UPDATE utilisateurs SET photo = ? WHERE id = ?');
						$req->execute(array($nomImage, $idUtilisateur));
					}
					$tailleImage = getimagesize($image['tmp_name']);
					$largeur = $tailleImage[0];
					$this->creerImage($image, $nomImage, 200, "assets/images/");
					$info = "L'image a bien été modifiée.";
				}else{
					$info = "Le fichier uploadé n'est pas une image jpeg.";
				}
			}
			return $info;
		}

		function creerImage($image,$nomImage,$largeur,$dossier){
			$imageRedimensionnee = imagecreatefromjpeg($image['tmp_name']);
			$tailleImage = getimagesize($image['tmp_name']);
			$reduction = ($largeur * 100)/$tailleImage[0];
			$hauteur = (($tailleImage[1] * $reduction)/100);
			$imageFinale = imagecreatetruecolor($largeur , $hauteur) or die ("Erreur");
			imagecopyresampled($imageFinale , $imageRedimensionnee, 0, 0, 0, 0, $largeur, $hauteur, $tailleImage[0],$tailleImage[1]);
			imagejpeg($imageFinale, $dossier.$nomImage, 100);
		}

		function getUtilisateur($idUtilisateur){ // Créée un objet Utilisateur correspondant à l'id en paramètre

			return $utilisateur;
		}

		function creerConversation($idUtil, $idCorrespondant){ // Créée une conversation entre les 2 utilisateurs

			return $conversation;
		}

		function getConversation($idUtil, $idCorrespondant){ // Retoune la conversation entre l'utilisateur et un ami

			return $conversation;
		}

		function getMessagesConversation($idConversation){ // Retroune la liste des messages de la conversation en paramètre

			return $listeMessages;
		}

		function ajouterMessageConversation($message, $conversation){ // Ajoute un message à la conversation (AJAX)

			return $conversation;
		}

		function ajoutConnecte($idUtilisateur){ // Ajoute l'utilisateur qui se connecte et met un objet Connectes en session
			$reqAjout = $this->connexion->getConnexion()->prepare('INSERT INTO connectes VALUES (?, NOW())');
			$reqAjout->execute(array($idUtilisateur));
			$_SESSION['listeConnectes'] = new Connectes();
			$this->MaJListeConnectes();
		}

		function MaJListeConnectes(){ // Met à jour la liste des connectés et le timestamp de l'utilisateur courant
			$reqMaJ = $this->connexion->getConnexion()->prepare('UPDATE connectes SET derniereInteraction = NOW() WHERE idUtilisateur = ?');
			$reqMaJ->execute(array($_SESSION['utilisateur']->getId()));
			$this->supprimerConnectesInactifs();
			$connectes = array();
			$req = $this->connexion->getConnexion()->query('SELECT idUtilisateur FROM connectes');
			while($ligne = $req->fetch()){
				$utilisateur = $ligne[0];
				array_push($connectes, $utilisateur);
			}
			$_SESSION['listeConnectes']->MaJListe($connectes);
		}

		function supprimerConnectesInactifs(){
			$reqSuppression = $this->connexion->getConnexion()->prepare('DELETE FROM connectes WHERE TIMESTAMPDIFF(MINUTE, derniereInteraction, NOW()) > 5');
			$reqSuppression->execute(array());
		}

		function deconnexionUtilisateur(){ // Supprime l'utilisateur des membres connectés
			$reqDeconnexion = $this->connexion->getConnexion()->prepare('DELETE FROM connectes WHERE idUtilisateur = ?');
			$reqDeconnexion->execute(array($_SESSION['utilisateur']->getId()));
			$this->supprimerConnectesInactifs();
		}

	}
?>