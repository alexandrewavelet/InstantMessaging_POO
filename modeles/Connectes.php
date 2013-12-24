<?php
	class Connectes{
	
		protected $listeConnectes;
		
		function __construct($liste = array()){ // Constructeur
			$this->listeConnectes = $liste;
		}

		function MaJListe($liste){ // Mise à jour de la liste
			$this->listeConnectes = $liste;
		}

	}
?>