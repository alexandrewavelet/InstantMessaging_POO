<?php
	include("ConnexionBDD.php");
	include("Utilisateur.php");
	include("Connectes.php");
	include("Conversation.php");
	include("Message.php");

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
					$message = "<p>Inscription réussie!</p>";
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
					$message = "<p>Connexion réussie!</p>";
				}else{
					$message = "<p>La combinaison login/mot de passe est incorrecte.</p>";
				}
			}catch(PDOException $e){
				$message = "<p>Une erreur est survenue, veuillez réessayer.</p>";
			}
			return $message;
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

		function rafraichirListeConnectes($idUtilisateur = 0){ // Actualise la liste des connectés

		}

		function ajoutConnecte($idUtilisateur){

			$listeConnectes = $this->MaJListeConnectes();
			return $listeConnectes;
		}

		function MaJListeConnectes(){
			
			return $listeConnectes;
		}

	}
?>