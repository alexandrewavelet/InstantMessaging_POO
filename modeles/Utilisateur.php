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

		function getConversationParCorrespondant($idCorrespondant){
			$idConversation = 0;
			foreach ($this->conversations as $conversation) {
				if ($conversation->getDestinataire() == $idCorrespondant) {
					$idConversation = $conversation->getId();
				}
			}
			return $idConversation;
		}

		function getConversationAvec($idUtilisateur){ // Retourne la conversation avec l'utilisateur en paramètre, la créée sinon

			return $conversation;
		}

		function afficherUtilisateurConnecte(){ // Affiche la vignette de l'utilisateur dans la liste des connectés
			$ligne = '<tr><td><img class="img-responsive imgListe" src="assets/images/'.$this->photo.'"/></td><td>'.$this->login.'<br/><a href="cMessagerie.php?action=conversation&id='.$this->id.'"><button class="boutonHome liste">Converser</button></a></td></tr>';
			return $ligne;
		}

		function MaJConversation($idConversation, $messages){
			$this->$conversations[$idConversation]->MaJMessages($messages);
		}

		function afficherUtilisateurConversation(){ // Affiche les infos de l'utilisateur dans la zone de messages

		}

		function ajouterConversation($conversation){ // Ajoute une conversation
			$this->conversations[$conversation->getId()] = $conversation;
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

		function getPhoto(){
			return $this->photo;
		}

		// Setters simples

		function setPhoto($nouvellePhoto){
			$this->photo = $nouvellePhoto;
		}

	}
?>