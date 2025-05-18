<?php
	require_once("entity_mother.php");
	    /**
	* Entity de la class Animal
	* @author Fabrice
	* @version 1.0
	* @date 19/01/2025-15/02/2025
	*/
	
	class Animal extends MotherEntity{

		private string $_picture ="";
		private string $_refuge_name;
		private string $_date_birth ="";
		private string $_breed_name ="";
		private string $_spec_name;
		private string $_breed_characteristics;
		private string $_cat_name;
		private string $_pic_picture ;
		private string $_description ="";
		private int    $_breed_id =0;
		private int    $_refuge_id =0;
		private int    $_pic_id =0;
		private int    $_pic_animal_id =0;
		private string $_compatibility_animals="";
		private string $_compatibility_children="";
		private string $_sexe="";
		

       /**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
			$this->_prefixe = 'animal';
		}

		/**
		* Récupération du sexe de l'animal
		* @return string du sexe de l'animal
		*/

		public function getSexe(){
			return $this->_sexe;
		}

	   /**
	   * Mise à jour du sexe de l'animal
	   * @param string $strSexe du sexe de l'animal 
	   */
	   public function setSexe(string $strSexe){
		   $this->_sexe = $strSexe;
		}

		/**
		* Récupération de la compatibilité avec les enfants
		* @return string de la compatibilité avec les enfants
		*/

		public function getCompatibility_children(){
			return $this->_compatibility_children;
		}

	   /**
	   * Mise à jour de la compatibilité avec les enfants
	   * @param string $strCompatibilityChildren de la compatibilité avec les enfants 
	   */
	   public function setCompatibility_children(string $strCompatibilityChildren){
		   $this->_compatibility_children = $strCompatibilityChildren;
		}

		/**
		* Récupération de la compatibilité avec les animaux
		* @return string de la compatibilité avec les animaux
		*/

		public function getCompatibility_animals(){
			return $this->_compatibility_animals;
		}

	   /**
	   * Mise à jour de la compatibilité avec les animaux
	   * @param string $strCompatibilityAnimals de la compatibilité avec les animaux 
	   */
	   public function setCompatibility_animals(string $strCompatibilityAnimals){
		   $this->_compatibility_animals = $strCompatibilityAnimals;
		}

		/**
		* Récupération de l'id du refuge de l'animal
		* @return int du refuge de l'animal
		*/

		public function getRefuge_id():int{
			return $this->_refuge_id;
		}

	   /**
	   * Mise à jour du refuge de l'animal
	   * @param int $intRefugeId du refuge de l'animal 
	   */
	   public function setRefuge_id(int $intRefugeId){
		   $this->_refuge_id = intval($intRefugeId);
		}
		/**
		* Récupération de l'id de l image de l'animal
		* @return int d'id de l image de l'animal
		*/

		public function getPic_id():int{
			return $this->_pic_id;
		}

	   /**
	   * Mise à jour du 'id de l image de l'animal
	   * @param int $intPicd d'id de l image de l'animal 
	   */
	   public function setPic_id(int $intPicd){
		   $this->_pic_id = intval($intPicd);
		}

		/**
		* Récupération de l'id  de l'image de l'animal 
		* @return int d'id de l'animal a qui appartient l'image
		*/

		public function getPic_animal_id():int{
			return $this->_pic_animal_id;
		}

	   /**
	   * Mise à jour du 'id de l image de l'animal
	   * @param int $intPicd d'id de l image de l'animal 
	   */
	   public function setPic_animal_id(int $intPicd){
		   $this->_pic_animal_id = intval($intPicd);
		}
		
		/**
		* Récupération de l'id de la race de l'animal
		* @return int id de la race de l'animal
		*/

		public function getBreed_id():int{
		 	return $this->_breed_id;
		}

		/**
		 * Mise à jour de la race de l'animal
		 * @param int $intBreedId id de la race de l'animal
		*/
		public function setBreed_id(int $intBreedId){
			$this->_breed_id = intval($intBreedId);
		}

		/**
		* Récupération du nom l'image
		* @return string nom de l'image
		*/
		public function getPicture(){
			return $this->_picture;
		}

		/**
		* Mise à jour du nom l'image
		* @param string $strPicture nom de l'image
		*/
		public function setPicture(string $strPicture){
			$this->_picture = $strPicture;
		}

        /**
		* Récupération du nom de la race
		* @return string nom de la race
		*/
		public function getBreed_name(){
		return $this->_breed_name;
		}

        /**
         * Mise a jour du nom de la race
         */
		public function setBreed_name(string $strBreed){
            $this->_breed_name = $strBreed;
		}

		/**
		* Récupération du nom de refuge
		* @return string nom de refuge
		*/
		public function getRefuge_name(){
		return $this->_refuge_name;
		}
        
		/**
		* Mise à jour du nom de refuge
		* @param string $strRefuge nom de refuge
		*/
		public function setRefuge_name(string $strRefuge){
			$this->_refuge_name = $strRefuge;
		}
		
		/**
		* Récupération de la date de naissance
		* @return string date de naissance
		*/
		public function getDate_birth(){
			return $this->_date_birth;
		}

		/**
		* Mise à jour de la date de naissance
		* @param string $strDate date de naissance
		*/
		public function setDate_birth(string $strDate){
			$this->_date_birth = $strDate;
		}

		/**
		* Fonction pour calculer l'age de l'animal d'après sa date de naissance
		* @return string age en année
		*/
		public function getAge(){
			$dateBirth = New Datetime($this->getDate_birth());
			$dateNow = New DateTime();
			$diff = $dateBirth->diff($dateNow);
			return $diff->y ;
		}

		/**
		* Récupération du nom de l'espece de l'animal
		* @return string nom de l'espece de l'animal
		*/
		public function getSpec_name(){
			return $this->_spec_name;
		}

		/**
		* Mise à jour du nom de l'espece de l'animal
		* @param string $strSpec nom de l'espece de l'animal
		*/
		public function setSpec_name(string $strSpec){
			$this->_spec_name = $strSpec;
		}

		/**
		* Récupération des caracteristique de la race de l'animal
		* @return string caracteristique de la race de l'animal
		*/
		public function getBreed_characteristics(){
			return $this->_breed_characteristics;
		}

		/**
		* Mise à jour des caracteristique de la race de l'animal
		* @param string  $strBreedCharact caracteristique de la race de l'animal 
		*/
		public function setBreed_characteristics(string $strBreedCharact){
			$this->_breed_characteristics = $strBreedCharact;
		}

		/**
		* Récupération du nom de la categorie
		* @return string nom de la categorie
		*/
		public function getCat_name(){
			return $this->_cat_name;
		}

		/**
		* Mise à jour du nom de la categorie
		* @param string $strCatName nom de la categorie 
		*/
		public function setCat_name(string $strCatName){
			$this->_cat_name = $strCatName;
		}

		/**
		* Récupération du nom de l'image de l'animal pour la fiche détaillée
		* @return string nom de l'image de l'animal pour la fiche détaillée
		*/
		public function getPic_picture(){
			return $this->_pic_picture;
		}

		/**
		* Mise à jour du nom de l'image de l'animal pour la fiche détaillée
		* @param string $strPicPicture nom de l'image de l'animal pour la fiche détaillée 
		 */
		public function setPic_picture( $strPicPicture){
			$this->_pic_picture = $strPicPicture;
		}

		/**
		* Récupération de la description de l'animal
		* @return string de la description de l'animal
		*/
		public function getDescription(){
			return $this->_description;
		}

		/**
		* Mise à jour de la description de l'animal
		* @param string $strDescription de la description de l'animal 
		*/
		public function setDescription(string $strDescription){
			$this->_description = $strDescription;
		}		
}