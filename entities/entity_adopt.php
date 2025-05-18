
<?php
	require_once("entity_mother.php");
	/**
	* Classe concernant les adoptions
	* @author 
	*/
	class Adopt extends MotherEntity{
			
		private int $_count_adopt   = 0  ;
		private int $_animal_id 	= 0  ;
		//private string $_status = ""  ;
		private string $_date_demand = "" ;
		private string $_user_pseudo = "" ;
		private string $_animal_name = "" ;
 
		public function __construct(){
			parent::__construct();
			$this->_prefixe = 'adopt';
		}
/*************************************************Nombre d'adoptions****************************************************************************/
		/**
		* Recuperation du nombre d'adoptions
		* @return int nombre de favoris
		*/
		public function getCount_adopt():int{
			return $this->_count_adopt;
		}
		/**
		* Mise à jour du nombre d'adoptions
		* @param int $intNumberAdopt nombre d'adoptions
		*/
		public function setCount_adopt(int $intNumberAdopt){
			$this->_count_adopt = $intNumberAdopt;
		}
	/*************************************************Identifiant de l'animal adopter ****************************************************************************/
		/**
		* Recuperation de l'animal adopter 
		* @return int de l'animal adopter 
		*/
		public function getAnimal_id():int{
			return $this->_animal_id;
		}
		/**
		* Mise à jour de l'animal adopter 
		* @param int $intAnimalId de l'animal adopter 
		*/
		public function setAnimal_id(int $intAnimalId){
			$this->_animal_id = $intAnimalId;
		}
	
			/*************************************************Date de demande de l'adoption****************************************************************************/
		/**
		* Recuperation du Date de demande d'adoptions
		* @return string Date de demande d'adoptions
		*/
		public function getDate_demand():string{
			return $this->_date_demand;
		}
		/**
		* Mise à jour du Date de demande d'adoptions
		* @param string $strDateDemandAdopt Date de demande d'adoptions
		*/
		public function setDate_demand(string $strDateDemandAdopt){
			$this->_date_demand = $strDateDemandAdopt;
		}
			/************************************************Pseudo de utilisateur qui adopte****************************************************************************/
		/**
		* Recuperation du Pseudo de utilisateur qui adopte
		* @return string Pseudo de utilisateur qui adopte
		*/
		public function getUser_pseudo():string{
			return $this->_user_pseudo;
		}
		/**
		* Mise à jour du Pseudo de utilisateur qui adopte
		* @param string $strUserPseudoAdopt Pseudo de utilisateur qui adopte
		*/
		public function setUser_pseudo(string $strUserPseudoAdopt){
			$this->_user_pseudo = $strUserPseudoAdopt;
		}
			/************************************************Nom de l'animal qui est adopter****************************************************************************/
		/**
		* Recuperation du Nom de l'animal qui est adopter 
		* @return string Nom de l'animal qui est adopter 
		*/
		public function getAnimal_name():string{
			return $this->_animal_name;
		}
		/**
		* Mise à jour du Nom de l'animal qui est adopter 
		* @param string $strAnimalNameAdopt Nom de l'animal qui est adopter 
		*/
		public function setAnimal_name(string $strAnimalNameAdopt){
			$this->_animal_name = $strAnimalNameAdopt;
		}
	}

	