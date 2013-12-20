<?php
	class Conversation{
	
		protected $id;
		protected $utilisateurDestinataire;
		protected $messages;
		
		function __construct(){ // Constructeur

		}

		function Afficher(){ // Affiche les messages de la conversation

		}

		function ajouterMessage($message){ // Ajoute un message à la conversation

		}

		function afficherDernierMessage(){ // Affiche le dernier message reçu (pour l'AJAX)

		}

		// Getters simples

		function getId(){
			return $this->id;
		}

		function getDestinataire(){
			return $this->utilisateurDestinataire;
		}

		function getMessages(){
			return $this->messages;
		}

	}
?>