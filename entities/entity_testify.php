
<?php
	require_once("entity_mother.php");
	/**
	* Classe entity pour les témoignages
	* @author Soubeyroux Gabriel
	* @version 1.0
	* @date 19/01/2025-15/02/2025
	*/
	class Testify extends MotherEntity{
		//Compter le nombre d'utilisateur du site au status utilisateurs "UC"
		private int $_count_testify 	= 0  ;
		//Récuperation du titre du témoignages
		private string $_title 			= "" ;
		//Récuperation de la description du témoignages
		private string $_description 	= "" ;
		//Récuperation de l'image du témoignages
		private string $_picture 		= "" ;
		//Récuperation du pseudo de l'auteur du témoignages
		private string $_user_pseudo 	= "" ;

		public function __construct(){
			parent::__construct();
			$this->_prefixe = 'test';
		}
		
/*************************************************Nombre de témoignages****************************************************************************/
		/**
		* Recuperation du nombre de témoignages
		* @return int nombre de témoignages
		*/
		public function getCount_testify():int{
			return $this->_count_testify;
		}
		/**
		* Mise à jour du nombre de témoignages
		* @param int $intNumberTestify nombre de témoignages
		*/
		public function setCount_testify(int $intNumberTestify){
			$this->_count_testify = $intNumberTestify;
		}





/*************************************************Titre****************************************************************************/
		/**
		* Récupération du titre du témoignages
		* @return string nom du titre du témoignages
		*/
		public function getTitle():string{
			return $this->_title;
		}

		/**
		* Mise à jour  du titre du témoignages
		* @param string $strTitle nom  du titre du témoignages
		*/
		public function setTitle(string $strTitle){
			$this->_title = str_replace("<script>", "", str_replace("</script>", "", $strTitle));
			//$this->_title = htmlspecialchars($strTitle);
		}

/*************************************************Description****************************************************************************/
		/**
		* Récupération du Description du témoignages
		* @return string 'Description du témoignages
		*/
		public function getDescription():string{
			return $this->_description;
		}

		/**
		* Mise à jour du Description du témoignages
		* @param string $strDescription nom du Description du témoignages
		*/
		public function setDescription(string $strDescription){
			$this->_description = str_replace("<script>", "", str_replace("</script>", "", $strDescription));
		}
/*************************************************Image****************************************************************************/
		/**
		* Récupération de l'image du témoignages
		* @return string 'image du témoignages
		*/
		public function getPicture():string{
			return $this->_picture;
		}

		/**
		* Mise à jour de l'image du témoignages
		* @param string $strPicture nom de l'image du témoignages
		*/
		public function setPicture(string $strPicture){
			$this->_picture = $strPicture;
		}

/************************************************Pseudo de utilisateur qui témoigne****************************************************************************/
		/**
		* Recuperation du Pseudo de utilisateur qui témoigne
		* @return string Pseudo de utilisateur qui témoigne
		*/
		public function getUser_pseudo():string{
			return $this->_user_pseudo;
		}
		/**
		* Mise à jour du Pseudo de utilisateur qui témoigne
		* @param string $strUserPseudoTesty Pseudo de utilisateur qui témoigne
		*/
		public function setUser_pseudo(string $strUserPseudoTesty){
			$this->_user_pseudo = $strUserPseudoTesty;
		}
		



	}