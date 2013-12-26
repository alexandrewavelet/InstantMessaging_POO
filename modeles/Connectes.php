<?php
	class Connectes{
	
		protected $listeConnectes;
		
		function __construct($liste = array()){ // Constructeur
			$this->listeConnectes = $liste;
		}

		function MaJListe($liste){ // Mise à jour de la liste
			$this->listeConnectes = $liste;
		}

		function afficherListe(){
			if (count($this->listeConnectes) < 2) {
				$liste = "<p>Il n'y a personne de connecté actuellement.</p>";
			}else{
				$liste = '<div class="table-responsive"><table class="table table-hover">';
				foreach ($this->listeConnectes as $utilisateur) {
					if ($utilisateur->getId() != $_SESSION['utilisateur']->getId()) {
						$liste = $liste.$utilisateur->afficherUtilisateurConnecte();
					}
				}
				$liste = $liste.'</table></div>';				
			}
			return $liste;
		}

	}
?>