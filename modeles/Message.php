<?php
	class Message{
	
		protected $id;
		protected $contenu;
		protected $date;
		protected $idUtilisateurEnvoyeur;
		
		function __construct(){ // Constructeur

		}

		function afficherMessage(){ // Affiche le message dans la zone de messagerie

		}

		function estDeMoi(){ // Vérifie si le message viens de l'utilisateur ou de son correspondant

		}

		// Getters simples

		function getId(){
			return $this->id;
		}

		function getContenu(){
			return $this->contenu;
		}

		function getDate(){
			return $this->date;
		}

		function getEnvoyeur(){
			return $this->idUtilisateurEnvoyeur;
		}
	}
?>