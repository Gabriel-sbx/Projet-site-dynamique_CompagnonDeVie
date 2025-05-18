<?php
	/**
	* Classe de gestion de la base de données pour les témoignages
	* @author Soubeyroux Gabriel
	* @version 1.0
	* @date 29/01/2025
	*/
	require_once("model_mother.php");
	class TestifyModel extends MotherModel{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
/********************************************************* Affichage témoignages*******************************************************************/
		/**
		* Fonction permettant de compter le nombre de temoignages par utilisateur  en bdd
		* @param int $intUserId identifiant de l'utilisateur
		* @return array Si trouvé ou non 
		*/
        public function countTestify(int $intUserId):array{
            $strCountTestify = "SELECT COUNT(DISTINCT test_id) as count_testify
                                    FROM testify
                                    WHERE test_user_id = :id
									AND test_status = 'V';";
            	// Préparation de la requête
			$prep = $this->_db->prepare($strCountTestify);
			$prep->bindValue(":id",$intUserId ,PDO::PARAM_INT);
				// Exécution de la requête
			$prep->execute();
				// Récuperer le résultat
			$arrTestify =$prep-> fetch(); 
		    return  $arrTestify;		 
		}
		/**
		* Fonction permettant de compter le nombre de temoignages  en bdd
		* @return array Si trouvé ou non 
		*/
		public function countTestifyValidating():array{
			$strCountTestify = "SELECT COUNT(DISTINCT test_id) as count_testify
                                    FROM testify
                                    WHERE test_status = 'ECV';";
				// Préparation de la requête
			$arrTestify = $this->_db->query($strCountTestify)-> fetch(); 
				// Exécution de la requête
		
			return  $arrTestify;		 
		}	
		/**
		* Récupération de tous les témoignages status valider et ajout de la notion de date pour passage automatiquement a la page archives
		* @param int $intNbLimit Nombre de résultats à afficher - si tous = 0
		* @return array Tableau des des temoignages de la bdd
		*/
		public function readTestify(int $intNbLimit=0):array{
			$strTestReadAll = "SELECT testify.*, user_pseudo AS test_user_pseudo FROM `testify`
									INNER JOIN user ON test_user_id = user_id
										WHERE test_status = 'V'
										AND test_date_crea > DATE_SUB(NOW(), INTERVAL 20 DAY)
										ORDER BY test_date_crea DESC;";
			$arrTestify = $this->_db->query($strTestReadAll)->fetchAll();		
		    return  $arrTestify;
		}
		/**
		* Récupération de tous les témoignages status en cours de validation
		* @param int $intNbLimit Nombre de résultats à afficher - si tous = 0
		* @return array Tableau des des temoignages de la bdd
		*/
		public function readTestifyValidating(int $intNbLimit=0):array{
			$strTestReadAll = "SELECT testify.*, user_pseudo AS test_user_pseudo FROM `testify`
									INNER JOIN user ON test_user_id = user_id
										WHERE test_status = 'ECV'
										ORDER BY test_date_crea DESC;";
			$arrTestify = $this->_db->query($strTestReadAll)->fetchAll();		
		    return  $arrTestify;
		}
		/**
		* Récupération de tous les témoignages status non validées archive et recupération de la notion de date pour les 
		* témoignages valider dépassant la date passage automatiquement a la page archives
		* @param int $intNbLimit Nombre de résultats à afficher - si tous = 0
		* @return array Tableau des des temoignages de la bdd
		*/
		public function readTestifyArchives(int $intNbLimit=0):array{
			$strTestReadAll = "SELECT testify.*, user_pseudo AS test_user_pseudo FROM `testify`
									INNER JOIN user ON test_user_id = user_id
										WHERE test_status = 'NV'
										OR ( test_status = 'V' 
										AND test_date_crea <= DATE_SUB(NOW(), INTERVAL 20 DAY))
										ORDER BY test_date_crea DESC;";
			$arrTestify = $this->_db->query($strTestReadAll)->fetchAll();		
		    return  $arrTestify;
		}

		/**
		* Récupération de tous les témoignages pour un utilisateur qui sont valider
		* @param int $intUserId Nombre de résultats à afficher - si tous = 0
		* @return array Tableau des des temoignages de la bdd
		*/
		public function readTestifyOneUser(int $intUserId):array{
			$strTestReadOneUser = "SELECT testify.*, user_pseudo AS test_user_pseudo FROM `testify`
									INNER JOIN user ON test_user_id = user_id
										WHERE test_status = 'V'
										AND test_user_id = :id;";

					$prep = $this->_db->prepare($strTestReadOneUser);
					$prep->bindValue(":id",$intUserId ,PDO::PARAM_INT);
						// Exécution de la requête
					$prep->execute();
						// Récuperer le résultat
					$arrTestify =$prep-> fetchAll(); 
					return  $arrTestify;	
		}
		/**
		* Récupération du témoignages pour un utilisateur pour la modification
		* @param int $intTestId identifiant du témoignage
		* @return array Tableau des des temoignages de la bdd
		*/
		public function readTestifyOne(int $intTestId):array{
			$strTestReadOneEdit = "SELECT test_id, test_title, test_description, test_picture, test_user_id  FROM `testify`
										WHERE test_id = :id;"; 

					$prep = $this->_db->prepare($strTestReadOneEdit);
					$prep->bindValue(":id",$intTestId ,PDO::PARAM_INT);
						// Exécution de la requête
					$prep->execute();
						// Récuperer le résultat
					$arrTestify =$prep-> fetch(); 
					return  $arrTestify;	
		}
/********************************************************* Ajout témoignages*******************************************************************/
		/**
		* Insertion en BDD d'un nouveau témoignages
		* @param object $objTestify du témoignages de la bdd
		* @return bool L'insertion s'est bien passé ou pas
		*/
		public function testifyAdd(object $objTestify):bool{
			try {	
				$strTestifyAdd 	= "INSERT INTO `testify`(test_title, test_description, test_picture, test_status, test_date_crea, test_user_id)
								VALUES  (:title, :description, :picture, 'ECV', NOW(), :test_user_id);";  
					$prep		= $this->_db->prepare($strTestifyAdd);
					$prep->bindValue(":title", $objTestify->getTitle(), PDO::PARAM_STR);
					$prep->bindValue(":description", $objTestify->getDescription(), PDO::PARAM_STR);
					$prep->bindValue(":picture", $objTestify->getPicture(), PDO::PARAM_STR);
					$prep->bindValue(":test_user_id", $objTestify->getId(), PDO::PARAM_INT);
				$prep->execute();
 
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}
/********************************************************* Modification témoignages*******************************************************************/
		/**
		* Modification en BDD d'un nouveau témoignages
		* @param object $objTestify du témoignages 
		* @return bool L'Modification s'est bien passé ou pas
		*/
		public function testifyUpd(object $objTestify):bool{
			try{
				$strTestifyUpd	= "UPDATE  `testify` 
									SET test_title = :title,
										test_description = :description,
										test_picture = :picture,
										test_status = :status
										WHERE test_id= :id;";
					$prep = $this->_db->prepare($strTestifyUpd);
					$prep->bindValue(":title", $objTestify->getTitle(), PDO::PARAM_STR);
					$prep->bindValue(":description", $objTestify->getDescription(), PDO::PARAM_STR);
					$prep->bindValue(":picture", $objTestify->getPicture(), PDO::PARAM_STR);
					$prep->bindValue(":status", $objTestify->getStatus(), PDO::PARAM_STR);
					$prep->bindValue(":id", $objTestify->getId(), PDO::PARAM_INT);
					$prep->execute();
					
			}catch (PDOException $e){	
						return false;
				}
				return true;
					
		}
		/**
		* Modification en BDD d'un status de témoignages 
		* @param object $objTestify du témoignages 
		* @return bool L'Modification s'est bien passé ou pas
		*/
		public function testifyValidateUpd(object $objTestify):bool{
			try{
				$strTestifyUpd	= "UPDATE  `testify` 
									SET test_status = 'V'
										WHERE test_id= :id;";
					$prep		= $this->_db->prepare($strTestifyUpd);
					
					$prep->bindValue(":id", $objTestify->getId(), PDO::PARAM_INT);

					$prep->execute();
			}catch (PDOException $e){	
						return false;
				}
				return true;
					
		}
		/**
			* Modification en BDD d'un status de témoignages 
			* @param object $objTestify du témoignages 
			* @return bool L'Modification s'est bien passé ou pas
		*/
		public function testifyNoValidateUpd(object $objTestify):bool{
			try{
				$strTestifyUpd	= "UPDATE`testify` 
									SET test_status = 'NV'
										WHERE test_id= :id;";
					$prep		= $this->_db->prepare($strTestifyUpd);
					
					$prep->bindValue(":id", $objTestify->getId(), PDO::PARAM_INT);

					$prep->execute();
			}catch (PDOException $e){	
						return false;
				}
				return true;
					
		}
/**************************************************************** Suppression témoignages**************************************************************/
		/**
		* Suppresion en BDD d'un témoignages
		* @param object $objTestify du témoignages 
		* @return bool La suppression s'est bien passé ou pas
		*/
		public function testifyDel(object $objTestify):bool{
			try {	
				
				$strTestifyDel	= "DELETE FROM testify 
								WHERE test_id= :id;";
				$prep = $this->_db->prepare($strTestifyDel);
				$prep->bindValue(":id",$objTestify->getId() ,PDO::PARAM_INT);
				$prep->execute();
				var_dump($prep);
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}
}
	