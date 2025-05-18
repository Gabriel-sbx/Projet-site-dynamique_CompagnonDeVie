<?php
    /**
	* Controller de la class Adoptctrl
	* @author Fabrice, Gabriel
	* @version 1.0
	* @date 19/01/2025-15/02/2025
	*/
   
    class AdoptCtrl extends MotherCtrl{
        // Déclaration d'un attribut privé pour stocker une instance du modèle AdoptModel
        private object $_objAdoptModel;
 
       /**
		* Constructeur de la classe
		*/
        public function __construct(){
 
            require_once("models/model_adopt.php");
            require_once("entities/entity_adopt.php");
            $this->_objAdoptModel = new AdoptModel();
            parent::__construct();
        }

        /**
         * Méthode responsable de l'affichage de la page demand_adopt_progress
         * permet d'afficher l'avancement des demandes d'adoption de l'utilisateur connecté
         * puis transmet les données à la vue pour affichage.
         */
        public function demand_adopt_progress(){

            // Définition de la page actuelle pour l'affichage
            $this->_arrData['strPage']  = "demand_adopt_progress";

            // Vérification de la session utilisateur
            // Si aucun utilisateur n'est connecté, on redirige vers la page de connexion
            if(!isset($_SESSION['user'])){
                header("Location:index.php?ctrl=user&action=login");
            }

            // Récupération de l'ID de l'utilisateur connecté depuis la session
            $userId = $_SESSION['user']->getId();

            // Récupération de toutes les demandes d'adoption en cours de l'utilisateur
            $arrAdoptAll = $this->_objAdoptModel->readAdoptProgress($userId);

            // Tableau pour stocker les objets Adopt après hydratation
            $arrAdoptDisplay = array();

            // Boucle sur les résultats récupérés pour les transformer en objets Adopt
            foreach($arrAdoptAll as $arrAdoptDetAll){

                // Création d'un nouvel objet Adopt
                $objAdopt = new Adopt;

                // Hydratation de l'objet avec les données récupérées depuis la base
                $objAdopt->hydrate($arrAdoptDetAll);

                // Ajout de l'objet Adopt au tableau final
                $arrAdoptDisplay[] =  $objAdopt;
            }

            // Assignation des données transformées au tableau des données pour l'affichage
            $this->_arrData['arrAdoptAll'] = $arrAdoptDisplay;

            // Affichage de la page "demand_adopt_progress"
            $this->display("user/adopt/demand_adopt_progress");
        }

        /**
         * Méthode responsable de l'affichage de la page demand_adopt_progress_admin.
         * Permet d'afficher l'avancement des demandes d'adoption pour tous les utilisateurs
         * accessible uniquement aux administrateurs ou aux modérateurs.
         * Les données récupérées sont ensuite transmises à la vue pour affichage.
         */
        public function demand_adopt_progress_admin(){


            // Définition de la page actuelle pour l'affichage
            $this->_arrData['strPage'] = "demand_adopt_progress_admin";

            // Vérification de la session utilisateur et des droits d'accès
            // Si aucun utilisateur n'est connecté ou si l'utilisateur est de type "UC"
            // on le redirige vers la page de connexion
            if(!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')){
                header("Location:index.php?ctrl=user&action=login");
            }

            // Récupération de toutes les demandes d'adoption en cours pour tous les utilisateurs
            $arrAdoptAll = $this->_objAdoptModel->readAdoptProgressAll();

            // Tableau pour stocker les objets Adopt après hydratation
            $arrAdoptDisplay = array();

            // Boucle sur les résultats récupérés pour les transformer en objets Adopt
            foreach($arrAdoptAll as $arrAdoptDetAll){

                // Création d'un nouvel objet Adopt
                $objAdopt = new Adopt;

                // Hydratation de l'objet avec les données récupérées depuis la base
                $objAdopt->hydrate($arrAdoptDetAll);

                // Ajout de l'objet Adopt au tableau final
                $arrAdoptDisplay[] = $objAdopt;
            }

            // Assignation des données transformées au tableau des données pour l'affichage
            $this->_arrData['arrAdoptAll'] = $arrAdoptDisplay;

            // Affichage de la page "demand_adopt_progress_admin"
          
            $this->display("user/adopt/demand_adopt_progress");
        }     
               
        /**
         * Méthode responsable de l'affichage de la page demand_adopt_accept.
         * Permet d'afficher les demandes d'adoption acceptées pour l'utilisateur connecté.
         * Les données récupérées sont ensuite transmises à la vue pour affichage.
         */
        public function demand_adopt_accept(){

            // Définition de la page actuelle pour l'affichage
            $this->_arrData['strPage'] = "demand_adopt_accept";

            // Vérification de la session utilisateur
            // Si aucun utilisateur n'est connecté, on redirige vers la page de connexion
            if(!isset($_SESSION['user'])){
                header("Location:index.php?ctrl=user&action=login");
            }

            // Récupération de l'ID de l'utilisateur connecté depuis la session
            $userId = $_SESSION['user']->getId();

            // Récupération des demandes d'adoption acceptées pour l'utilisateur connecté
            $arrAdoptAll = $this->_objAdoptModel->readAdoptAccept($userId);

            // Tableau pour stocker les objets Adopt après hydratation
            $arrAdoptDisplay = array();

            // Boucle sur les résultats récupérés pour les transformer en objets Adopt
            foreach($arrAdoptAll as $arrAdoptDetAll){

                // Création d'un nouvel objet Adopt
                $objAdopt = new Adopt;

                // Hydratation de l'objet avec les données récupérées depuis la base
                $objAdopt->hydrate($arrAdoptDetAll);

                // Ajout de l'objet Adopt au tableau final
                $arrAdoptDisplay[] = $objAdopt;
            }

            // Assignation des données transformées au tableau des données pour l'affichage
            $this->_arrData['arrAdoptAll'] = $arrAdoptDisplay;

            // Affichage de la page "demand_adopt_accept"
            $this->display("user/adopt/demand_adopt_accept");
        }


           
        /**
         * Méthode responsable de l'affichage de la page demand_adopt_form.
         * Permet d'afficher le formulaire d'adoption.
         * Accessible uniquement aux utilisateurs connectés, administrateurs et aux modérateurs.
         * Les données récupérées sont ensuite transmises à la vue pour affichage.
         */
        public function demand_adopt_form(){

            // Variables fonctionnelles
            $this->_arrData['strPage']  = "demand_adopt_form";
            //Test si personne n'existe dans la session alors tu redirige
            if(!isset($_SESSION['user']) ){
            header("Location:index.php?ctrl=user&action=login");
            }


        //  $objDemmandAdopt = new Adopt;

            
        //     // Si le formulaire envoyer alors
        //     if (count($_POST) > 0){
        //         // On récupère les données du formulaire et on hydrate 
        //       $objDemmandAdopt->hydrate($_POST);
        //         if ($objDemmandAdopt->getName() == ""){
        //             $this->_arrErrors['name'] = "Le nom est obligatoire";
        //         }
        //         if ($objDemmandAdopt->getSurname() == ""){
        //             $this->_arrErrors['surname'] = "Le prénom est obligatoire";
        //         }
        //         // Vérifier le contenu du mail
        //         if ($objDemmandAdopt->getEmail() == ""){
        //             $this->_arrErrors['email'] = "L'adresse mail est obligatoire";
        //         }else if (!filter_var($objDemmandAdopt->getEmail(), FILTER_VALIDATE_EMAIL)) {
        //             $this->_arrErrors['email'] = "L'adresse mail n'est pas valide";
        //         }else if ($this->_objAdoptModel->userVerifEmail($objDemmandAdopt->getEmail(), $objDemmandAdopt->getId())){
        //             $this->_arrErrors['email'] = "L'adresse mail est déjà utilisée";
        //         }
      
                //Si pas d'erreur 
        //         if (count($this->_arrErrors) === 0){
        //             // Appel une méthode dans le modèle, avec en paramètre l'objet	
        //             $boolTrue = $this->_objAdoptModel->userAdd($objDemmandAdopt);
        //             // Informer l'utilisateur si insertion ok/pas ok 
        //             if ($boolTrue){
        //                 $this->_arrSuccess[] = "  L'utilisateur a été ajouté avec succès ! Veuillez vous connectez ";
        //             }else{
        //                 $this->_arrErrors[] = "L'insertion s'est mal passée";
        //             }
        //         }
        //     }
			//$this->_arrData['objUserAdd']	= $objDemmandAdopt;

            $this->display("user/adopt/demand_adopt_form");
        }

        /**
         * 
         * Méthode responsable de l'affichage de la page demand_adopt_accept_admin.
         * Permet d'afficher la liste des demandes d'adoption acceptées pour tous les utilisateurs.
         * Accessible uniquement aux administrateurs et aux modérateurs.
         * Les données récupérées sont ensuite transmises à la vue pour affichage.
         */
        public function demand_adopt_accept_admin(){

            // Définition de la page actuelle pour l'affichage
            $this->_arrData['strPage'] = "demand_adopt_accept_admin";

            // Vérification de la session utilisateur et des droits d'accès
            // Si aucun utilisateur n'est connecté ou si l'utilisateur est de type "UC" 
            // on le redirige vers la page de connexion
            if(!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')){
                header("Location:index.php?ctrl=user&action=login");
            }

            // Récupération de toutes les demandes d'adoption acceptées pour tous les utilisateurs
            $arrAdoptAll = $this->_objAdoptModel->readAdoptAcceptAll();

            // Tableau pour stocker les objets Adopt après hydratation
            $arrAdoptDisplay = array();

            // Boucle sur les résultats récupérés pour les transformer en objets Adopt
            foreach($arrAdoptAll as $arrAdoptDetAll){

                // Création d'un nouvel objet Adopt
                $objAdopt = new Adopt;

                // Hydratation de l'objet avec les données récupérées depuis la base
                $objAdopt->hydrate($arrAdoptDetAll);

                // Ajout de l'objet Adopt au tableau final
                $arrAdoptDisplay[] = $objAdopt;
            }

            // Assignation des données transformées au tableau des données pour l'affichage
            $this->_arrData['arrAdoptAll'] = $arrAdoptDisplay;

            // Affichage de la page "demand_adopt_accept_admin"
            $this->display("user/adopt/demand_adopt_accept");
        }

        /**
         * Méthode responsable de l'affichage de la page demand_adopt_refuse.
         * Permet d'afficher les demandes d'adoption refusées pour l'utilisateur connecté.
         * Les données récupérées sont ensuite transmises à la vue pour affichage.
         */
        public function demand_adopt_refuse(){

            // Définition de la page actuelle pour l'affichage
            $this->_arrData['strPage'] = "demand_adopt_refuse";

            // Vérification de la session utilisateur
            // Si aucun utilisateur n'est connecté, on redirige vers la page de connexion
            if(!isset($_SESSION['user'])){
                header("Location:index.php?ctrl=user&action=login");
            }

            // Récupération de l'ID de l'utilisateur connecté depuis la session
            $userId = $_SESSION['user']->getId();

            // Récupération des demandes d'adoption refusées pour l'utilisateur connecté
            $arrAdoptAll = $this->_objAdoptModel->readAdoptRefuse($userId);

            // Tableau pour stocker les objets Adopt après hydratation
            $arrAdoptDisplay = array();

            // Boucle sur les résultats récupérés pour les transformer en objets Adopt
            foreach($arrAdoptAll as $arrAdoptDetAll){

                // Création d'un nouvel objet Adopt
                $objAdopt = new Adopt;

                // Hydratation de l'objet avec les données récupérées depuis la base
                $objAdopt->hydrate($arrAdoptDetAll);

                // Ajout de l'objet Adopt au tableau final
                $arrAdoptDisplay[] = $objAdopt;
            }

            // Assignation des données transformées au tableau des données pour l'affichage
            $this->_arrData['arrAdoptAll'] = $arrAdoptDisplay;

            // Affichage de la page "demand_adopt_refuse"
            $this->display("user/adopt/demand_adopt_refuse");
        }

        /**
         * Méthode responsable de l'affichage de la page demand_adopt_refuse_admin.
         * Permet d'afficher la liste des demandes d'adoption refusées pour tous les utilisateurs.
         * Accessible uniquement aux administrateurs et aux modérateurs.
         * Les données récupérées sont ensuite transmises à la vue pour affichage.
         */
        public function demand_adopt_refuse_admin(){

            // Définition de la page actuelle pour l'affichage
            $this->_arrData['strPage'] = "demand_adopt_refuse_admin";

            // Vérification de la session utilisateur et des droits d'accès
            // Si aucun utilisateur n'est connecté ou si l'utilisateur est de type "UC"
            // on le redirige vers la page de connexion
            if(!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')){
                header("Location:index.php?ctrl=user&action=login");
            }

            // Récupération de toutes les demandes d'adoption refusées pour tous les utilisateurs
            $arrAdoptAll = $this->_objAdoptModel->readAdoptRefuseAll();

            // Tableau pour stocker les objets Adopt après hydratation
            $arrAdoptDisplay = array();

            // Boucle sur les résultats récupérés pour les transformer en objets Adopt
            foreach($arrAdoptAll as $arrAdoptDetAll){

                // Création d'un nouvel objet Adopt
                $objAdopt = new Adopt;

                // Hydratation de l'objet avec les données récupérées depuis la base
                $objAdopt->hydrate($arrAdoptDetAll);

                // Ajout de l'objet Adopt au tableau final
                $arrAdoptDisplay[] = $objAdopt;
            }

            // Assignation des données transformées au tableau des données pour l'affichage
            $this->_arrData['arrAdoptAll'] = $arrAdoptDisplay;

            // Affichage de la page "demand_adopt_refuse"
            $this->display("user/adopt/demand_adopt_refuse");
        }

            /**
             * Méthode responsable de l'affichage de la page demand_adopt_create.
             * Permet d'afficher la page permettant aux utilisateurs de faire une demande d'adoption.
             */
            public function demand_adopt_create(){

                // Définition de la page actuelle pour l'affichage
                $this->_arrData['strPage'] = "demand_adopt_create";

                // Affichage de la page "demand_adopt_create"
                $this->display("user/adopt/demand_adopt_create");
            }
    
    }

    
 
       
 