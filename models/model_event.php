<?php
	/**
	* Classe de gestion de la base de données pour les évenements
	* @author Nabil
	* @version 1.0
	* @date 14/01/2025
	*/
	require_once("model_mother.php");

	class EventModel extends MotherModel {
		
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
	
		}

/********************************************************* Ajout évenement *******************************************************************/

		/**
		*  Gestion des événements (EventModel)
		* Ajout d'un event
		* @param object $objEvent de l'événement de la bdd
		* @return bool L'insertion s'est bien passé ou pas
		*/
		public function eventAdd(object $objEvent):bool{
			try{
			$strEventAdd	= "INSERT INTO `event`(event_name, event_description, event_picture, event_status, event_date, event_date_crea)

							VALUES (:name, :description, :picture,'D', :date, NOW());";

			$prep 			= $this->_db->prepare($strEventAdd);
            $prep->bindValue(":name",$objEvent->getName(), PDO::PARAM_STR);
            $prep->bindValue(":description",$objEvent->getDescription(), PDO::PARAM_STR);
            $prep->bindValue(":picture",$objEvent->getPicture(), PDO::PARAM_STR);
            $prep->bindValue(":date",$objEvent->getDate(), PDO::PARAM_STR);

			return $prep->execute();
		}catch(PDOException $e){
			return false;
		}
				
		}

		/**
		* Récupération de tous les evenement
		* @param int $intNbLimit Nombre de résultats à afficher - si tous = 0
		* @return array Tableau des Evenement de la bdd
		*/
		public function findAll(int $intNbLimit=0):array{

			$strQueryCard	= "SELECT event_id, event_name, event_description, event_picture, event_status, event_date, event_date_crea
			FROM event";

			$arrPicture = $this->_db->query($strQueryCard)->fetchAll();
			return $arrPicture;
		}

/**************************************************************** Suppression événement **************************************************************/

		/**
		* Suppression des evenements
		* @return object objEvent evenements de la bdd
		* @return bool La suppression s'est bien passé ou pas
		*/
		public function eventDel(object $objEvent):bool {
			try {
				$strEventDel = "DELETE FROM event
								 WHERE event_id = :id;";
				$prep = $this->_db->prepare($strEventDel);
				$prep->bindValue(":id", $objEvent->getId(), PDO::PARAM_INT);
				return $prep->execute(); // Renvoie true si la suppression réussit, false sinon
			} catch (PDOException $e) {
				return false;
			}
		}

/********************************************************* Modification événement *******************************************************************/

		/**
		* Modification des envenement
		* @param object $objEvent des événement 
		* @return bool L'Modification s'est bien passé ou pas
		*/
		public function eventEdit(object $objEvent):bool {
			try {
				$strEventEdit = "UPDATE `event`
								 SET event_name = :name,
									 event_description = :description,
									 event_picture = :picture,
									 event_status = :status,
									 event_date = :date
								 WHERE event_id = :id;";
		
				$prep = $this->_db->prepare($strEventEdit);
				$prep->bindValue(":id", $objEvent->getId(), PDO::PARAM_INT);
				$prep->bindValue(":name", $objEvent->getName(), PDO::PARAM_STR);
				$prep->bindValue(":description", $objEvent->getDescription(), PDO::PARAM_STR);
				$prep->bindValue(":picture", $objEvent->getPicture(), PDO::PARAM_STR);
				$prep->bindValue(":status", $objEvent->getStatus(), PDO::PARAM_STR);
				$prep->bindValue(":date", $objEvent->getDate(), PDO::PARAM_STR);
				
				$prep->execute();
			} catch (PDOException $e) {
				return false;
			}
			return true;
		}

		/**
		* Récupération de tous les evenement
		* @return array Tableau des Evenement de la bdd
		*/
			public function findEventAdmin():array{
				$strQueryCard = "SELECT event_id, event_name, event_description, event_date,
								FROM event
								ORDER BY event_date DESC;";
			$arrFindEventAdmin = $this->_db->query($strQueryCard)->fetchAll();
			return $arrFindEventAdmin;
			}


	/**
		* Récupération d'un  événement
		* @param int $intEventId Nombre de résultats à afficher - si tous = 0
		* @return array Tableau des Animaux de la bdd
		*/

		public function findOne(int $intEventId):array{
			$strQueryCard = "SELECT event_id, event_name, event_description, event_picture, event_status, event_date, event_date_crea
							 FROM `event`
							 WHERE event_id = :id;";
		
			$prep = $this->_db->prepare($strQueryCard);
			$prep->bindValue(":id", $intEventId, PDO::PARAM_INT);
			$prep->execute();
			$arrEvent = $prep->fetch();
			return $arrEvent;      
		}

}