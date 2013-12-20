<?php
	class ConnexionBDD{
	
		protected $connexion;
		
		function __construct(){ // Initialisation de l'objet PDO
			$dsn = "mysql:host=localhost;dbname=nombdd";
			$user = "root";
			$pass = "";
			try {
				$this->connexion = new PDO($dsn, $user, $pass);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		function getConnexion(){ // Retourne l'objet PDO
			return $this->connexion;
		}
	}
?>