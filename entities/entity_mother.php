<?php
	/**
	* Classe MotherEntity
	* Classe de base représentant une entité avec des attributs communs et des méthodes d'hydratation.
	*/
	class MotherEntity{
		
		/// Préfixe utilisé pour la correspondance des noms de colonnes en base de données
		protected string $_prefixe;
		
		/// Nom de l'entité
		protected string $_name = "";
		
		/// Statut de l'entité
		protected string $_status = "";
		
		/// Date de création de l'entité
		protected string $_date_crea = "";

		/// Identifiant unique de l'entité
		private int $_id = 0;
		
		/**
		* Constructeur de la classe
		*/
		public function __construct(){	
		}
		
		/**
		* Méthode permettant d'hydrater l'objet avec un tableau de données
		* @param array $arrData Tableau associatif contenant les données
		*/
		public function hydrate($arrData){
			foreach ($arrData as $key => $value){
				/// Génération du nom du setter en fonction du nom de l'attribut
				$strMethod = "set" . ucfirst(str_replace($this->_prefixe . '_', '', $key));
				/// On appelle le setter uniquement s'il existe
				if(method_exists($this, $strMethod)){
					$this->$strMethod($value);
				}
			}
		}

		/*************************************************** IDENTIFIANT **************************************************************************/
		/**
		* Récupération de l'identifiant
		* @return int  Identifiant de l'entité
		*/
		public function getId(): int {
			return $this->_id;
		}

		/**
		* Mise à jour de l'identifiant
		* @param int $intId Identifiant à attribuer
		*/
		public function setId(int $intId){
			$this->_id = $intId;
		}

		/************************************************* NOM ***************************************************************************************/
		/**
		* Récupération du nom
		* @return string  Nom de l'entité
		*/
		public function getName(): string {
			return $this->_name;
		}

		/**
		* Mise à jour du nom
		* @param string $strUserName Nom à attribuer
		*/
		public function setName(string $strUserName){
			$this->_name = htmlspecialchars(trim($strUserName));
		}

		/************************************************* STATUT ***********************************************************************************/
		/**
		* Récupération du statut d'adoption
		* @return string Statut de l'adoption
		*/
		public function getStatus(): string {
			return $this->_status;
		}

		/**
		* Mise à jour du statut d'adoption
		* @param string $strStatus Statut de l'adoption
		*/
		public function setStatus(string $strStatus){
			$this->_status = $strStatus;
		}

		/************************************************* DATE DE CRÉATION ***************************************************************************/
		/**
		* Récupération de la date de création
		* @return string Date de création de l'entité
		*/
		public function getDate_crea(){
			return $this->_date_crea;
		}

		/**
		* Mise à jour de la date de création
		* @param string $strDateCrea Date de création à attribuer
		*/
		public function setDate_crea(string $strDateCrea){
			$this->_date_crea = $strDateCrea;
		}
	}
