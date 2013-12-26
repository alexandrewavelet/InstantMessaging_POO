<?php
	class Message{
	
		protected $id;
		protected $contenu;
		protected $date;
		protected $idUtilisateurEnvoyeur;
		
		function __construct($pid, $pcontenu, pdate, $pidUtilisateur){ // Constructeur
			$this->$id = $pid;
			$this->$contenu = $pcontenu;
			$this->$date = $pdate;
			$this->$idUtilisateurEnvoyeur = $pidUtilisateur;
		}

		function afficherMessage(){ // Affiche le message dans la zone de messagerie

		}

		function estDeMoi(){ // Vérifie si le message viens de l'utilisateur ou de son correspondant
			$booleen = false;
			if ($_SESSION['utilisateur']->getId() == $this->idUtilisateurEnvoyeur) {
				$booleen = true;
			}
			return $booleen;
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