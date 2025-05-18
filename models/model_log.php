<?php
	/**
	* Classe de gestion de la base de données pour les connexion
	* @author Soubeyroux Gabriel
	* @version 1.0
	* @date 10/02/2025
	**/
	require_once("model_mother.php");
	class logModel extends MotherModel{
		/**
		* Constructeur de la classe
		**/
		public function __construct(){
			parent::__construct();
		}
/******************************************** Ajout log**************************************************************************/
		/**
		* Insertion en BDD d'une nouvelle connexion
		* @param int $userId
		* @return bool L'insertion s'est bien passé ou pas
		**/
		public function logAdd(int $userId):bool{
			try {	
				$strLogAdd 	= "INSERT INTO `user_log` ( `log_date_crea`, `log_user_id`) VALUES (  NOW(), :log_user_id);";  
					$prep		= $this->_db->prepare($strLogAdd);
					$prep->bindValue(":log_user_id", $userId, PDO::PARAM_INT);
					$prep->execute();
						//var_dump($prep->debugDumpParams());
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}
   
	
		/**
		* Récupération de toute les connexions des utilisateurs 
		* @return array Tableau des utilisateurs de la bdd
		*/
		public function logUserAll():array{
			$strLogReadAll = "SELECT user_log.*, user_pseudo AS log_user_pseudo FROM `user_log`
									INNER JOIN user ON log_user_id = user_id
										WHERE user_type = 'UC'
										AND log_date_crea > DATE_SUB(NOW(), INTERVAL 7 DAY)
										ORDER BY log_date_crea DESC;";
			$arrLog=$this->_db->query($strLogReadAll)->fetchAll(); 
			return $arrLog;
		}
		/**
		* Récupération toute les connexions des moderateurs 
		* @return array  des moderateurs de la bdd
		*/
		public function logModoAll():array{
			$strLogReadAll = "SELECT user_log.*, user_pseudo AS log_user_pseudo FROM `user_log`
									INNER JOIN user ON log_user_id = user_id
										WHERE user_type = 'MOD'
										AND log_date_crea > DATE_SUB(NOW(), INTERVAL 7 DAY)
										ORDER BY log_date_crea DESC;";
			return $this->_db->query($strLogReadAll)->fetchAll(); 
		}
		/**
		* Récupération toute les connexions des administrateurs 
		* @return array Tableau administrateurs de la bdd

		*/
		public function logAdminAll():array{
			$strLogReadAll = "SELECT user_log.*, user_pseudo AS log_user_pseudo FROM `user_log`
									INNER JOIN user ON log_user_id = user_id
										WHERE user_type = 'ADM'
										AND log_date_crea > DATE_SUB(NOW(), INTERVAL 7 DAY)
										ORDER BY log_date_crea DESC;";
			return $this->_db->query($strLogReadAll)->fetchAll(); 
		}
		/**
		* Récupération toute les connexions d'un utilisateurs 
		* @param $intUserId identifiant de l'utilisateurs
		* @return array Tableau des administrateurs de la bdd
		*/
		public function logDetailsAll($intUserId):array{
			$strLogDetailsReadAll = "SELECT user_log.*, user_pseudo AS log_user_pseudo FROM `user_log`
									INNER JOIN user ON log_user_id = user_id
										WHERE log_user_id = :id 
										ORDER BY log_date_crea DESC;";
			$prep = $this->_db->prepare($strLogDetailsReadAll);
			$prep->bindValue(":id",$intUserId ,PDO::PARAM_INT);
			$prep->execute();
			$arrLog =$prep-> fetchAll(); 
			return  $arrLog;	
		}
	}



