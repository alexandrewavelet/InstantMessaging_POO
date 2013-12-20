<?php
	class ConnexionBDD{
	
		protected $connexion;
		
		function __construct(){
			$dsn = "mysql:host=localhost;dbname=nombdd";
			$user = "root";
			$pass = "";
			try {
				$this->connexion = new PDO($dsn, $user, $pass);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		function getConnexion(){
			return $this->connexion;
		}
	}
?>