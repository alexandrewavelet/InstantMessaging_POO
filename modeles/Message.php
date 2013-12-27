<?php
	class Message{
	
		protected $id;
		protected $contenu;
		protected $date;
		protected $idUtilisateurEnvoyeur;
		
		function __construct($pid, $pcontenu, $pdate, $pidUtilisateur){ // Constructeur
			$this->id = $pid;
			$this->contenu = $pcontenu;
			$this->date = $pdate;
			$this->idUtilisateurEnvoyeur = $pidUtilisateur;
		}

		function afficher($loginCorrespondant){ // Affiche le message dans la zone de messagerie
			if ($this->estDeMoi()) {
				echo '<div class="message gris">';
				echo '<p>De moi, le '.$this->date.'</p>';
			}else{
				echo '<div class="message messagedroite cadrebleu">';
				echo '<p>De '.$loginCorrespondant.' le '.$this->date.'</p>';
			}
			echo $this->contenu.'</div>';
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