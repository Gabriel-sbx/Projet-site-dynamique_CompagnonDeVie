<?php
	/**
	* Controller de la classe MotherCtrl
	* @author Fabrice, Gabriel, Nabil
	* @version 1.0
	* @date 19/01/2025-15/02/2025
	*/

	use Smarty\Smarty; /// Inclusion de la bibliothèque Smarty pour la gestion des templates

	/**
	* Classe mère pour les contrôleurs, servant de base aux autres classes contrôleurs
	*/
	class MotherCtrl{
		
		/// Tableau contenant les données à transmettre à la vue
		protected array $_arrData = array();
		
		/// Tableau contenant les messages d'erreur éventuels
		protected array $_arrErrors = array();
		
		/// Tableau contenant les messages de succès éventuels
		protected array $_arrSuccess = array();

		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			// Initialisation du contrôleur parent
		}
		
		/**
        * @param string $strView Nom du fichier de vue à afficher
        * @param bool $boolAffiche Indique si la vue doit être affichée directement (true) ou retournée sous forme de chaîne (false)
        * @return string|null Retourne le contenu de la vue si $boolAffiche est false, sinon affiche directement la vue
        */
		public function display(string $strView, bool $boolAffiche = true){
			$objSmarty = new Smarty(); /// Instanciation de l'objet Smarty pour la gestion des templates
			
			/// Assignation des données stockées dans $_arrData à Smarty
			foreach ($this->_arrData as $key => $value){
				$objSmarty->assign($key, $value);
			}
			
			if ($boolAffiche){
				/// Assignation des tableaux d'erreurs et de succès à la vue
				$objSmarty->assign("arrErrors", $this->_arrErrors);
				$objSmarty->assign("arrSuccess", $this->_arrSuccess);
				/// Affichage du fichier de template correspondant à la vue demandée
				$objSmarty->display("views/" . $strView . ".tpl");
			} else {
				/// Retourne le contenu du fichier de vue sans l'afficher directement
				return $objSmarty->fetch("views/" . $strView . ".tpl");
			}
			
		}
	}
