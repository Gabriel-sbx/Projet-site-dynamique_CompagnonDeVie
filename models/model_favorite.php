<?php
	/**
	* Classe de gestion de la base de données pour les favoris
	* @author Soubeyroux Gabriel
	* @version 1.0
	* @date 29/01/2025
	*/
	require_once("model_mother.php");
	class FavoriteModel extends MotherModel{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
/********************************************************* Affichage favoris*******************************************************************/

			/**
			* Fonction permettant de recupere tout les favoris d'un utilisateur pour rendre activ le coeur rouge 
			* @param int $userId identifiant de l'utilisateur
			* @return array $userFavorite Si trouvé ou non 
            */

		public function favoriteUserStyleActive(int $userId): array {
			$strUserFavoriteStyle = "SELECT fav_animal_id FROM favorite WHERE fav_user_id = '".$userId."'";
			$userFavorite = $this->_db->query($strUserFavoriteStyle)->fetchAll();
			return $userFavorite;
		}




			/**
			* Fonction permettant de compter le nombre de favoris par utilisateur  en bdd
			* @param int $intUserId identifiant de l'utilisateur
			* @return array Si trouvé ou non 
            */

        public function countFavorite(int $intUserId):array{
            $strCountFavorite = "SELECT COUNT(DISTINCT fav_id) as count_favorite
                                    FROM favorite 
                                    WHERE fav_user_id = :id;";
            	// Préparation de la requête
			$prep = $this->_db->prepare($strCountFavorite);
			$prep->bindValue(":id",$intUserId ,PDO::PARAM_INT);
				// Exécution de la requête
			$prep->execute();
				// Récuperer le résultat
			$arrFavorite =$prep-> fetch(); 
		    return  $arrFavorite;		 
		    }
		/**
		* Fonction permettant d'afficher les favoris par utilisateur en affichant la carte en bdd
		* @param int $intUserId identifiant de l'utilisateur
		* @return array Si trouvé ou non 
		*/
		public function favoriteReadAll(int $intUserId):array{
			$strFavoriteReadAll ="SELECT spec_name, breed_name, breed_characteristics, breed_size, animal.*, refuge_name, cat_name, fav_id , fav_date_crea 
									FROM favorite
									INNER JOIN animal ON fav_animal_id = animal_id
									INNER JOIN refuge ON refuge_id = animal_refuge_id
									INNER JOIN animal_breed ON breed_id = animal_breed_id
									INNER JOIN animal_species ON breed_spec_id = spec_id
									INNER JOIN animal_category ON spec_cat_id = cat_id
									INNER JOIN user ON fav_user_id = user_id
										WHERE user_id = :id ;";
					// Préparation de la requête
				$prep = $this->_db->prepare($strFavoriteReadAll);
				$prep->bindValue(":id",$intUserId ,PDO::PARAM_INT);
					// Exécution de la requête
				$prep->execute();
				$arrFavorite =$prep-> fetchAll(); 
				return  $arrFavorite;	

        }
		/**
		* Verification si le favoris a deja etait ajoutez ou non
		* @param int $userId  identifiant de l'utilisateur
		* @param int $animalId  identifiant de l'animal

		* @return array trouvé ou non
		*/
		public function favoriteVerifExist(int $userId, int $animalId): array {
			$strFavoriteVerif = "SELECT fav_id 
								 FROM favorite 
								 WHERE fav_user_id = '".$userId."' 
								 AND fav_animal_id = '".$animalId."'";
		
			$arrFavorite = $this->_db->query($strFavoriteVerif)->fetch();

			return $arrFavorite;
		
		}
/********************************************************* Ajout Favoris*******************************************************************/
		/**
		* Insertion en BDD d'un nouveau favoris
		* @param object $objFavorite du favoris de la bdd
		* @return bool L'insertion s'est bien passé ou pas
		*/
		public function favoriteAdd(object $objFavorite):bool{
			try {	
				$strFavoriteAdd 	= "	INSERT INTO `favorite` (`fav_date_crea`, `fav_user_id`, `fav_animal_id`) 
											VALUES (NOW(), :fav_user_id, :fav_animal_id);";  
					$prep		= $this->_db->prepare($strFavoriteAdd);
					$prep->bindValue(":fav_user_id", $objFavorite->getUser_id(), PDO::PARAM_INT);
					$prep->bindValue(":fav_animal_id", $objFavorite->getAnimal_id(), PDO::PARAM_INT);
					$prep->execute();
 
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}

/**************************************************************** Suppression Favoris**************************************************************/
		/**
		* Suppresion en BDD  du favoris
		* @param object $objFavorite  du favoriss 
		* @return bool La suppression s'est bien passé ou pas
		*/
		public function testifyDel(object $objFavorite):bool{
			try {	
				
				$strFavoriteDel	= "DELETE FROM favorite 
									WHERE `favorite`.`fav_id` = :id ;";
				$prep = $this->_db->prepare($strFavoriteDel);
				$prep->bindValue(":id",$objFavorite->getId() ,PDO::PARAM_INT);
				$prep->execute();
			}catch(PDOException $e) { 
				return false;				
			} 
			return true;
		}


		
	}



		
