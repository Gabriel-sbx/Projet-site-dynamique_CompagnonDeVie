<?php
	require_once("entity_mother.php");

	/**
	* Classe Event
	* @author Nabil
	* @version 1.0
	* @date 19/01/2025-15/02/2025
	*/
	
	class Event extends MotherEntity{

		private string $_description = "";
		private string $_picture = "";
		private string $_date = "";

		public function __construct(){
			parent::__construct();
			$this->_prefixe = 'event';
		}
		// /*************************************************IDENTIFIANT***************************************************************************/
		// /**
		// * Récupération de l'identifiant
		// * @return int de l'identifiant
		// */
	 
		/*************************************************DESCRIPTION****************************************************************************/
		/**
		* Recuperation du description 
		* @return string description
		*/
		public function getDescription():string{
			return $this->_description;
		}
		/**
		* Mise à jour du description
		* @param string $strEventDescription
		*/
		public function setDescription( string $strEventDescription){
			$this->_description = $strEventDescription;
		}

	

		/*************************************************PICTURE********************************************************************/
		/**
		* Recuperation du picture
		* @return string picture
		*/
		public function getPicture():string{
			return $this->_picture;
		}
		/**
		* Mise à jour du picture
		* @param string $strPicture
		*/
		public function setPicture(string $strPicture){
			$this->_picture= $strPicture;
		}
		
		/*************************************************DATE****************************************************************************/
		/**
		* Recuperation date
		* @return string date
		*/
		public function getDate():string{
			return $this->_date;
		}
		/**
		* Mise à jour date
		* @param string $strDate
		*/
		public function setDate(string $strDate){
			$this->_date= $strDate;
		}
	


	}


