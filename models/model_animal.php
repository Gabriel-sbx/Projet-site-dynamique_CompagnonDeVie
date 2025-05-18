<?php
	/**
	* Classe de gestion de la base de données pour les animaux
	* @author Fabrice
	* @version 1.0
	* @date 14/01/2025
	*/

	require_once("model_mother.php");
	
	
    class AnimalModel extends MotherModel {

        /// Attributs pour la recherche dans le keyword
		public string 	$strKeywords 	= "";
		/// Attributs pour la recherche par date
		public string 	$strDate 		= "";
		/// Attributs pour la recherche taille
		public string 	$strtSize 		= "";
		/// Attributs pour la recherche par race
		public string   $strRaces	    = "";
		/// Attributs pour la recherche caractéristique
		public string   $strCharact	    = "";
		/// Attributs pour la recherche par catégorie
		public string   $strCategory	= "";
		/// Attributs pour la recherche par espece
		public string   $strSpec        = "";
		/// Attributs pour la recherche par refuge
		public string   $strRef         = "";
		/// Attributs pour la recherche sexe
		public string 	$strSexe 		= "";
		/// Attributs pour la recherche Categorie
		public int		$intCategoryId  = 0;
		/// Attributs pour la recherche par race
		public int		$intBreedId  	= 0;

        /**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}

		/**
		* Récupération d'un  animal
		* @param int $intAnimalId Nombre de résultats à afficher - si tous = 0
		* @return array Tableau des Animaux de la bdd
		*/

		public function findOne(int $intAnimalId):array{
			$strQueryCard = "SELECT spec_name, breed_name, breed_characteristics, breed_size, animal.*, 
							 refuge_name, cat_name
							 FROM animal
							 INNER JOIN refuge ON refuge_id = animal_refuge_id						 
							 INNER JOIN animal_breed ON breed_id = animal_breed_id
							 INNER JOIN animal_species ON breed_spec_id = spec_id
							 INNER JOIN animal_category ON spec_cat_id = cat_id
							 WHERE animal_id = :id";
		
			$prep = $this->_db->prepare($strQueryCard);
			$prep->bindValue(":id", $intAnimalId, PDO::PARAM_INT);
			$prep->execute();
			$arrAnimal = $prep->fetch();
			return $arrAnimal;      
		}		
	
		/**
		* Insertion en BDD d'un nouvel animal
		* @param object $objanimalAdd
		* @return bool L'insertion s'est bien passé ou pas
		*/		
		public function animalAdd(object $objanimalAdd):bool{
			try {	
				$strAnimalAdd 	= "INSERT INTO `animal`(animal_name, animal_description, animal_sexe, animal_picture, animal_compatibility_animals, animal_compatibility_children, animal_status, animal_date_birth, animal_date_crea, animal_refuge_id, animal_breed_id)
								VALUES  (:name, :description, :sexe, :picture, :compatibility_animals, :compatibility_children, :status, :date_birth, NOW(), :refuge_id, :breed_id);";   //:date_crea , :date_connect	
				$prep		= $this->_db->prepare($strAnimalAdd);
				$prep->bindValue(":name", $objanimalAdd->getName(), PDO::PARAM_STR);
				$prep->bindValue(":description", $objanimalAdd->getDescription(), PDO::PARAM_STR);
				$prep->bindValue(":sexe", $objanimalAdd->getSexe(), PDO::PARAM_STR);
				$prep->bindValue(":picture", $objanimalAdd->getPicture(), PDO::PARAM_STR);
				$prep->bindValue(":compatibility_animals", $objanimalAdd->getCompatibility_animals(), PDO::PARAM_STR);
				$prep->bindValue(":compatibility_children", $objanimalAdd->getCompatibility_children(), PDO::PARAM_STR);
				$prep->bindValue(":status", $objanimalAdd->getStatus(), PDO::PARAM_STR);
				$prep->bindValue(":date_birth", $objanimalAdd->getDate_birth(), PDO::PARAM_STR);
				$prep->bindValue(":refuge_id", $objanimalAdd->getRefuge_id(), PDO::PARAM_INT);
				$prep->bindValue(":breed_id", $objanimalAdd->getBreed_id(), PDO::PARAM_INT);
				$prep->execute();
				//var_dump($prep->debugDumpParams());
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}

		/**
		* Insertion en BDD d'une nouvelle image dans le caroussel
		* @param object $objpictureAnimalAdd
		* @return bool L'insertion s'est bien passé ou pas
		*/		
		public function animalPictureCarousselAdd(object $objpictureAnimalAdd):bool{
			try {	
				$strAnimalAdd 	= "INSERT INTO `picture`(`pic_picture`, `pic_animal_id`)
									VALUES  (:pic_picture, :pic_animal_id);"; 
				$prep	= $this->_db->prepare($strAnimalAdd);  //:date_crea , :date_connect	
				$prep->bindValue(":pic_picture", $objpictureAnimalAdd->getPic_picture(), PDO::PARAM_STR);		

				$prep->bindValue(":pic_animal_id", $objpictureAnimalAdd->getId(), PDO::PARAM_STR);

				$prep->execute();
				//var_dump($prep->debugDumpParams());
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}
				
		/**
		* Suppression d'une image de caroussel
		* @param object $objPicture
		* @return array Tableau des image de caroussel
		*/
		public function pictureCarousselDel(object $objPicture):bool{
            try{
                $strpictureCarousselDel   = "DELETE FROM `picture`
                                   WHERE pic_id= :id;"; 
                                
                               
                $prep = $this->_db->prepare($strpictureCarousselDel);
               
                $prep->bindValue(":id",$objPicture->getPic_id() ,PDO::PARAM_INT);
                $prep->execute();

                // var_dump($prep->debugDumpParams()); die;

            }catch (PDOException $e){  
                return false;
            }
            return true;
		}
			
		/**
		* Suppression d'un animal
		* @param object $objAnimal
		* @return array Tableau des Animaux de la bdd
		*/
		public function animalDel(object $objAnimal):bool{
            try{
                $stranimalDel   = "DELETE FROM `animal`
                                   WHERE animal_id= :id;"; 
                                
                               
                $prep = $this->_db->prepare($stranimalDel);
               
                $prep->bindValue(":id",$objAnimal->getId() ,PDO::PARAM_INT);
                $prep->execute();
            }catch (PDOException $e){  
                return false;
            }
            return true;
		}

		/**
		* Récupération de tous les animaux
		* @param int $intNbLimit Nombre de résultats à afficher - si tous = 0
		* @return array Tableau des Animaux de la bdd
		*/
		public function findAll(int $intNbLimit=0):array{

        $strQueryCard	= "SELECT spec_name, breed_name,breed_characteristics, breed_size, animal.*, refuge_name, cat_name, cat_id
					FROM animal
					INNER JOIN refuge ON refuge_id = animal_refuge_id
					INNER JOIN animal_breed ON breed_id = animal_breed_id
					INNER JOIN animal_species ON breed_spec_id = spec_id
					INNER JOIN animal_category ON spec_cat_id = cat_id";

			
			// Définition du mot clé de condition
			$strWhere		= " WHERE ";

			// Recherche par mots clés
			if ($this->strKeywords != ""){
				$strQueryCard	.= $strWhere." (animal_name LIKE '%".$this->strKeywords."%' 
									OR animal_description LIKE '%".$this->strKeywords."%' 
                                    OR breed_name LIKE '%".$this->strKeywords."%'
                                    OR breed_characteristics LIKE '%".$this->strKeywords."%' 
									OR spec_name LIKE '%".$this->strKeywords."%'
									OR refuge_name LIKE '%".$this->strKeywords."%') ";
				$strWhere	= " AND "; // un seul where possible => And
			}

			//recherche par Categorie avec le $_GET
			if ($this->intCategoryId != 0){
				$strQueryCard	.= $strWhere."(cat_id LIKE '%".$this->intCategoryId."%')";
				$strWhere	= " AND ";
			
			}
			// Recherche par race
			if ($this->strRaces != 0){
				$strQueryCard	.= $strWhere." (breed_name LIKE '%".$this->strRaces."%')";
				$strWhere	= " AND ";
			}
					
		
			// Recherche par especes
			if ($this->strSpec != 0){
				$strQueryCard	.= $strWhere." (spec_name LIKE '%".$this->strSpec."%')";
				
				$strWhere	= " AND ";
			
			}

			//Recherche par taille
			if ($this->strtSize != "" ){
				$strQueryCard	.= $strWhere." (breed_size ='".$this->strtSize."')";
				$strWhere	= " AND "; // un seul where possible => And
			}	
			
			//Recherche par sexe
			if ($this->strSexe != "" ){
				$strQueryCard	.= $strWhere." (animal_sexe = '".$this->strSexe."')";
				$strWhere	= " AND "; // un seul where possible => And
			}
			
			// Recherche par refuge
			if ($this->strRef != 0){
				$strQueryCard	.= $strWhere." (refuge_name LIKE '%".$this->strRef."%')";
				$strQueryCard    .= "GROUP BY animal_id";
				$strWhere	= " AND ";
			}else{
				$strQueryCard	.= "";
				$strWhere	= " AND ";
				
			}

			// Classé par date DESC AND animal_status = 'D'
			$strQueryCard		.= " 
									ORDER BY animal_date_crea DESC";
			

					// Limite d'affichage
			if ($intNbLimit > 0){
				$strQueryCard	.= " LIMIT ".$intNbLimit." OFFSET 0;";
			}

			//var_dump($strQuery);
			$arrAnimals	= $this->_db->query($strQueryCard)->fetchAll();
			
			return $arrAnimals;
			
		}

		/**
		* Récupération du nombre de photos par evenement
		* @param int $intcountId nombre de photos par evenement
		* @return array Tableau du nombre de photos par evenement
		*/						
		public function CountPicture($intcountId){
		$strQueryCount = "SELECT COUNT('pic_id') as count_pic_id
							FROM picture
							WHERE pic_animal_id = :id";


			$prep = $this->_db->prepare($strQueryCount);
			$prep->bindValue(":id",$intcountId ,PDO::PARAM_INT);
				// Exécution de la requête
			$prep->execute();
				// Récuperer le résultat
			$arrPictureCount =$prep-> fetch(); 
			return  $arrPictureCount;		 
			}
			
		/**
		* Récupération du nom des refuges par id de l'animal
		* @return array Tableau du nom des refuges par id de l'animal
		*/	
		public function findRefuge():array{
			$strQueryCard = "SELECT refuge_name, animal_id
							FROM animal
							INNER JOIN refuge ON animal.animal_refuge_id = refuge.refuge_id
							GROUP BY refuge_name";

			$arrPictureCount = $this->_db->query($strQueryCard)->fetchAll();

			return $arrPictureCount;
		}

		/**
		* Récupération du nom de l'espèce de l'animal
		* @return array $arrSpecie Tableau du nom de l'espèce de l'animal
		*/	
		public function findSpecie():array{
			$strQueryCard = "SELECT spec_name
							FROM animal_species";

			$arrSpecie = $this->_db->query($strQueryCard)->fetchAll();

			return $arrSpecie;
		}

		/**
		* Récupération du nom de la categorie par id de la categorie
		* @return array $arrCategorie Tableau du nom de la categorie par id de la categorie
		*/	
		public function findCategory():array{
			$strQueryCard = "SELECT cat_name, cat_id
							FROM animal_category";

			$arrCategorie = $this->_db->query($strQueryCard)->fetchAll();

			return $arrCategorie;
		}

		/**
		* Récupération du nom de la race par id de la race
		* @return array $arrBreed Tableau du nom de la race par id de la race
		*/	
		public function findBreed():array{

			$strQueryCard = "SELECT breed_name, breed_id

							FROM animal_breed";

			$arrBreed = $this->_db->query($strQueryCard)->fetchAll();

			return $arrBreed;
		}

		/**
		* Récupération du nom des images pour le caroussel par l'id des images
		* @param int $intAnimalId l'id des images du caroussel
		* @return array $arrPicture Tableau du nom des images pour le caroussel par l'id des images
		*/	
		public function findPicture( int $intAnimalId):array{
			$strQueryCard = "SELECT pic_picture as animal_pic_picture,  pic_id as animal_pic_id, pic_animal_id as animal_id
							FROM picture
							INNER JOIN animal ON pic_animal_id = animal_id
							WHERE pic_animal_id = :id";

			
			$prep = $this->_db->prepare($strQueryCard);
			$prep->bindValue(":id",$intAnimalId ,PDO::PARAM_INT);
			// Exécution de la requête
			$prep->execute();
			// Récuperer le résultat
			$arrPicture =$prep-> fetchAll(); 
			return  $arrPicture;		 
			}
			
		/**
		* Récupération du nom, de l'id, du status, de la date de création, du nom de refuge des animaux pour la liste animal admin
		* @return array $arrFindAnimalAdmin Tableau du nom, de l'id, du status, de la date de création, du nom de refuge des animaux pour la liste animal admin
		*/	
		public function findAnimalAdmin():array{
			$strQueryCard = "SELECT animal_id, animal_name, animal_status, animal_date_crea, refuge_name
							FROM animal
							INNER JOIN refuge ON animal_refuge_id = refuge_id
							ORDER BY animal_date_crea DESC;";
			$arrFindAnimalAdmin = $this->_db->query($strQueryCard)->fetchAll();
			return $arrFindAnimalAdmin;
		}

		/**
		* Modification des info des animaux
		* @return object  des animaux de la bdd
		*/
		public function animalUpd(object $objAnimal):bool{
			try{
				$stranimalUpd	= "UPDATE  `animal` 
								SET animal_name = :name,
									animal_description = :description,
									animal_sexe = :sexe, 
									animal_picture = :picture, 
									animal_compatibility_animals = :compatibility_animals,
									animal_compatibility_children =  :compatibility_children,
									animal_date_birth = :date_birth,
									animal_status = :status,
									animal_breed_id = :breed_id,
									animal_refuge_id = :refuge_id
									WHERE animal_id= :id;";
								
				$prep = $this->_db->prepare($stranimalUpd);
				$prep->bindValue(":name", $objAnimal->getName(), PDO::PARAM_STR);
				$prep->bindValue(":description", $objAnimal->getDescription(), PDO::PARAM_STR);
				$prep->bindValue(":sexe", $objAnimal->getSexe(), PDO::PARAM_STR);
				$prep->bindValue(":picture", $objAnimal->getPicture(), PDO::PARAM_STR);
				$prep->bindValue(":compatibility_animals", $objAnimal->getCompatibility_animals(), PDO::PARAM_STR);
				$prep->bindValue(":compatibility_children", $objAnimal->getCompatibility_children(), PDO::PARAM_STR);
				$prep->bindValue(":date_birth", $objAnimal->getDate_birth(), PDO::PARAM_STR);
				$prep->bindValue(":refuge_id", $objAnimal->getRefuge_id(), PDO::PARAM_INT);
				$prep->bindValue(":breed_id", $objAnimal->getBreed_id(), PDO::PARAM_INT);
				$prep->bindValue(":status", $objAnimal->getStatus(), PDO::PARAM_STR);
				$prep->bindValue(":id",$objAnimal->getId() ,PDO::PARAM_INT);
				$prep->execute();
				// var_dump($prep->debugDumpParams()); die;
			}catch (PDOException $e){	
				return false;
			}
			return true;
		}

		/**
		* Récupération des données de l'animal par l'id
		* @param int $intAnimalId id de l'animal
		* @return array $arrAnimal Tableau des données de l'animal par l'id
		*/	
		public function findAnimalOneAdmin(int $intAnimalId):array{
			$strQueryCard = "SELECT animal_id, animal_name, animal_status, animal_date_crea, refuge_name, animal_description, animal_sexe, animal_refuge_id, animal_breed_id, animal_compatibility_animals, animal_compatibility_children, animal_date_birth, animal_breed_id, animal_picture
							FROM animal
							INNER JOIN refuge ON animal_refuge_id = refuge_id
							WHERE animal_id = :id;";
                // Préparation de la requête
            $prep = $this->_db->prepare($strQueryCard);
            $prep->bindValue(":id",$intAnimalId ,PDO::PARAM_INT);
                // Exécution de la requête
            $prep->execute();
                // Récuperer le résultat
            $arrAnimal =$prep-> fetch();
        return  $arrAnimal ;        
        }

	}