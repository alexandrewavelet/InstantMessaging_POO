<?php
	class Manager{
	
		protected $connexion;
		protected $listeConnectes;
		
		function __construct(){ // Constructeur, initialisation d'un objet ConnexionBDD

		}

		function creerUtilisateur($login, $motDePasse){ // Créée un utilisateur dans la BDD et renvoie son objet

			return $utilisateur;
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

		// Getters simples

		function getListeConnectes(){
			
			return $this->listeConnectes;
		}

	}
?>