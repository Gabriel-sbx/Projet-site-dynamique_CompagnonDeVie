<?php
	/**
	* Classe de gestion de la base de données pour les adoptions
	* @author Soubeyroux Gabriel
	* @version 1.0
	* @date 29/01/2025
	*/
	require_once("model_mother.php");
	class AdoptModel extends MotherModel{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}

 
 		/** 
		* Fonction permettant de compter le nombre d'adoptions par utilisateur  en bdd
		* @param int $intUserId identifiant de l'utilisateur
		* @return array Si trouvé ou non 
		*/
        public function countAdopt(int $intUserId):array{
            $strCountAdopt = "SELECT COUNT(DISTINCT adopt_id) as count_adopt
                                    FROM adopt
                                    WHERE adopt_user_id = :id
									AND adopt_status = 'ECV';";
            	// Préparation de la requête
			$prep = $this->_db->prepare($strCountAdopt);
			$prep->bindValue(":id",$intUserId ,PDO::PARAM_INT);
				// Exécution de la requête
			$prep->execute();
				// Récuperer le résultat
			$arrAdopt =$prep-> fetch(); 
		    return  $arrAdopt;		 
		}

		
		/**
		* Fonction permettant de compter le nombre d'adoptions  en bdd
		* 
		* @return array $arrAdopt Si trouvé ou non 
		*/
		public function countAdoptValidating():array{
			$strCountAdopt = "SELECT COUNT(DISTINCT adopt_id) as count_adopt
                                    FROM adopt
									WHERE adopt_status = 'ECV';";
				// Préparation de la requête
			$arrAdopt = $this->_db->query($strCountAdopt)-> fetch(); 
				// Exécution de la requête
		
			return  $arrAdopt;		 
			}	
		/**
		* Récupération de tous les adoption pour un utilisateur qui sont en cours de validation (espace membre)
		* @param int $intUserId identifiant de l'utilisateur
		* @return array Tableau des des adoption de la bdd
		*/
		public function readAdoptProgress(int $intUserId):array{
			$strAdoptReadAll = "SELECT adopt.*, user_pseudo AS adopt_user_pseudo, animal_name AS adopt_animal_name FROM `adopt`
									INNER JOIN user ON adopt_user_id = user_id
									INNER JOIN animal ON adopt_animal_id = animal_id 
									WHERE adopt_user_id = :id
										AND adopt_status = 'ECV';";
			$prep = $this->_db->prepare($strAdoptReadAll);
			$prep->bindValue(":id",$intUserId ,PDO::PARAM_INT);
				// Exécution de la requête
			$prep->execute();
				// Récuperer le résultat
			$arrAdoptProgress =$prep-> fetchAll(); 
		    return  $arrAdoptProgress;	
		}
		/**
		* Récupération de tous les adoption  qui sont en cours de validation (espace admin)
		* @return array Tableau des des adoption de la bdd
		*/
		public function readAdoptProgressAll ():array{
			$strAdoptReadAll = "SELECT adopt.*, user_pseudo AS adopt_user_pseudo, animal_name AS adopt_animal_name FROM `adopt`
									INNER JOIN user ON adopt_user_id = user_id
									INNER JOIN animal ON adopt_animal_id = animal_id 
										AND adopt_status = 'ECV';";
			$arrAdoptProgress = $this->_db->query($strAdoptReadAll)-> fetchAll();
			 
		    return  $arrAdoptProgress;	
		}
		/**
		* Récupération de tous les adoption pour un utilisateur qui sont en cours de validation (espace membre)
		* @param int $intUserId identifiant de l'utilisateur
		* @return array Tableau des des adoption de la bdd
		*/
		public function readAdoptAccept(int $intUserId):array{
			$strAdoptReadAll = "SELECT adopt.*, user_pseudo AS adopt_user_pseudo, animal_name AS adopt_animal_name FROM `adopt`
									INNER JOIN user ON adopt_user_id = user_id
									INNER JOIN animal ON adopt_animal_id = animal_id 
									WHERE adopt_user_id = :id
										AND adopt_status = 'V';";
			$prep = $this->_db->prepare($strAdoptReadAll);
			$prep->bindValue(":id",$intUserId ,PDO::PARAM_INT);
				// Exécution de la requête
			$prep->execute();
				// Récuperer le résultat
			$arrAdoptAccept =$prep-> fetchAll(); 
		    return  $arrAdoptAccept;	
		}
		/**
		* Récupération de tous les adoption pour tout les utilisateurs  qui sont en cours de validation (espace membre)
		
		* @return array Tableau des des adoption de la bdd
		*/
		public function readAdoptAcceptAll():array{
			$strAdoptReadAll = "SELECT adopt.*,animal_id AS adopt_animal_id, user_pseudo AS adopt_user_pseudo, animal_name AS adopt_animal_name FROM `adopt`
									INNER JOIN user ON adopt_user_id = user_id
									INNER JOIN animal ON adopt_animal_id = animal_id 
									WHERE adopt_status = 'V';";
			$arrAdoptAccept = $this->_db->query($strAdoptReadAll)-> fetchAll();
				// Exécution de la requête
				// Récuperer le résultat
		    return  $arrAdoptAccept;	
		}
		/**
		* Récupération de tous les adoption pour un utilisateur qui ont etait refuser (espace membre)
		* @param int $intUserId identifiant de l'utilisateur
		* @return array Tableau des des adoption de la bdd
		*/
		public function readAdoptRefuse(int $intUserId):array{
			$strAdoptReadAll = "SELECT adopt.*, user_pseudo AS adopt_user_pseudo, animal_name AS adopt_animal_name FROM `adopt`
									INNER JOIN user ON adopt_user_id = user_id
									INNER JOIN animal ON adopt_animal_id = animal_id 
									WHERE adopt_user_id = :id
										AND adopt_status = 'NV';";
			$prep = $this->_db->prepare($strAdoptReadAll);
			$prep->bindValue(":id",$intUserId ,PDO::PARAM_INT);
				// Exécution de la requête
			$prep->execute();
				// Récuperer le résultat
			$arrAdoptRefuse =$prep-> fetchAll(); 
		    return  $arrAdoptRefuse;	
		}
		/**
		* Récupération de tous les adoption  qui ont etait refuser (espace admin)
		* @return array Tableau des des adoption de la bdd
		*/
		public function readAdoptRefuseAll():array{
			$strAdoptReadAll = "SELECT adopt.*, user_pseudo AS adopt_user_pseudo, animal_name AS adopt_animal_name FROM `adopt`
									INNER JOIN user ON adopt_user_id = user_id
									INNER JOIN animal ON adopt_animal_id = animal_id 
										AND adopt_status = 'NV';";
			$arrAdoptRefuse = $this->_db->query($strAdoptReadAll)-> fetchAll();
			 
		    return  $arrAdoptRefuse;	
		}
    }

		