<?php
	class Utilisateur{
	
		protected $id;
		protected $login;
		protected $conversations;
		protected $photo;
		
		function __construct($pid,$plogin,$pphoto){ // Constructeur
			$this->id = $pid;
			$this->login = $plogin;
			$this->photo = $pphoto;
			$this->conversations = array();
		}

		function getConversationAvec($idUtilisateur){ // Retourne la conversation avec l'utilisateur en paramètre, la créée sinon

			return $conversation;
		}

		function afficherUtilisateurConnecte(){ // Affiche la vignette de l'utilisateur dans la liste des connectés

		}

		function afficherUtilisateurConversation(){ // Affiche les infos de l'utilisateur dans la zone de messages

		}

		function ajouterConversation($conversation){ // Ajoute une conversation

		}

		function afficherConversation($idUtilisateur){ // Affiche la conversation correspondante

		}

		// Getters simples

		function getId(){
			return $this->id;
		}

		function getLogin(){
			return $this->login;
		}

		function getConversations(){
			return $this->conversations;
		}

	}
?>