
<?php
	require_once("entity_mother.php");
	/**
	* Classe entity pour les refuges

	* @author Soubeyroux Gabriel
	* @version 1.0
	* @date 22/02/2025
	*/
	class Refuge extends MotherEntity{
		
		///Récuperation de la ville du refuge en ENUM
		private string $_town		= "" ;
		///Récuperation du contact numero de téléphone du refuge
		private string $_contact	= "" ;
		///Récuperation de l'adresse du refuge
		private string $_adress		= "" ;
	



		public function __construct(){
			parent::__construct();
			$this->_prefixe = 'refuge';
		}
		

/*************************************************Ville en enum du refuge****************************************************************************/
		/**
		* Récupération de la Ville en enum du refuge
		* @return string Ville du refuge 
		*/
		public function getTown():string{
			return $this->_town;
		}

		/**
		* Mise à jour  de la Ville en enum du refuge
		*/
		public function setTown(string $strTown){
			$this->_town = $strTown;
		}

/*************************************************Contact du refuge****************************************************************************/
		/**
		* Récupération du contact du refuge
		* @return string du contact du refuge
		*/
		public function getContact():string{
			return $this->_contact;
		}

		/**
		* Mise à jour  du contact du refuge
		* @param string $strContact du contact du refuge
		*/
		public function setContact(string $strContact ){
			$this->_contact = $strContact;
		}
/*************************************************Adresse du refuge****************************************************************************/
		/**
		* Récupération de l'adresse du refuge
		* @return string adresse du refuge
		*/
		public function getAdress():string{
			return $this->_adress;
		}

		/**
		* Mise à jour de l'adresse du refuge
		* @param string $strAdress adresse du refuge
		*/
		public function setAdress(string $strAdress){
			$this->_adress = $strAdress;
		}





	}