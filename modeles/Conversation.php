<?php
	class Conversation{
	
		protected $id;
		protected $utilisateurDestinataire;
		protected $messages;
		
		function __construct($pid, $pdest, $pmessages = array()){ // Constructeur
			$this->id = $pid;
			$this->utilisateurDestinataire = $pdest;
			$this->messages = $pmessages;
		}

		function MaJMessages($liste){
			$this->messages = $liste;
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