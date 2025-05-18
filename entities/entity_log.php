<?php
	require_once("entity_mother.php");
	/**
	* Classe entity pour les logs de connexion
	* @author Soubeyroux Gabriel
	* @version 1.0
	* @date 05/02/2025-15/02/2025
	*/
	class Log extends MotherEntity{
		//Récuperationdu pseudo de l'utilisateurs qui s'est connecté
		private string $_user_pseudo 	= "" ;

		public function __construct(){
			parent::__construct();
			$this->_prefixe = 'log';
		}
/************************************************Pseudo de utilisateur qui c'est connecté****************************************************************************/
		/**
		* Recuperation du Pseudo de l'utilisateur qui c'est connecter
		* @return string Pseudo de utilisateur qui c'est connecter
		*/
		public function getUser_pseudo():string{
			return $this->_user_pseudo;
		}
		/**
		* Mise à jour du Pseudo de utilisateur qui c'est connecté
		* @param string $strUserPseudoTesty Pseudo de utilisateur qui c'est connecté
		*/
		public function setUser_pseudo(string $strUserPseudoTesty){
			$this->_user_pseudo = $strUserPseudoTesty;
		}

	}