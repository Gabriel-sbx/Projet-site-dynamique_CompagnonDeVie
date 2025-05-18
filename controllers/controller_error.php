<?php
    /**
	* Controller de la class ErrorCtrl
	* @author Gabriel
	* @version 1.0
	* @date 19/01/2025-15/02/2025
	*/

class ErrorCtrl extends MotherCtrl{
    /**
    * Constructeur de la classe ErrorCtrl
    */
    public function __construct(){
        // Appelle le constructeur de la classe mère
        parent::__construct();
    }

    /**
    * Gestion de l'erreur 404 - Page non trouvée
    */
    public function error_404(){
        // Définition de la page d'erreur
        $this->_arrData['strPage'] = "error404";
        
        // Affichage de la page d'erreur 404
        $this->display("error/error404");
    }

    /**
    * Gestion de l'erreur 403 - Accès interdit
    */
    public function error_403(){
        // Définition de la page d'erreur
        $this->_arrData['strPage'] = "error403";
        
        // Affichage de la page d'erreur 403
        $this->display("error/error403");
    }
}
