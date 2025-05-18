<?php 
    /**
	* Controller de la class LogCtrl
	* @author Gabriel
	* @version 1.0
	* @date 19/01/2025-15/02/2025
	*/
        
	class LogCtrl extends MotherCtrl{
                // Déclaration d'un attribut privé pour stocker une instance du modèle LogModel
		private object $_objLogModel;
                // Déclaration d'un attribut privé pour stocker une instance du modèle UserModel
                private object $_objUserModel;

                /**
		* Constructeur
		*/
		public function __construct(){
	        // inclure les fichiers modèle et entité 
			require_once("models/model_user.php");
			require_once("entities/entity_user.php");
			// instancier
			$this->_objUserModel	= new UserModel();
			require_once("models/model_log.php");
			require_once("entities/entity_log.php");
                        // instancier
			$this->_objLogModel = new LogModel();
                
		}
        
                /**
                 * Méthode gérant l'affichage des connexions de la semaine pour l'administration
                 * 
                 * Cette méthode :
                 * - Vérifie que l'utilisateur est administrateur
                 * - Récupère les logs de connexion de tous les utilisateurs standards
                 * - Récupère les logs de connexion de tous les modérateurs
                 * - Récupère les logs de connexion de tous les administrateurs
                 * - Hydrate les objets logs pour chaque type d'utilisateur
                 * - Prépare les données pour l'affichage dans la vue
                 * 
                 */
                public function list_log_week_admin() {
                        // Définition de la page courante pour l'identifier
                        $this->_arrData['strPage'] = "list_log_week_admin";
                
                        // Redirection si non connecté ou droits insuffisants
                        if(!isset($_SESSION['user']) || ($_SESSION['user']->getType() != 'ADM')) {
                        header("Location:index.php?ctrl=error&action=error_403");
                        }
                
                        // Récupération et hydratation des logs des utilisateurs standards
                        $arrLogUserAll = $this->_objLogModel->logUserAll();
                        $arrLogUserDisplay = array();
                        foreach($arrLogUserAll as $arrLogDetUserAll) {
                                $objLogUserAll = new Log;
                                $objLogUserAll->hydrate($arrLogDetUserAll);
                                $arrLogUserDisplay[] = $objLogUserAll;
                        }
                
                        // Récupération et hydratation des logs des modérateurs
                        $arrLogModoAll = $this->_objLogModel->logModoAll();
                        $arrLogModoDisplay = array();
                        foreach($arrLogModoAll as $arrLogDetModoAll) {
                                $objLogModoAll = new Log;
                                $objLogModoAll->hydrate($arrLogDetModoAll);
                                $arrLogModoDisplay[] = $objLogModoAll;
                        }
                
                        // Récupération et hydratation des logs des administrateurs
                        $arrLogAdminAll = $this->_objLogModel->logAdminAll();
                        $arrLogAdminDisplay = array();
                        foreach($arrLogAdminAll as $arrLogDetAdminAll) {
                                $objLogAdminAll = new Log;
                                $objLogAdminAll->hydrate($arrLogDetAdminAll);
                                $arrLogAdminDisplay[] = $objLogAdminAll;
                        }
                
                        // Transmission des données à la vue
                        $this->_arrData['arrLogUserAll'] = $arrLogUserDisplay;
                        $this->_arrData['arrLogModoAll'] = $arrLogModoDisplay;
                        $this->_arrData['arrLogAdminAll'] = $arrLogAdminDisplay;
                
                        // Affichage de la vue de liste des logs
                        $this->display("admin/list_log_week_admin");
                }
                
                /**
                * Méthode gérant l'affichage de l'historique complet des connexions pour l'administration
                * 
                * Cette méthode :
                * - Vérifie que l'utilisateur est administrateur
                * - Récupère la liste complète des utilisateurs standards 
                * - Récupère la liste complète des modérateurs
                * - Récupère la liste complète des administrateurs
                * - Hydrate les objets utilisateurs pour chaque type
                * - Prépare les données pour l'affichage dans la vue
                * 
                */
                public function list_log_history_admin() {
                        // Définition de la page courante pour l'identifier
                        $this->_arrData['strPage'] = "list_log_history_admin";
                
                        // Redirection si non connecté ou droits insuffisants
                        if(!isset($_SESSION['user']) || ($_SESSION['user']->getType() != 'ADM')) {
                        header("Location:index.php?ctrl=error&action=error_403");
                        }
                
                        // Récupération et hydratation de tous les utilisateurs standards
                        $arrUserAll = $this->_objUserModel->userAll();
                        $arrUserDisplay = array();
                        foreach($arrUserAll as $arrUserDetAll) {
                                $objUserAll = new User;
                                $objUserAll->hydrate($arrUserDetAll);
                                $arrUserDisplay[] = $objUserAll;
                        }
                
                        // Récupération et hydratation de tous les modérateurs 
                        $arrModoAll = $this->_objUserModel->modoAll();
                        $arrModoDisplay = array();
                        foreach($arrModoAll as $arrModoDetAll) {
                                $objModoAll = new User;
                                $objModoAll->hydrate($arrModoDetAll);
                                $arrModoDisplay[] = $objModoAll;
                        }
                
                        // Récupération et hydratation de tous les administrateurs
                        $arrAdminAll = $this->_objUserModel->adminAll();
                        $arrAdminDisplay = array();
                        foreach($arrAdminAll as $arrAdminDetAll) {
                                $objAdminAll = new User;
                                $objAdminAll->hydrate($arrAdminDetAll);
                                $arrAdminDisplay[] = $objAdminAll;
                        }
                
                        // Transmission des données à la vue
                        $this->_arrData['arrUserAll'] = $arrUserDisplay;
                        $this->_arrData['arrModoAll'] = $arrModoDisplay;
                        $this->_arrData['arrAdminAll'] = $arrAdminDisplay;
                
                        // Affichage de la vue de l'historique
                        $this->display("admin/list_log_history_admin");
                }
                /**
                * Méthode gérant l'affichage détaillé de l'historique des connexions d'un utilisateur spécifique
                * 
                * Cette méthode :
                * - Vérifie que l'utilisateur est administrateur
                * - Récupère l'ID de l'utilisateur à consulter depuis l'URL
                * - Récupère l'historique complet des connexions pour cet utilisateur
                * - Hydrate les objets logs avec les données
                * - Prépare les données pour l'affichage dans la vue
                * 
                * @return mixed Affiche la vue détaillée de l'historique ou redirige vers une erreur 403
                */
                public function details_log_history_admin() {
                        // Définition de la page courante pour l'identifier
                        $this->_arrData['strPage'] = "details_log_history_admin";
                
                        // Redirection si non connecté ou droits insuffisants
                        if(!isset($_SESSION['user']) || ($_SESSION['user']->getType() != 'ADM')) {
                        header("Location:index.php?ctrl=error&action=error_403");
                        }
                
                        // Récupération de l'ID utilisateur depuis l'URL
                        $userId = $_GET['id'];
                
                        // Récupération et hydratation de tous les logs de l'utilisateur
                        $arrLogAll = $this->_objLogModel->logDetailsAll($userId);
                        if(empty($arrLogAll)) {
                                $this->_arrErrors['log'] = "Cet utilisateur n'a aucune connexion ";
 
                        } else {

                                $arrLogDisplay = array();
                                foreach($arrLogAll as $arrLogDetAll) {
                                        $objLogAll = new Log;
                                        $objLogAll->hydrate($arrLogDetAll);
                                        $arrLogDisplay[] = $objLogAll;
                                }                        
                                $this->_arrData['arrLogAll'] = $arrLogDisplay;

                        }       
                        // Transmission des données à la vue
                        $this->display("admin/details_log_history_admin");
                }
        
        }