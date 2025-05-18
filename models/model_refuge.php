<?php
	/**
	* Classe de gestion de la base de données pour les refuges
	* @author Soubeyroux Gabriel
	* @version 1.0
	* @date 22/02/2025
	*/
	require_once("model_mother.php");
	class RefugeModel extends MotherModel{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}

/********************************************************* Affichage des refuges*******************************************************************/

			/**
			* Fonction permettant de récupérer tout les refuges  
			* @return array Si trouvé ou non 
            */

		public function refugeAll(): array {
			$strReadRefuge = "SELECT * FROM `refuge`;";
			$arrRefuge = $this->_db->query($strReadRefuge)->fetchAll();
			return $arrRefuge;
		}



		
	}



		
