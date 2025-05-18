<?php 
/**
* Classe du Ctrl UserCtrl
* @author Soubeyroux Gabriel
* @version 1.0
* @date 19/01/2025-15/02/2025
*/
	class UserCtrl extends MotherCtrl{
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
		}
        /**
         * Méthode gérant le processus de connexion d'un utilisateur
         * 
         * Cette méthode :
         * - Vérifie si l'utilisateur n'est pas déjà connecté
         * - Traite les données du formulaire de connexion
         * - Valide les champs email et mot de passe
         * - Authentifie l'utilisateur
         * - Gère la session utilisateur
         * - Enregistre la tentative de connexion dans les logs
         * 
         */
        public function login() {

            // Définition de la page courante pour l'identifier
            $this->_arrData['strPage'] = "login";
            
            // Inclusion des classes nécessaires
            require_once("models/model_log.php");
            require_once("entities/entity_log.php");
            
            // Redirection si l'utilisateur est déjà connecté
            if (count($_SESSION) > 0 
                && isset($_SESSION['user']) 
                && $_SESSION['user']->getId() != "") {
                header("Location:index.php");
            }
            
            // Récupération des données du formulaire avec opérateur de fusion null
            $strEmail = $_POST['email'] ?? "";
            $strPassword = $_POST['password'] ?? "";
            
            // Traitement du formulaire lors de sa soumission
            if (count($_POST) > 0) {
                // Validation du champ email
                if ($strEmail == "") {
                    $this->_arrErrors['email'] = "Veuillez renseigner votre adresse email";
                } else if (!filter_var($strEmail, FILTER_VALIDATE_EMAIL)) {
                    $this->_arrErrors['email'] = "Veuillez renseigner une adresse email valide";
                }
                
                // Validation du champ mot de passe
                if ($strPassword == "") {
                    $this->_arrErrors['password'] = "Veuillez renseigner votre mot de passe";
                }
                
                // Processus d'authentification si aucune erreur de validation
                if (count($this->_arrErrors) == 0) {
                    // Tentative de connexion via le modèle utilisateur
                    $arrUserConnect = $this->_objUserModel->findUserConnect($strEmail, $strPassword);
                    
                    if ($arrUserConnect === false) {
                        $this->_arrErrors['connect'] = "Erreur de connexion";
                    } else {
                        // Création de la session utilisateur
                        $objUserSession = new User;
                        $objUserSession->hydrate($arrUserConnect);
                        $_SESSION['user'] = $objUserSession;
                        $userId = $_SESSION['user']->getId();
                        
                        // Enregistrement de la connexion dans les logs
                        $objLogModel = new LogModel();
                        $objLogModel->logAdd($userId);
                        
                        // Redirection vers la page d'accueil après connexion réussie
                        header("Location:index.php");
                    }
                }
            }
            
            // Transmission des données à la vue
            $this->_arrData['strEmail'] = $strEmail;
            $this->display("user/login");
        }

        /**
         * Méthode gérant le processus d'inscription d'un nouvel utilisateur
         * 
         * Cette méthode :
         * - Vérifie si l'utilisateur n'est pas déjà connecté
         * - Traite les données du formulaire d'inscription
         * - Valide tous les champs requis (nom, prénom, pseudo, email, mot de passe)
         * - Vérifie l'unicité du pseudo et de l'email
         * - Valide la complexité du mot de passe
         * - Crée le nouveau compte utilisateur
         * - Gère les messages de succès/erreur
         * 
         */
        public function signup() {

            // Définition de la page courante pour l'identifier
            $this->_arrData['strPage'] = "signup";
            
            // Redirection si l'utilisateur est déjà connecté
            if (count($_SESSION) > 0 
                && isset($_SESSION['user']) 
                && $_SESSION['user']->getId() != "") {
                header("Location:index.php");
            }
            
            // Création d'un nouvel objet utilisateur
            $objUserAdd = new User;
            
            // Traitement du formulaire lors de sa soumission
            if (count($_POST) > 0) {
                // Hydratation de l'objet utilisateur avec les données du formulaire
                $objUserAdd->hydrate($_POST);
                
                // Validation du champ nom
                if ($objUserAdd->getName() == "") {
                    $this->_arrErrors['name'] = "Le nom est obligatoire";
                }
                
                // Validation du champ prénom
                if ($objUserAdd->getSurname() == "") {
                    $this->_arrErrors['surname'] = "Le prénom est obligatoire";
                }
                
                // Validation du champ pseudo et vérification de son unicité
                if ($objUserAdd->getPseudo() == "") {
                    $this->_arrErrors['pseudo'] = "Le pseudo est obligatoire";
                } else if ($this->_objUserModel->userVerifPseudo($objUserAdd->getPseudo(), $objUserAdd->getId())) {
                    $this->_arrErrors['pseudo'] = "Le pseudo est déjà utilisée";
                }
                
                // Validation du champ email, de son format et de son unicité
                if ($objUserAdd->getEmail() == "") {
                    $this->_arrErrors['email'] = "L'adresse mail est obligatoire";
                } else if (!filter_var($objUserAdd->getEmail(), FILTER_VALIDATE_EMAIL)) {
                    $this->_arrErrors['email'] = "L'adresse mail n'est pas valide";
                } else if ($this->_objUserModel->userVerifEmail($objUserAdd->getEmail(), $objUserAdd->getId())) {
                    $this->_arrErrors['email'] = "L'adresse mail est déjà utilisée";
                }
                
                // Validation du mot de passe, de sa confirmation et de sa complexité
                if ($objUserAdd->getPassword() == "") {
                    $this->_arrErrors['password'] = "Le mot de passe est obligatoire";
                } else if ($objUserAdd->getPassword() != $_POST['confirm_password']) {
                    $this->_arrErrors['password'] = "Le mot de passe et sa confirmation ne sont pas identique";
                } else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{16,}$/", $objUserAdd->getPassword())) {
                    $this->_arrErrors['password'] = "Le mot de passe ne correspond pas aux règles de sécurité";
                }
                
                // Création du compte si aucune erreur de validation
                if (count($this->_arrErrors) === 0) {
                    // Tentative d'ajout de l'utilisateur dans la base de données
                    $boolTrue = $this->_objUserModel->userAdd($objUserAdd);
                    
                    // Gestion des messages de retour
                    if ($boolTrue) {
                        $this->_arrSuccess[] = "L'utilisateur a été ajouté avec succès ! Veuillez vous connectez";
                    } else {
                        $this->_arrErrors[] = "L'insertion s'est mal passée";
                    }
                }
            }
            
            // Transmission des données à la vue
            $this->_arrData['objUserAdd'] = $objUserAdd;
            $this->display("user/signup");
        }

        /**
         * Méthode gérant le processus de déconnexion d'un utilisateur
         * 
         * Cette méthode :
         * - Détruit la session courante de l'utilisateur
         * - Redirige l'utilisateur vers la page de connexion
         * 
                 */
        public function logout() {
            // Destruction de la session utilisateur courante
            session_destroy();
            
            // Redirection vers la page de connexion
            header("Location:index.php?ctrl=user&action=login");
        }

        /**
        * Méthode gérant l'affichage et le traitement du profil utilisateur
        * 
        * Cette méthode :
        * - Vérifie que l'utilisateur est connecté
        * - Vérifie les permissions d'accès au profil
        * - Charge les modèles et entités nécessaires
        * - Récupère les statistiques de l'utilisateur (favoris, adoptions, témoignages)
        * - Prépare toutes les données pour l'affichage du profil
        * 
        */
        public function profil() {
            // Définition de la page courante
            $this->_arrData['strPage'] = "home_profil";
        
            // Redirection si l'utilisateur n'est pas connecté
            if (!isset($_SESSION['user'])) {
                header("Location:index.php?ctrl=user&action=login");
            }
        
            // Redirection si tentative d'accès au profil d'un autre utilisateur
            if (isset($_GET['id']) && ($_GET['id'] != $_SESSION['user']->getId())) {
                header("Location:index.php?ctrl=error&action=error403");
            }
        
            // Inclusion des modèles et entités nécessaires
            require_once("models/model_favorite.php");
            require_once("entities/entity_favorite.php");
            require_once("models/model_adopt.php");
            require_once("entities/entity_adopt.php");
            require_once("models/model_testify.php");
            require_once("entities/entity_testify.php");
        
            // Récupération de l'ID utilisateur depuis la session
            $userId = $_SESSION['user']->getId();
        
            // Récupération et hydratation des données du profil utilisateur
            $arrUser = $this->_objUserModel->userOne($userId);
            $objUserProfil = new User();
            $objUserProfil->hydrate($arrUser);
        
            // Récupération et hydratation du nombre total d'utilisateurs (pour admin)
            $arrUserCount = $this->_objUserModel->countUser();
            $objUserCount = new User();
            $objUserCount->hydrate($arrUserCount);
        
            // Récupération et hydratation des statistiques des favoris
            $objFavoriteModel = new FavoriteModel();
            $arrFavorite = $objFavoriteModel->countFavorite($userId);
            $objUserFavorite = new Favorite();
            $objUserFavorite->hydrate($arrFavorite);
        
            // Récupération et hydratation des statistiques des adoptions
            $objAdoptModel = new AdoptModel();
            $arrAdopt = $objAdoptModel->countAdopt($userId);
            $objUserAdopt = new Adopt();
            $objUserAdopt->hydrate($arrAdopt);
        
            // Récupération et hydratation du nombre d'adoptions en attente
            $arrAdoptCount = $objAdoptModel->countAdoptValidating();
            $objAdoptCount = new Adopt();
            $objAdoptCount->hydrate($arrAdoptCount);
        
            // Récupération et hydratation des statistiques des témoignages
            $objTestifyModel = new TestifyModel();
            $arrTestify = $objTestifyModel->countTestify($userId);
            $objUserTestify = new Testify();
            $objUserTestify->hydrate($arrTestify);
        
            // Récupération et hydratation du nombre de témoignages en attente
            $arrTestifyCount = $objTestifyModel->countTestifyValidating($userId);
            $objCountTestify = new Testify();
            $objCountTestify->hydrate($arrTestifyCount);
        
            // Transmission de toutes les données à la vue
            $this->_arrData['arrTestify'] = $arrTestify;
            $this->_arrData['objUserTestify'] = $objUserTestify;
            $this->_arrData['arrTestifyCount'] = $arrTestifyCount;
            $this->_arrData['objCountTestify'] = $objCountTestify;
        
            $this->_arrData['arrAdopt'] = $arrAdopt;
            $this->_arrData['objAdoptCount'] = $objAdoptCount;
            $this->_arrData['arrAdoptCount'] = $arrAdoptCount;
            $this->_arrData['objUserAdopt'] = $objUserAdopt;
        
            $this->_arrData['arrFavorite'] = $arrFavorite;
            $this->_arrData['objUserFavorite'] = $objUserFavorite;
        
            $this->_arrData['arrUser'] = $arrUser;
            $this->_arrData['objUserProfil'] = $objUserProfil;
        
            $this->_arrData['arrUserCount'] = $arrUserCount;
            $this->_arrData['objUserCount'] = $objUserCount;
        
            // Affichage de la vue profil
            $this->display("user/profil");
        }
        

        /**
        * Méthode gérant la modification du profil utilisateur
        * 
        * Cette méthode :
        * - Vérifie que l'utilisateur est connecté
        * - Récupère les données actuelles du profil
        * - Traite les données du formulaire de modification
        * - Valide tous les champs modifiés
        * - Met à jour le profil utilisateur
        * - Gère les messages de succès/erreur
        * 
        */
        public function edit_profil() {
            // Définition de la page courante
            $this->_arrData['strPage'] = "edit_profil";
        
            // Redirection si l'utilisateur n'est pas connecté
            if (!isset($_SESSION['user'])) {
                header("Location:index.php?ctrl=user&action=login");
            }
            // Stockage des différents picsum des animaux dans un tableau
            $imagePicsum = array(582, 40, 1025, 169, 237);
            // Génere l'id des image dans le tableau aléatoirement
            $randomImage = $imagePicsum[array_rand($imagePicsum)];

            // Récupération de l'ID utilisateur depuis la session
            $userId = $_SESSION['user']->getId();

            // Récupération et hydratation des données actuelles du profil
            $arrUser = $this->_objUserModel->userOne($userId);
            $objUserProfil = new User;
            $objUserProfil->hydrate($arrUser);
        
            // Création d'un objet pour les modifications
            $objUserUpd = new User;
        
            // Traitement du formulaire lors de sa soumission
            if (count($_POST) > 0) {
                // Hydratation de l'objet avec les données du formulaire
                $objUserUpd->hydrate($_POST);
                // Attribution de l'ID de session à l'objet
                $objUserUpd->setId($_SESSION['user']->getId());
        
                // Validation du champ nom
                if ($objUserUpd->getName() == "") {
                    $this->_arrErrors['name'] = "Le nom est obligatoire";
                }
        
                // Validation du champ prénom
                if ($objUserUpd->getSurname() == "") {
                    $this->_arrErrors['surname'] = "Le prénom est obligatoire";
                }
        
                // Validation du champ pseudo et vérification de son unicité
                if ($objUserUpd->getPseudo() == "") {
                    $this->_arrErrors['pseudo'] = "Le pseudo est obligatoire";
                } else if ($this->_objUserModel->userVerifPseudo($objUserUpd->getPseudo(), $userId)) {
                    $this->_arrErrors['pseudo'] = "Le pseudo est déjà utilisée";
                }
        
                // Validation du champ email, de son format et de son unicité
                if ($objUserUpd->getEmail() == "") {
                    $this->_arrErrors['email'] = "L'email est obligatoire";
                } else if (!filter_var($objUserUpd->getEmail(), FILTER_VALIDATE_EMAIL)) {
                    $this->_arrErrors['email'] = "L'adresse email n'est pas valide";
                } else if ($this->_objUserModel->userVerifEmail($objUserUpd->getEmail(), $userId)) {
                    $this->_arrErrors['email'] = "L'adresse email est déjà utilisée";
                }
                
                // Validation du type de compte utilisateur
                if ($objUserUpd->getType() == "") {
                    $this->_arrErrors['type'] = "Le type de compte doit etre remplit";
                } else if ($objUserUpd->getType() != "UC" && $objUserUpd->getType() != "MOD" && $objUserUpd->getType() != "ADM") {
                    $this->_arrErrors['type'] = "Le type de compte doit etre valide";
                }
        
                // Mise à jour du profil si aucune erreur de validation
                if (count($this->_arrErrors) === 0) {
                    // Tentative de mise à jour dans la base de données
                    $boolTrue = $this->_objUserModel->userUpd($objUserUpd);
        
                    // Gestion des messages de retour
                    if ($boolTrue) {
                        $this->_arrSuccess[] = "Vos modifications on été ajouté avec succès !";
                        // Actualisation des données affichées
                        $arrUser = $this->_objUserModel->userOne($userId);
                        $objUserProfil->hydrate($arrUser);
                    } else {
                        $this->_arrErrors[] = "Les modifications ont échouées";
                    }
                }
            }
        
            // Transmission des données à la vue
            $this->_arrData['arrUser']       = $arrUser;
            $this->_arrData['objUserProfil'] = $objUserProfil;
            $this->_arrData['objUserUpd']    = $objUserUpd;
            $this->_arrData['randomImage']   = $randomImage; 
            // Affichage de la vue de modification du profil
            $this->display("user/edit_profil");
        }

        /**
        * Méthode gérant la modification d'un profil utilisateur par un administrateur
        * 
        * Cette méthode :
        * - Vérifie les droits d'accès administrateur
        * - Récupère les données de l'utilisateur à modifier
        * - Traite les données du formulaire de modification
        * - Valide tous les champs modifiés y compris le type de compte
        * - Met à jour le profil utilisateur
        * - Gère les messages de succès/erreur
        * 
                */
        public function edit_user_admin() {
            // Définition de la page courante
            $this->_arrData['strPage'] = "edit_user_admin";
        
            // Redirection si non connecté ou droits insuffisants
            if (!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')) {
                header("Location:index.php?ctrl=error&action=error_403");
            }
        
            // Récupération de l'ID utilisateur depuis l'URL
            $userId = $_GET['id'];
            // Récupération du typede l'utilisateur depuis la Session
            $userType =$_SESSION['user']->getType();
           
            // Récupération et hydratation des données de l'utilisateur à modifier
            $arrUser = $this->_objUserModel->userOne($userId);
            $objUserProfil = new User;
            $objUserProfil->hydrate($arrUser);
           // Vérification que si la personne qui modifie et un modérateur il peut modifier seulement les informations d'un utilisateurs lambda
            if($userType == "MOD"){
                if($objUserProfil->getType()!="UC"){
                header("Location:index.php?ctrl=error&action=error_403");
                }
            }
            // Création d'un objet pour les modifications
            $objUserUpd = new User;
        
            // Traitement du formulaire lors de sa soumission
            if (count($_POST) > 0) {
                // Hydratation de l'objet avec les données du formulaire
                $objUserUpd->hydrate($_POST);
                // Attribution de l'ID de l'utilisateur à modifier
                $objUserUpd->setId($userId);
        
                // Validation du champ nom
                if ($objUserUpd->getName() == "") {
                    $this->_arrErrors['name'] = "Le nom est obligatoire";
                }
        
                // Validation du champ prénom
                if ($objUserUpd->getSurname() == "") {
                    $this->_arrErrors['surname'] = "Le prénom est obligatoire";
                }
        
                // Validation du champ pseudo et vérification de son unicité
                if ($objUserUpd->getPseudo() == "") {
                    $this->_arrErrors['pseudo'] = "Le pseudo est obligatoire";
                } else if ($this->_objUserModel->userVerifPseudo($objUserUpd->getPseudo(), $userId)) {
                    $this->_arrErrors['pseudo'] = "Le pseudo est déjà utilisée";
                }
        
                // Validation du champ email, de son format et de son unicité
                if ($objUserUpd->getEmail() == "") {
                    $this->_arrErrors['email'] = "L'email est obligatoire";
                } else if (!filter_var($objUserUpd->getEmail(), FILTER_VALIDATE_EMAIL)) {
                    $this->_arrErrors['email'] = "L'adresse email n'est pas valide";
                } else if ($this->_objUserModel->userVerifEmail($objUserUpd->getEmail(), $userId)) {
                    $this->_arrErrors['email'] = "L'adresse email est déjà utilisée";
                }
        
                // Validation du type de compte utilisateur
                if ($objUserUpd->getType() == "") {
                    $this->_arrErrors['type'] = "Le type de compte doit etre remplit";
                } else if ($objUserUpd->getType() != "UC" && $objUserUpd->getType() != "MOD" && $objUserUpd->getType() == "ADM") {
                    $this->_arrErrors['type'] = "Le type de compte doit etre valide";
                }
        
                // Mise à jour du profil si aucune erreur de validation
                if (count($this->_arrErrors) === 0) {
                    // Tentative de mise à jour dans la base de données
                    $boolTrue = $this->_objUserModel->userUpd($objUserUpd);
        
                    // Gestion des messages de retour
                    if ($boolTrue) {
                        $this->_arrSuccess[] = "Vos modifications on été ajouté avec succès !";
                        // Actualisation des données affichées
                        $arrUser = $this->_objUserModel->userOne($userId);
                        $objUserProfil->hydrate($arrUser);
                    } else {
                        $this->_arrErrors[] = "Les modifications ont échouées";
                    }
                }
            }
        
            // Transmission des données à la vue
            $this->_arrData['userId'] = $userId;
            $this->_arrData['arrUser'] = $arrUser;
            $this->_arrData['objUserProfil'] = $objUserProfil;
            $this->_arrData['objUserUpd'] = $objUserUpd;
        
            // Affichage de la vue de modification du profil
            $this->display("user/edit_profil");
        }
        
        /**
        * Méthode gérant la modification du mot de passe utilisateur
        * 
        * Cette méthode :
        * - Vérifie que l'utilisateur est connecté
        * - Traite les données du formulaire de modification de mot de passe
        * - Valide la complexité et la confirmation du nouveau mot de passe
        * - Met à jour le mot de passe utilisateur
        * - Gère les messages de succès/erreur
        * 
                */
        public function edit_password() {
            // Définition de la page courante
            $this->_arrData['strPage'] = "edit_password";
        
            // Redirection si l'utilisateur n'est pas connecté
            if (!isset($_SESSION['user'])) {
                header("Location:index.php?ctrl=user&action=login");
            }
        
            // Création d'un objet pour la modification du mot de passe
            $objUserUpdPwd = new User;
        
            // Traitement du formulaire lors de sa soumission
            if (count($_POST) > 0) {
                // Récupération de l'ID utilisateur depuis la session
                $userId = $_SESSION['user']->getId();
                
                // Hydratation de l'objet avec les données du formulaire
                $objUserUpdPwd->hydrate($_POST);
                $objUserUpdPwd->setId($userId);
        
                // Validation du nouveau mot de passe
                if ($objUserUpdPwd->getPassword() == "") {
                    $this->_arrErrors['password'] = "Le mot de passe est obligatoire";
                } else if ($objUserUpdPwd->getPassword() != $_POST['confirm_password']) {
                    $this->_arrErrors['password'] = "Le mot de passe et sa confirmation ne sont pas identique";
                } else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{16,}$/", $objUserUpdPwd->getPassword())) {
                    $this->_arrErrors['password'] = "Le mot de passe ne correspond pas aux règles de sécurité";
                }
        
                // Mise à jour du mot de passe si aucune erreur de validation
                if (count($this->_arrErrors) === 0) {
                    // Tentative de mise à jour dans la base de données
                    $boolTrue = $this->_objUserModel->userUpdPwd($objUserUpdPwd);
        
                    // Gestion des messages de retour
                    if ($boolTrue) {
                        $this->_arrSuccess[] = "Votre modification de mot de passe a été effectuée avec succès !";
                    } else {
                        $this->_arrErrors[] = "Les modifications ont échouées";
                    }
                }
            }
        
            // Transmission des données à la vue
            $this->_arrData['objUserUpdPwd'] = $objUserUpdPwd;
        
            // Affichage de la vue de modification du mot de passe
            $this->display("user/edit_pwd_profil");
        }

        /**
        * Méthode gérant la suppression d'un compte utilisateur
        * 
        * Cette méthode :
        * - Vérifie que l'utilisateur est connecté  
        * - Affiche un formulaire de confirmation de suppression
        * - Valide que l'utilisateur a bien saisi "SUPPRIMER" 
        * - Supprime le compte utilisateur de la base de données
        * - Détruit la session et redirige vers la page d'accueil
        * - Gère les messages d'erreur
        *
                */
        public function delete_profil() {
            // Définition de la page courante
            $this->_arrData['strPage'] = "delete_profil";
        
            // Redirection si l'utilisateur n'est pas connecté
            if(!isset($_SESSION['user'])) {
                header("Location:index.php?ctrl=user&action=login");
            }
                
            // Récupération de l'ID utilisateur depuis la session
            $userId = $_SESSION['user']->getId();
        
            // Création d'un objet pour la suppression
            $objUserDlt = new User;
            
            // Traitement du formulaire lors de sa soumission
            if (count($_POST) > 0) {
                // Validation de la confirmation de suppression 
                if ($_POST['verifDelete'] != "SUPPRIMER") {
                    $this->_arrErrors['verifDelete'] = "Taper SUPPRIMER  dans le champ de vérification pour confirmer la suppression";
                }                        
        
                // Hydratation de l'objet avec les données du formulaire
                $objUserDlt->hydrate($_POST);
                $objUserDlt->setId($userId);
        
                // Suppression du compte si la validation est correcte
                if (count($this->_arrErrors) === 0) {
                    // Tentative de suppression dans la base de données
                    $boolTrue = $this->_objUserModel->userDel($objUserDlt);
                    
                    // Gestion du résultat de la suppression
                    if ($boolTrue) {     
                        // Destruction de la session et redirection vers l'accueil
                        session_destroy();
                        header("Location:index.php?ctrl=animal&action=home");
                    } else {
                        $this->_arrErrors[] = "Les modifications ont échouées";
                    } 
                }                               
            }
            
            // Transmission des données à la vue    
            $this->_arrData['objUserDlt'] = $objUserDlt; 
            
            // Affichage de la vue de suppression de profil
            $this->display("user/delete_profil"); 
        }
           
        /**
        * Méthode gérant la suppression d'un compte utilisateur par un administrateur
        * 
        * Cette méthode :
        * - Vérifie que l'utilisateur est administrateur
        * - Récupère l'ID de l'utilisateur à supprimer depuis l'URL
        * - Affiche un formulaire de confirmation de suppression
        * - Valide que l'administrateur a bien saisi "SUPPRIMER"
        * - Supprime le compte utilisateur de la base de données
        * - Redirige vers la liste des utilisateurs
        * - Gère les messages d'erreur
        *
        */
        public function delete_user_admin() {
            // Définition de la page courante
            $this->_arrData['strPage'] = "delete_profil";
        
            // Redirection si non connecté ou droits insuffisants
            if(!isset($_SESSION['user']) || ($_SESSION['user']->getType() != 'ADM')) {
                header("Location:index.php?ctrl=error&action=error_403");
            }
        
            // Création d'un objet pour la suppression
            $objUserDlt = new User;


            // Récupération de l'ID utilisateur depuis l'URL
                $userId = $_GET['id'];
            
            if($_GET['id'] == $_SESSION['user']->getId()) {                        
                $this->_arrErrors['verifDelete'] = "Vous ne pouvez supprimez un administrateur. Vous êtes l'administrateur !";
            }
            // Traitement du formulaire lors de sa soumission
            if (count($_POST) > 0) {
                // Validation de la confirmation de suppression
                if ($_POST['verifDelete'] != "SUPPRIMER") {
                    $this->_arrErrors['verifDelete'] = "Taper SUPPRIMER  dans le champ de vérification pour confirmer la suppression";
                }
       
                // Hydratation de l'objet avec les données du formulaire
                $objUserDlt->hydrate($_POST);
                $objUserDlt->setId($userId);
        
                // Suppression du compte si la validation est correcte
                if (count($this->_arrErrors) === 0) {
                    
                        // Tentative de suppression dans la base de données
                        $boolTrue = $this->_objUserModel->userDel($objUserDlt);
                   
                    // Gestion du résultat de la suppression
                    if ($boolTrue) {
                        // Redirection vers la liste des utilisateurs
                        header("Location:index.php?ctrl=user&action=list_user_admin");
                    } else {
                        $this->_arrErrors[] = "Les modifications ont échouées";
                    } 
                 
                }
            }
        
            // Transmission des données à la vue
            $this->_arrData['objUserDlt'] = $objUserDlt;
            
            // Affichage de la vue de suppression de profil
            $this->display("user/delete_profil");
        }



        /**
        * Méthode gérant l'affichage de la liste de tous les utilisateurs pour l'administration
        * 
        * Cette méthode :
        * - Vérifie que l'utilisateur est modérateur ou administrateur
        * - Récupère tous les utilisateurs standards de la base de données
        * - Récupère tous les modérateurs de la base de données
        * - Récupère tous les administrateurs de la base de données
        * - Hydrate les objets utilisateurs pour chaque type
        * - Prépare les données pour l'affichage dans la vue
        * - Affiche la liste complète des utilisateurs par type
        *
        */
        public function list_user_admin() {
            // Définition de la page courante
            $this->_arrData['strPage'] = "list_user_admin";
        
            // Redirection si non connecté ou utilisateur standard
            if(!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')) {
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

        
            // Affichage de la vue liste des utilisateurs
            $this->display("admin/list_user_admin");
        }
           

        /**
        * Méthode gérant l'ajout d'un nouvel utilisateur par un administrateur
        * 
        * Cette méthode :
        * - Vérifie que l'utilisateur est modérateur ou administrateur
        * - Traite les données du formulaire d'ajout 
        * - Valide tous les champs requis (nom, prénom, pseudo, email, mot de passe, type)
        * - Vérifie l'unicité du pseudo et de l'email
        * - Valide la complexité du mot de passe
        * - Vérifie la validité du type de compte (UC, MOD, ADM)
        * - Crée le nouveau compte utilisateur
        * - Gère les messages de succès/erreur
        *
        */
        public function add_user_admin() {
            // Définition de la page courante
            $this->_arrData['strPage'] = "add_user_admin";
        
            // Redirection si non connecté ou utilisateur standard
            if(!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')) {
                header("Location:index.php?ctrl=error&action=error_403");
            }
        
            // Création d'un nouvel objet utilisateur
            $objUserAdd = new User;
        
            // Traitement du formulaire lors de sa soumission
            if (count($_POST) > 0) {
                // Hydratation de l'objet avec les données du formulaire
                $objUserAdd->hydrate($_POST);
        
                // Validation du champ nom
                if ($objUserAdd->getName() == "") {
                    $this->_arrErrors['name'] = "Le nom est obligatoire";
                }
        
                // Validation du champ prénom
                if ($objUserAdd->getSurname() == "") {
                    $this->_arrErrors['surname'] = "Le prénom est obligatoire";
                }
        
                // Validation du champ pseudo et vérification de son unicité
                if ($objUserAdd->getPseudo() == "") {
                    $this->_arrErrors['pseudo'] = "Le pseudo est obligatoire";
                } else if ($this->_objUserModel->userVerifPseudo($objUserAdd->getPseudo(), $objUserAdd->getId())) {
                    $this->_arrErrors['pseudo'] = "Le pseudo est déjà utilisée";
                }
        
                // Validation du champ email, de son format et de son unicité
                if ($objUserAdd->getEmail() == "") {
                    $this->_arrErrors['email'] = "L'adresse mail est obligatoire";
                } else if (!filter_var($objUserAdd->getEmail(), FILTER_VALIDATE_EMAIL)) {
                    $this->_arrErrors['email'] = "L'adresse mail n'est pas valide";
                } else if ($this->_objUserModel->userVerifEmail($objUserAdd->getEmail(), $objUserAdd->getId())) {
                    $this->_arrErrors['email'] = "L'adresse mail est déjà utilisée";
                }
        
                // Validation du mot de passe, de sa confirmation et de sa complexité
                if ($objUserAdd->getPassword() == "") {
                    $this->_arrErrors['password'] = "Le mot de passe est obligatoire";
                } else if ($objUserAdd->getPassword() != $_POST['confirm_password']) {
                    $this->_arrErrors['password'] = "Le mot de passe et sa confirmation ne sont pas identique";
                } else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{16,}$/", $objUserAdd->getPassword())) {
                    $this->_arrErrors['password'] = "Le mot de passe ne correspond pas aux règles de sécurité";
                }
        
                // Validation du type de compte utilisateur
                if ($objUserAdd->getType() == "") {
                    $this->_arrErrors['type'] = "Le type de compte doit etre remplit";
                } else if ($objUserAdd->getType() != "UC" && $objUserAdd->getType() != "MOD" && $objUserAdd->getType() == "ADM") {
                    $this->_arrErrors['type'] = "Le type de compte doit etre valide";
                }
        
                // Création du compte si aucune erreur de validation
                if (count($this->_arrErrors) === 0) {
                    // Tentative d'ajout dans la base de données
                    $boolTrue = $this->_objUserModel->userAddAdmin($objUserAdd);
                    
                    // Gestion des messages de retour
                    if ($boolTrue) {
                        $this->_arrSuccess[] = "L'utilisateur a été ajouté avec succès !";
                    } else {
                        $this->_arrErrors[] = "L'insertion s'est mal passée";
                    }
                }
            }
        
            // Transmission des données à la vue
            $this->_arrData['objUserAdd'] = $objUserAdd;
            
            // Affichage de la vue d'ajout d'utilisateur
            $this->display("admin/add_user_admin");
        }
      
    }

   