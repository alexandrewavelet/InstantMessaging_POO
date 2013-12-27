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
					$message = array(false,"<p>Le login que vous avez choisi est déjà pris, veuillez en choisir un nouveau.</p>");
				}else{
					$req = $this->connexion->getConnexion()->prepare('INSERT INTO utilisateurs VALUES (0, ?, ?, "avatar-defaut.jpg")');
					$req->execute(array($login,md5($motDePasse)));
					$idUtilisateur = $this->connexion->getConnexion()->lastInsertId();
					$_SESSION['utilisateur'] = new Utilisateur($idUtilisateur, $login, "avatar-defaut.jpg");
					$this->ajoutConnecte($idUtilisateur);
					$message = "<p>Inscription réussie, vous pouvez commencer à utiliser la messagerie.</p>";
				}
			}catch(PDOException $e){
				$message = array(false,"<p>une erreur est survenue, veuillez réessayer.</p>");
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
					$message = array(false,"<p>La combinaison login/mot de passe est incorrecte.</p>");
				}
			}catch(PDOException $e){
				$message = array(false,"<p>Une erreur est survenue, veuillez réessayer.</p>");
			}
			return $message;
		}

		function getUtilisateur($idUtilisateur){
			$req = $this->connexion->getConnexion()->prepare('SELECT login, photo FROM utilisateurs WHERE id = ?');
			$req->execute(array($idUtilisateur));
			$donneesUtilisateur = $req->fetch();
			$utilisateur = new Utilisateur($idUtilisateur, $donneesUtilisateur['login'], $donneesUtilisateur['photo']);
			return $utilisateur;
		}

		function setPhotoUtilisateur($idUtilisateur, $image, $nomImage){
			if($image['error'] = 0){
				$info = "Erreur lors du transfert de l'image";
			}else{
				$extensions_valides = array('jpg','jpeg');
				$extension_upload = strtolower(substr(strrchr($image['name'],'.'),1));
				if(in_array($extension_upload,$extensions_valides)){
					if($nomImage == "avatar-defaut.jpg") {
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

		function ouvrirConversation($idUtilisateurConnecte, $idUtilisateur){
			$req = $this->connexion->getConnexion()->prepare('SELECT COUNT(*) FROM conversations WHERE (idUtilisateur1 = ? OR idUtilisateur1= ?) AND (idUtilisateur2 = ? OR idUtilisateur2 = ?)');
			$req->execute(array($idUtilisateurConnecte, $idUtilisateur, $idUtilisateurConnecte, $idUtilisateur));
			$conversation = $req->fetch()[0];
			if ($conversation == 0) {
				$idConversation = $this->creerConversation($idUtilisateurConnecte, $idUtilisateur);
			}else{
				$idConversation = $this->getConversation($idUtilisateurConnecte, $idUtilisateur);
			}
			return $idConversation;
		}

		function conversationEnMemoire($idCorrespondant){
			$reponse = 0;
			$idConversation = $_SESSION['utilisateur']->getConversationParCorrespondant($idCorrespondant);
			if ($idConversation > 0) {
				$reponse = $idConversation;
			}
			return $reponse;
		}

		function MaJConversation($idConversation){ // Renvoie la liste des messages de la conversation en paramètres
			$messages = array();
			$req = $this->connexion->getConnexion()->prepare('SELECT id, idUtilisateur, dateMessage, contenu FROM messages WHERE idConversation = ?');
			$req->execute(array($idConversation));
			while ($ligne = $req->fetch()) {
				array_push($messages, new Message($ligne['id'], $ligne['contenu'], $ligne['dateMessage'], $ligne['idUtilisateur']));
			}
			return $messages;
		}

		function creerConversation($idUtil, $idCorrespondant){ // Créée une conversation entre les 2 utilisateurs
			$req = $this->connexion->getConnexion()->prepare('INSERT INTO conversations VALUES (0, ?, ?)');
			$req->execute(array($idUtil, $idCorrespondant));
			$idConversation = $this->connexion->getConnexion()->lastInsertId();
			$conversation = new Conversation($idConversation, $idCorrespondant);
			$_SESSION['utilisateur']->ajouterConversation($conversation);
			return $idConversation;
		}

		function getConversation($idUtil, $idCorrespondant){ // met en session la conversation entre l'utilisateur et son correspondant
			$req = $this->connexion->getConnexion()->prepare('SELECT id, idUtilisateur1, idUtilisateur2 FROM conversations WHERE (idUtilisateur1 = ? OR idUtilisateur1= ?) AND (idUtilisateur2 = ? OR idUtilisateur2 = ?)');
			$req->execute(array($idUtil, $idCorrespondant, $idUtil, $idCorrespondant));
			$donneesConversation = $req->fetch();
			if ($donneesConversation[1] == $_SESSION['utilisateur']->getId()) {
				$destinataire = $donneesConversation[2];
			}else{
				$destinataire =$donneesConversation[1];
			}
			$messages = $this->MaJConversation($donneesConversation[0]);
			$conversation = new Conversation($donneesConversation[0], $destinataire, $messages);
			$_SESSION['utilisateur']->ajouterConversation($conversation);
			return $donneesConversation[0];
		}

		function enregistrerMessage($idConversation, $message){
			$req = $this->connexion->getConnexion()->prepare('INSERT INTO messages VALUES (0, ?, ?, NOW(), ?)');
			$req->execute(array($idConversation, $_SESSION['utilisateur']->getId(), $message));
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
			$req = $this->connexion->getConnexion()->query('SELECT idUtilisateur, login, photo FROM connectes, utilisateurs WHERE id = idUtilisateur');
			while($ligne = $req->fetch()){
				$utilisateur = new Utilisateur($ligne[0],$ligne[1],$ligne[2]);
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