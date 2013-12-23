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
				$reqLogin = $this->connexion->getConnexion()->prepare('SELECT COUNT(id) FROM utilisateurs WHERE login = ?');
				$reqLogin->execute(Array($login));
				$loginExiste = $reqLogin->fetch();
				if ($loginExiste) {
					$message = "<p>Le login que vous avez choisi est déjà pris, veuillez en choisir un nouveau.</p>";
				}else{
					$req = $this->connexion->getConnexion()->prepare('INSERT INTO utilisateurs VALUES (0, ?, ?, "defaut.jpg")');
					$req->execute(Array($login,md5($motDePasse)));
					// ajouter l'objet utilisateur à la session
					$message = "<p>Inscription réussie!</p>";
				}
			}catch(PDOException $e){
				$message = "<p>une erreur est survenue, veuillez réessayer.</p>";
			}
			return $message;
		}

		function estConnecte(){

			return $booleen;
		}

		function connexionUtilisateur($login, $motDePasse){ // Connecte un utilisateur : renvoie l'objet utilisateur ou une chaîne

			return $reponse;
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