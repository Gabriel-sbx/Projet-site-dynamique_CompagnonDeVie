<?php
	require_once("entity_mother.php");
	/**
	* Classe entity pour les utilisateurs
	* @author Soubeyroux Gabriel
	* @version 1.0
	* @date 19/01/2025-15/02/2025
	*/
	class User extends MotherEntity{
		//Compter le nombre d'utilisateur du site au status utilisateurs "UC"
		private int $_count_user 	  = 0 ;
		//Récuperation du prénom de l'utilisateurs
		private string $_surname 	  ="";
		//Récuperationdu pseudo de l'utilisateurs
		private string $_pseudo 	  ="";
		//Récuperation de l'email de l'utilisateurs
		private string $_email 		  ="";
		//Récuperation du mot de passe de l'utilisateurs
		private string $_password     ="";
		//Récuperation du type de l'utilisateurs
		private string $_type 		  ="UC";
			
		public function __construct(){
			parent::__construct();
			$this->_prefixe = 'user';
		}
/*************************************************Nombre d'utilisateur****************************************************************************/
		/**
		* Recuperation du nombre d'utilisateur'
		* @return int nombre d'utilisateur'
		*/
		public function getCount_user():int{
			return $this->_count_user;
		}
		/**
		* Mise à jour du nombre d'utilisateur
		* @param int $intNumberUser nombre d'utilisateur
		*/
		public function setCount_user(int $intNumberUser){
			$this->_count_user = $intNumberUser;
		}
/*************************************************PRENOM****************************************************************************/
		/**
		* Récupération de du prénom de l'utilisateur
		* @return string prénom de l'utilisateur
		*/
		public function getSurname():string{
			return $this->_surname;
		}
		/**
		* Mise à jour du prenom de l'utilisateur
		* @param string $strSurname prénom de l'utilisateur
		*/
		public function setSurname(string $strSurname){
			$this->_surname = htmlspecialchars(trim($strSurname));
		}

/*************************************************PSEUDO****************************************************************************/
		/**
		* Recuperation du pseudo de l'utilisateur
		* @return string pseudo de l'utilisateur
		*/
		public function getPseudo():string{
			return $this->_pseudo;
		}
		/**
		* Mise à jour du pseudo de l'utilisateur
		* @param string $strPseudo pseudo de l'utilisateur
		*/
		public function setPseudo(string $strPseudo){
			$this->_pseudo = htmlspecialchars(trim($strPseudo));
		}

/*************************************************EMAIL****************************************************************************/
		/**
		* Recuperation de l'email de l'utilisateur
		* @return string email de l'utilisateur
		*/
		public function getEmail():string{
			return $this->_email;
		}
		/**
		* Mise à jour de l'email de l'utilisateur
		* @param string $strEmail email de l'utilisateur
		*/
		public function setEmail(string $strEmail){
			$this->_email= htmlspecialchars(strtolower(trim($strEmail)));
		}
/*************************************************PASSWORD****************************************************************************/
		/**
		* Recuperation du password de l'utilisateur
		* @return string password de l'utilisateur
		*/
		public function getPassword():string{
			return $this->_password;
		}
		/**
		* Mise à jour du password de l'utilisateur
		* @param string $strPassword password de l'utilisateur
		*/
		public function setPassword(string $strPassword){
			$this->_password = $strPassword;
		}
		/**
		* Récupération du mot de passe haché de l'utilisateur
		* @return string mot de passe haché de l'utilisateur
		*/
		public function getPasswordHash(){
			return password_hash($this->getPassword(), PASSWORD_DEFAULT);
		}
		
/*************************************************TYPE****************************************************************************/
		/**
		* Recuperation du type de l'utilisateur
		* @return string type de l'utilisateur
		*/
		public function getType():string{
			return $this->_type;
		}
		/**
		* Mise à jour du type de l'utilisateur
		* @param string $strType type de l'utilisateur
		*/
		public function setType(string $strType){
			$this->_type= $strType;
		}


	}