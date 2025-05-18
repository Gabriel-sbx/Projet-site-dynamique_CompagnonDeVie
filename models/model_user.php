<?php
	/**
	* Classe de gestion de la base de données pour les utilisateurs
	* @author Soubeyroux Gabriel
	* @version 1.0
	* @date 19/01/2025-15/02/2025
	*/
	/* var_dump utile :
	* 1) Pour debogger une requete :
	* 	- var_dump($prep->debugDumpParams()); die;
	*/
	require_once("model_mother.php");
	class UserModel extends MotherModel{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
/********************************************************* Ajout d'un utilisateur*******************************************************************/
		/**
			* Fonction permettant de vérifier la présence d'une adresse email en bdd au moment de l'ajout ou de la modification
			* @param string $strEmail Adresse mail à Vérifier
			* @param int $intId Identifiant de l'utilisateur pour ne pas vérifier son adresse mail 
			* @return bool Si trouvé ou non
		*/
		public function userVerifEmail(string $strEmail, int $intId):bool{
			$strUserVerifEmail	= "SELECT user_email
								FROM user
								WHERE user_email = '".$strEmail."'
								AND user_id !='".$intId."'";

			$arrUserEmail 		= $this->_db->query($strUserVerifEmail)->fetch();
			return is_array($arrUserEmail);
		}

		/**
			* Fonction permettant de vérifier la présence d'un pseudo en bdd  au moment de l'ajout ou de la modification
			* @param string $strPseudo Pseudo à Vérifier
			* @param int $intId Identifiant de l'utilisateur pour ne pas vérifier son pseudo 
			* @return bool Si trouvé ou non
		*/
		public function userVerifPseudo(string $strPseudo , int $intId):bool{
			$strUserVerifPseudo	= "SELECT user_pseudo
								FROM user
								WHERE user_pseudo = '".$strPseudo."'
								AND user_id !='".$intId."'";
			$arrUserPseudo 		= $this->_db->query($strUserVerifPseudo)->fetch();
			return is_array($arrUserPseudo);
		}

		/**
			* Insertion en BDD d'un nouvel utilisateur
			* @param object $objUser Utilisateur à ajouter
			* @return bool L'insertion s'est bien passé ou pas
		*/
		public function userAdd(object $objUser):bool{
			try {	
				$strUserAdd 	= "INSERT INTO `user`(user_name, user_surname, user_pseudo, user_email, user_password, user_type, user_date_crea)
									VALUES  (:name, :surname, :pseudo, :email, :password, 'UC', NOW());";  
				$prep		= $this->_db->prepare($strUserAdd);
				$prep->bindValue(":name", $objUser->getName(), PDO::PARAM_STR);
				$prep->bindValue(":surname", $objUser->getSurname(), PDO::PARAM_STR);
				$prep->bindValue(":pseudo", $objUser->getPseudo(), PDO::PARAM_STR);
				$prep->bindValue(":email", $objUser->getEmail(), PDO::PARAM_STR);
				$prep->bindValue(":password", $objUser->getPasswordHash(), PDO::PARAM_STR);
				$prep->execute();
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}

		/**
			* Insertion en BDD d'un nouvel utilisateur par un modérateur ou administrateur
			* @param object $objUser Utilisateur à ajouter
			* @return bool L'insertion s'est bien passé ou pas
		*/
		public function userAddAdmin(object $objUser):bool{
			try {	
				$strUserAdd 	= "INSERT INTO `user`(user_name, user_surname, user_pseudo, user_email, user_password, user_type, user_date_crea)
								VALUES  (:name, :surname, :pseudo, :email, :password, :type, NOW());";   	
				$prep		= $this->_db->prepare($strUserAdd);
				$prep->bindValue(":name", $objUser->getName(), PDO::PARAM_STR);
				$prep->bindValue(":surname", $objUser->getSurname(), PDO::PARAM_STR);
				$prep->bindValue(":pseudo", $objUser->getPseudo(), PDO::PARAM_STR);
				$prep->bindValue(":email", $objUser->getEmail(), PDO::PARAM_STR);
				$prep->bindValue(":password", $objUser->getPasswordHash(), PDO::PARAM_STR);
				$prep->bindValue(":type", $objUser->getType(), PDO::PARAM_STR);
				$prep->execute();
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}
/****************************************************************Suppression des utilisateurs**************************************************************/
		/**
			* Suppresion en BDD d'un utilisateur
			* @param object $objUser Utilisateur à supprimer
			* @return bool La suppression s'est bien passé ou pas
		*/
		public function userDel(object $objUser):bool{
			try {	
				
				$strUserDel	= "DELETE FROM user 
								WHERE user_id= :id;";
								var_dump($strUserDel); 
				$prep = $this->_db->prepare($strUserDel);
				$prep->bindValue(":id",$objUser->getId() ,PDO::PARAM_INT);
				$prep->execute();
			}catch(PDOException $e) { 
				return false;				
			} 
			return true;
			}
/**********************************************************************Modification utilisateurs************************************************************* */
		/**
		* Modification des info d'utilisateur
		* @param object  $objUser des champ a modifier de utilisateurs de la bdd
		* @return bool La modification s'est bien passé ou pas

		*/
		public function userUpd(object $objUser):bool{
			try {
				$strUserUpd	= "UPDATE `user` 
								SET user_name = :name,
									user_surname = :surname,
									user_pseudo = :pseudo, 
									user_email = :email,
									user_type = :type

								WHERE user_id = :id;";
				$prep = $this->_db->prepare($strUserUpd);
				$prep->bindValue(":name", $objUser->getName(), PDO::PARAM_STR);
				$prep->bindValue(":surname", $objUser->getSurname(), PDO::PARAM_STR);
				$prep->bindValue(":pseudo", $objUser->getPseudo(), PDO::PARAM_STR);
				$prep->bindValue(":email", $objUser->getEmail(), PDO::PARAM_STR);
				$prep->bindValue(":type", $objUser->getType(), PDO::PARAM_STR);

				$prep->bindValue(":id",$objUser->getId() ,PDO::PARAM_INT);
				$prep->execute();
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}

		/**
		* Modification du mot de passe séparemment pour plus de sécuriter
		* @param object $objUser de l'utilisateur de la bdd
		* @return bool La modification s'est bien passé ou pas

		*/
		public function userUpdPwd(object $objUser):bool{
			try {
				$strUserUpdPwd	= "UPDATE`user` 
								SET user_password = :password 
								WHERE user_id = :id;";
				
				$prep = $this->_db->prepare($strUserUpdPwd);
				$prep->bindValue(":password", $objUser->getPasswordHash(), PDO::PARAM_STR);
				$prep->bindValue(":id",$objUser->getId() ,PDO::PARAM_INT);
				$prep->execute();
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}


		
/****************************************************************Affichage  utilisateurs *********************************************************/

		/**
		* Fonction permettant de compter le nombre d'utilisateur  en bdd
		* @return array Si trouvé ou non 
		*/

		public function countUser():array{
		$strCountUser = "SELECT COUNT(DISTINCT user_id) as count_user 
							FROM user 
							WHERE user_type = 'UC';";	
		$arrUser = $this->_db->query($strCountUser)-> fetch(); 	
		return  $arrUser;		 
		}	

		/**
		* Récupération de tous les utilisateurs 
		* @return array Tableau des utilisateurs de la bdd
		*/
		public function userAll():array{
			$strUserReadAll = "SELECT user_id, user_name, user_surname, user_pseudo, user_email, user_type , user_date_crea
								
								FROM `user` 
								WHERE user_type = 'UC'
								ORDER BY user_date_crea DESC;";
			return $this->_db->query($strUserReadAll)->fetchAll(); 
		}
		/**
		* Récupération de tous les moderateurs 
		* @return array Tableau des moderateurs de la bdd
		*/
		public function modoAll():array{
			$strUserReadAll = "SELECT user_id, user_name, user_surname, user_pseudo, user_email, user_type , user_date_crea
								
								FROM `user` 
								WHERE user_type = 'MOD'
								ORDER BY user_date_crea DESC;";
			return $this->_db->query($strUserReadAll)->fetchAll(); 
		}
		/**
		* Récupération de tous les administrateurs 
		* @return array Tableau des administrateurs de la bdd
		*/
		public function adminAll():array{
			$strUserReadAll = "SELECT user_id, user_name, user_surname, user_pseudo, user_email, user_type , user_date_crea
								
								FROM `user` 
								WHERE user_type = 'ADM'
								ORDER BY user_date_crea DESC;";
			return $this->_db->query($strUserReadAll)->fetchAll(); 
		}
		/**
		* Récupération d'un seul utilisateurs (pageprofil)
		* @return array Tableau des utilisateurs de la bdd
		*/
		public function userOne(int $intUserId):array{
			$strUserReadOne = "SELECT user_id, user_name, user_surname, user_pseudo, user_email, user_type, user_date_crea,
								COUNT(DISTINCT particip_id) AS number_participate
								FROM `user`
								LEFT OUTER JOIN favorite ON user_id = fav_user_id
								LEFT OUTER JOIN adopt ON user_id = adopt_user_id
								LEFT OUTER JOIN participate ON user_id = particip_user_id
								LEFT OUTER JOIN testify ON user_id = test_user_id
								WHERE user_id = :id;";
				// Préparation de la requête
			$prep = $this->_db->prepare($strUserReadOne);
			$prep->bindValue(":id",$intUserId ,PDO::PARAM_INT);
				// Exécution de la requête
			$prep->execute();
				// Récuperer le résultat
			$arrUser =$prep-> fetch(); 
		return  $arrUser;		 
		}

/*********************************************************Connexion utilisateurs********************************************************************* */
		/**
		* Récupération d'un utilisateur pour connexion
		* @param string $strPassword Le mot de passe de l'utilisateur
		* @param string  $strEmail L'email de l'utilisateur
		* @return array Tableau de l'utilisateur de la base de données 
		* @return false si la connexion échoue
		*/
		public function findUserConnect(string $strEmail, string $strPassword):array|bool {

			$strUserConnect = "SELECT user_id, user_name , user_type , user_password, user_pseudo, log_user_id 
									FROM user 
									LEFT JOIN user_log ON log_user_id = user_id
									WHERE user_email = :email";

			// Préparation de la requête
			$prep = $this->_db->prepare($strUserConnect);
			// Lier le paramètre :email à la valeur de $strEmail
			$prep->bindValue(":email",$strEmail ,PDO::PARAM_STR);
			// Exécution de la requête
			$prep->execute();
			// Récuperer le résultat
			$arrUserConnect = $prep-> fetch();
			//  On vérifie le mot de passe a part pour eviter les injections
			if(($arrUserConnect !== false )
			&&(password_verify($strPassword, $arrUserConnect['user_password']))){
				unset($arrUserConnect['user_password']);
				return $arrUserConnect;
			}
				return false;		
		}
}