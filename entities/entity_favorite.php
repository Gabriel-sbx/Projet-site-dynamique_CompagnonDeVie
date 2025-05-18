<?php
	require_once("entity_mother.php");
	/**
	* Classe concernant les favoris
	* @author 
	*/
	class Favorite extends MotherEntity{
			
		private int $_count_favorite = 0  ;
		private string $_date = "";
		private int $_user_id = 0  ;
		private int $_animal_id = 0  ;


	


		public function __construct(){
			parent::__construct();
			$this->_prefixe = 'fav';
		}
		
/*************************************************Nombre de favoris****************************************************************************/
		/**
		* Recuperation du nombre de favoris
		* @return int nombre de favoris
		*/
		public function getCount_favorite():int{
			return $this->_count_favorite;
		}
		/**
		* Mise à jour du nombre de favoris
		* @param int $intNumberFavorite nombre de favoris
		*/
		public function setCount_favorite(int $intNumberFavorite){
			$this->_count_favorite = $intNumberFavorite;
		}
/*************************************************Date de favoris****************************************************************************/
		/**
		* Recuperation de la date  de favoris
		* @return string de la date  de favoris
		*/
		public function getDate():string{
			return $this->_date;
		}
		/**
		* Mise à jour de la date favoris
		* @param string $strDateFavorite de la date  de favoris
		*/
		public function setDate(string $strDateFavorite){
			$this->_date = $strDateFavorite;
		}


/***************************************************IDENTIFIANT UTILISATEUR***************************************************************************/
		/**              
		* Récupération de l'id de l'utilisateur
		* @return int l'identifiant de l'utilisateur
		*/
		public function getUser_id():int{
			return $this->_user_id;
		}
		/**
		* Mise à jour de l'id de l'utilisateur
		* @param int $intId l'identifiant de l'utilisateur 
		*/
		public function setUser_id(int $intId){
			$this->_user_id = $intId;
		}
/***************************************************IDENTIFIANT ANIMAL***************************************************************************/
		/**              
		* Récupération de l'id de l'animal
		* @return int l'identifiant de l'animal
		*/
		public function getAnimal_id():int{
			return $this->_animal_id;
		}
		/**
		* Mise à jour de l'id de l'animal
		* @param int $intId l'identifiant de l'animal
		*/
		public function setAnimal_id(int $intId){
			$this->_animal_id = $intId;
		}

	

	}