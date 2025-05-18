<?php 
    /**
	* Controller de la class AnimalCtrl
	* @author Fabrice
	* @version 1.0
	* @date 19/01/2025-15/02/2025
	*/

    class AnimalCtrl extends MotherCtrl {
        // Déclaration d'un attribut privé pour stocker une instance du modèle AnimalModel
        private object $_objAnimalModel;
    
        /**
		* Constructeur de la classe
		*/
        public function __construct() {

            // Inclusion du fichier du modèle AnimalModel
            require_once("models/model_animal.php");
            
            // Inclusion du fichier de l'entité Animal 
            require_once("entities/entity_animal.php");
    
            // Inclusion de l'autoloader de Composer (permet de charger automatiquement les classes nécessaires)
            require_once("vendor/autoload.php");
    
            // Instanciation du modèle AnimalModel pour interagir avec la base de données
            $this->_objAnimalModel = new AnimalModel();
        }
  
        /**
         * Méthode responsable de l'affichage de la page d'accueil.
         * Récupère une liste d'animaux depuis le modèle, les hydrate en objets,
         * puis transmet les données à la vue pour affichage.
         */
        public function home() {
            // Définition de la page actuelle pour l'affichage
            $this->_arrData['strPage'] = "accueil";
            // Inclusion du fichier du modèle EventModel
            require_once("models/model_event.php");
            
            // Inclusion du fichier de l'entité Evenement 
            require_once("entities/entity_event.php");
            // Récupération des données des animaux en appelant la méthode findAll du modèle
            // Ici, la valeur "3" représente une limite de résultats 
            $arrAnimals = $this->_objAnimalModel->findAll(3);

            // Tableau destiné à contenir les objets Animaux hydratés
            $arrAnimalsDisplay = array();

            // Parcours des résultats obtenus depuis le modèle
            foreach ($arrAnimals as $arrDetAnimals) {
                // Création d'une nouvelle instance de l'entité Animal
                $objAnimals = new Animal();
                
                // Hydratation de l'objet Animal avec les données récupérées
                $objAnimals->hydrate($arrDetAnimals);
                
                // Ajout de l'objet hydraté dans le tableau d'affichage
                $arrAnimalsDisplay[] = $objAnimals;
            }


            // Récupération et hydratation pour affichage des refuges
			$objEventModel = new EventModel();
			$arrEventAll = $objEventModel->findAll();
			$arrEventAllDisplay = array();
			foreach($arrEventAll as $arrDetEventAll) {		
				$objEvent = new Event();
				$objEvent->hydrate($arrDetEventAll);
				$arrEventAllDisplay[] = $objEvent;			
			}
            
            $this->_arrData['objEventModel'] = $objEventModel;

            $this->_arrData['arrEventAll'] = $arrEventAllDisplay;

            // Stockage du tableau d'animaux hydratés pour l'affichage dans la vue
            $this->_arrData['arrAnimals'] = $arrAnimalsDisplay;

            // Appel de la méthode display pour afficher la page d'accueil
            $this->display("accueil");
        }

        /**
         * Méthode permettant d'afficher et de gérer l'édition du carrousel d'images d'un animal.
         * Cette fonction gère la récupération des images existantes, le contrôle du quota d'images,
         * l'upload de nouvelles images avec vérifications et le redimensionnement avant insertion en base.
         */
        public function edit_animal_caroussel() {

            // Définition de la page actuelle pour l'affichage
            $this->_arrData['strPage'] = "edit_animal_caroussel";
             // Vérification des droits d'accès : redirection si l'utilisateur n'est pas autorisé
             if (!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')) {
                header("Location:index.php?ctrl=error&action=error_403");
            }

            // Récupération de l'ID de l'animal depuis la requête GET
            $this->_arrData['id'] = $_GET['id'];

            // Récupération des images associées à l'animal
            $arrPicture = $this->_objAnimalModel->findPicture($_GET['id']);
            $objPicture = new Animal;
            $this->_arrData['arrPicture'] = $arrPicture;

            // Vérification du nombre d'images déjà associées à cet animal
            $countPic = $this->_objAnimalModel->CountPicture($_GET['id']);
            $nombreImages = intval($countPic['count_pic_id']);

            // Si le quota d'images (20) est atteint, afficher une erreur
            if ($nombreImages > 19) {  
                $this->_arrErrors['count'] = "Quota d'images fixé à 20, AJOUT IMPOSSIBLE"; 
            } else {
                // Vérification si un fichier image a été soumis
                if (isset($_FILES['image']) && $_FILES['image'] != "") {
                    $arrImage = $_FILES['image']; 

                    // Vérification des erreurs liées à l'upload
                    if ($arrImage['error'] == 4) {
                        $this->_arrErrors['image'] = "L'image est obligatoire";
                    } else {
                        if ($arrImage['error'] != 0) {
                            $this->_arrErrors['image'] = "Le fichier a rencontré un problème";
                        } elseif ($arrImage['type'] != 'image/jpeg') {
                            $this->_arrErrors['image'] = "Uniquement les images JPEG sont acceptées";
                        }
                    }

                    // Si aucune erreur, traitement et redimensionnement de l'image
                    if (!isset($this->_arrErrors['image'])) {
                        // Récupération du chemin temporaire de l'image
                        $strSource = $arrImage['tmp_name'];
                        
                        // Génération d'un nom de fichier unique
                        $arrFileExplode = explode(".", $arrImage['name']);
                        $strFileExt = $arrFileExplode[count($arrFileExplode) - 1];
                        $strFileName = bin2hex(random_bytes(10)) . ".webp";
                        $strDest = "assets/images/animal/gallery/" . $strFileName;

                        // Récupération des dimensions de l'image originale
                        list($intWidth, $intHeight) = getimagesize($strSource);

                        // Création d'une image redimensionnée (500x500 px)
                        $objDest = imagecreatetruecolor(500, 500);
                        $objSource = imagecreatefromjpeg($strSource);

                        imagecopyresized($objDest, $objSource, 0, 0, 0, 0, 500, 500, $intWidth, $intHeight);
                        imagewebp($objDest, $strDest);

                        // Mise à jour de l'objet Picture avec les nouvelles informations
                        $objPicture->setPic_picture($strFileName);
                        $objPicture->setId($_GET['id']);

                    }

                    // Si aucune erreur détectée, ajout de l'image à la base de données
                    if (count($this->_arrErrors) === 0) {
                        $boolOk = $this->_objAnimalModel->animalPictureCarousselAdd($objPicture);

                        // Vérification du succès de l'insertion
                        if ($boolOk) {                        
                            $this->_arrSuccess[] = "L'image a été ajoutée avec succès !";
                        } else {
                            $this->_arrErrors[] = "L'ajout de l'image a échoué";
                        }
                    }
                }
            }

            // Récupération et hydratation des images pour l'affichage
            $arrPicture = $this->_objAnimalModel->findPicture($_GET['id']);
            $arrPictureDisplay = array();

            foreach ($arrPicture as $keys => $arrDetPicture) {            
                $objPicture = new Animal; 
                $objPicture->hydrate($arrDetPicture); 
                $arrPictureDisplay[] = $objPicture;
            }

            // Stockage des objets pour l'affichage dans la vue
            $this->_arrData['objPicture'] = $objPicture;
            $this->_arrData['arrPicture'] = $arrPictureDisplay;

            // Affichage de la page d'édition du carrousel
            $this->display("admin/animal/edit_animal_caroussel");
        }
       

                          
        /**
         * Méthode permettant de supprimer une image du carrousel d'un animal.
         * Vérifie si l'utilisateur est connecté et autorisé, demande confirmation,
         * puis effectue la suppression si validée.
         */
        public function delete_picture_caroussel_admin() {
            // Définition de la page actuelle pour l'affichage
            $this->_arrData['strPage'] = "delete_picture_caroussel_admin";

            // Vérification des droits d'accès : redirection si l'utilisateur n'est pas autorisé
            if (!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')) {
                header("Location:index.php?ctrl=error&action=error_403");
            }

            // Initialisation de l'objet Picture et récupération de l'ID de l'image à supprimer
            $objPictureDel = new Animal;
            $pictureid = $_GET['id'];  
            
            // Vérification si un formulaire a été soumis
            if (count($_POST) > 0) { 
                // Vérification de la confirmation de suppression
                if ($_POST['verifDelete'] != "SUPPRIMER") {
                    $this->_arrErrors['verifDelete'] = "Taper SUPPRIMER dans le champ de vérification pour confirmer la suppression";
                }                 
                
                // Hydratation de l'objet avec les données du formulaire
                $objPictureDel->hydrate($_POST);
                $objPictureDel->setPic_id($pictureid);
                
                // Vérification des erreurs avant suppression
                if (count($this->_arrErrors) === 0) {
                    // Suppression de l'image dans la base de données
                    $boolTrue = $this->_objAnimalModel->pictureCarousselDel($objPictureDel);

                    // Vérification du succès de la suppression
                    if ($boolTrue) {    
                        header("Location:index.php?ctrl=animal&action=list_animal_admin");
                    } else {
                        $this->_arrErrors[] = "Les modifications ont échoué";
                    }
                }                               
            }
            
            // Passage des données à la vue
            $this->_arrData['objPictureDel'] = $objPictureDel;
            $this->display("admin/animal/delete_picture_caroussel_admin");
        }

         /**
         * Méthode permettant d'afficher et de gérer l'ajout d'un animal.
         * Cette fonction gère la vérification des droits d'accès, la récupération des races disponibles,
         * la validation des champs obligatoires, l'upload et le redimensionnement d'une image avant insertion.
         */
        public function add_animal_admin(){
            // Définition de la page actuelle pour l'affichage
            $this->_arrData['strPage'] = "add_animal_admin";

            // Vérification des droits d'accès (seuls les administrateurs peuvent accéder)
            if(!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')){
                header("Location:index.php?ctrl=error&action=error_403");
            }

            // Création d'un nouvel objet Animal
            $objAnimalAdd = new Animal;

            // Récupération des races disponibles pour l'affichage
            $this->_arrData['arrBreed'] = $this->_objAnimalModel->findBreed();
            $this->_arrData['objAnimalAdd'] = $objAnimalAdd;

            // Vérification si un formulaire a été soumis
            if (count($_POST) > 0){
                // Hydratation de l'objet avec les données du formulaire
                $objAnimalAdd->hydrate($_POST);

                // Vérification des champs obligatoires
                if ($objAnimalAdd->getName() == ""){
                    $this->_arrErrors['name'] = "Le nom est obligatoire";
                }
                if ($objAnimalAdd->getStatus() == ""){
                    $this->_arrErrors['status'] = "Le statut est obligatoire";
                }
                if ($objAnimalAdd->getRefuge_id() == ""){
                    $this->_arrErrors['refuge_id'] = "Le refuge est obligatoire";
                }
                if ($objAnimalAdd->getSexe() == ""){
                    $this->_arrErrors['sexe'] = "Le sexe est obligatoire";
                }
                if ($objAnimalAdd->getDate_birth() == ""){
                    $this->_arrErrors['date_birth'] = "La date de naissance est obligatoire";
                }
                if ($objAnimalAdd->getDescription() == ""){
                    $this->_arrErrors['description'] = "La description est obligatoire";
                }
                if ($objAnimalAdd->getCompatibility_animals() == "") {
                    $this->_arrErrors['compatibility_animals'] = "La compatibilité animal est obligatoire";
                }
                if ($objAnimalAdd->getCompatibility_children() == "") {
                    $this->_arrErrors['compatibility_childrens'] = "La compatibilité enfant est obligatoire";
                }
                if ($objAnimalAdd->getbreed_id() == "") {
                    $this->_arrErrors['breed_id'] = "La race est obligatoire";
                }
                $objAnimalAdd->getbreed_name();

                // Récupération du fichier image soumis
                $arrImage = $_FILES['image'];

                // Vérification de l'upload de l'image
                if ($arrImage['error'] == 4){
                    $this->_arrErrors['image'] = "L'image est obligatoire";
                } else {
                    if ($arrImage['error'] != 0){
                        $this->_arrErrors['image'] = "Le fichier a rencontré un problème";
                    } elseif ($arrImage['type'] != 'image/jpeg'){
                        $this->_arrErrors['image'] = "Uniquement les images JPEG sont acceptées";
                    }
                }

                // Si aucune erreur d'image, traitement et redimensionnement
                if (!isset($this->_arrErrors['image'])){
                    // Chemin temporaire de l'image
                    $strSource = $arrImage['tmp_name'];
                    
                    // Génération d'un nom de fichier unique en WebP
                    $arrFileExplode = explode(".", $arrImage['name']);
                    $strFileExt = $arrFileExplode[count($arrFileExplode)-1];
                    $strFileName = bin2hex(random_bytes(10)) . ".webp";
                    $strDest = "assets/images/animal/card/" . $strFileName;

                    // Récupération des dimensions de l'image originale
                    list($intWidth, $intHeight) = getimagesize($strSource);

                    // Création d'une image redimensionnée (500x500 px)
                    $objDest = imagecreatetruecolor(500, 500);
                    $objSource = imagecreatefromjpeg($strSource);
                    imagecopyresized($objDest, $objSource, 0, 0, 0, 0, 500, 500, $intWidth, $intHeight);
                    imagewebp($objDest, $strDest);
                    $objAnimalAdd->setPicture($strFileName);
                }

                // Si aucune erreur détectée, ajout de l'animal en base de données
                if (count($this->_arrErrors) === 0){
                    $boolOk = $this->_objAnimalModel->animalAdd($objAnimalAdd);

                    // Vérification du succès de l'insertion
                    if ($boolOk){
                        $this->_arrSuccess[] = "L'animal a été ajouté avec succès !";
                    } else {
                        $this->_arrErrors[] = "L'ajout de l'animal a échoué";
                    }
                }
            }

            // Récupération des races pour affichage
            $arrAddAnimalAdmin = $this->_objAnimalModel->findBreed();
            $arrAnimalsDisplay = array();
            
            foreach ($arrAddAnimalAdmin as $arrDetAddAnimalAdmin){
                $objAnimals = new Animal();
                $objAnimals->hydrate($arrDetAddAnimalAdmin);
                $arrAnimalsDisplay[] = $objAnimals;
            }
            
            // Stockage des objets pour affichage
            $this->_arrData['arrBreed'] = $this->_objAnimalModel->findBreed();
            $this->_arrData['arrAddAnimalAdmin'] = $arrAnimalsDisplay;
            $this->_arrData['objAnimalAdd'] = $objAnimalAdd;

            // Affichage de la page d'ajout d'un animal
            $this->display("admin/animal/add_animal_admin");
        }


        /**
        * Méthode de suppression d'un  animal
        */
        public function delete_animal_admin(){
            $this->_arrData['strPage']      ="delete_animal_admin";


        //Test si personne n'existe dans la session alors tu redirige
        if(!isset($_SESSION['user'])|| ($_SESSION['user']->getType() == 'UC')){
            header("Location:index.php?ctrl=error&action=error_403");
        }

                $objAnimalDlt = new Animal;
                $animalid = $_GET['id'];  
                
            if (count($_POST) >0 ){ 
                if ($_POST['verifDelete'] != "SUPPRIMER") {
                    $this->_arrErrors['verifDelete'] = "Taper SUPPRIMER  dans le champ de vérification pour confirmer la suppression";
                }                 
                //var_dump($animalid);   
                    // On récupère les données du formulaire et on hydrate
                    $objAnimalDlt->hydrate($_POST);
                    $objAnimalDlt->setId($animalid);
                var_dump($_POST);
                    if (count($this->_arrErrors) === 0){
                var_dump($this->_arrErrors);
                        // Appel une méthode dans le modèle, avec en paramètre l'objet  
                        $boolTrue = $this->_objAnimalModel->animalDel($objAnimalDlt);
                //var_dump($boolTrue); 
                        // Informer l'utilisateur si insertion ok/pas ok
                        if ($boolTrue){    
                            header("Location:index.php?ctrl=animal&action=list_animal_admin");
                            
                        }else{
                            
                            $this->_arrErrors[] = "Les modifications ont échouées";
                            
                        }
                    }                              
                                        
            }            // Stockage des objets pour affichage
                        $this->_arrData['objAnimalDlt']     = $objAnimalDlt;
                        // Affichage de la page delete_animal_admin
                        $this->display("admin/animal/delete_animal_admin");
            
        }
                            
        /**
         * Méthode permettant d'afficher la liste des animaux.
         * Cette méthode gère la recherche par mot clé, par catégorie
         */
        public function list_animal(){
    
            // Variables d'affichage
            // Assigner la page à afficher pour le rendu à "list_animal"
            $this->_arrData['strPage']  = "list_animal";
        
            // Récupération des données du formulaire via la méthode POST
            // On utilise l'opérateur de fusion null (??) pour attribuer une valeur par défaut si la donnée est absente
            $this->_objAnimalModel->strKeywords = $_POST['keywords'] ?? "";  // Récupère les mots-clés de recherche
            $this->_objAnimalModel->strDate = $_POST['date'] ?? "";  // Récupère la date filtrée
            $this->_objAnimalModel->strtSize = $_POST['size'] ?? "";  // Récupère la taille filtrée
            $this->_objAnimalModel->strRaces = $_POST['races'] ?? "";  // Récupère la race filtrée
            $this->_objAnimalModel->strSpec = $_POST['specie'] ?? "";  // Récupère l'espèce filtrée
            $this->_objAnimalModel->strRef = $_POST['refuge'] ?? "";  // Récupère le refuge filtré
            $this->_objAnimalModel->strSexe = $_POST['sexe'] ?? "";  // Récupère le sexe filtré
            $this->_objAnimalModel->intCategoryId = $_GET['id'] ?? 0;  // Récupère l'ID de la catégorie via la méthode GET (par défaut 0 si absent)
        
            // Affectation de l'objet AnimalModel aux données pour l'utiliser dans la vue
            $this->_arrData['objAnimalsModel'] = $this->_objAnimalModel;
            
            // Récupération des données supplémentaires nécessaires pour la vue
            $this->_arrData['arrCategory'] = $this->_objAnimalModel->findCategory();  // Catégories des animaux
            $this->_arrData['arrRefuge'] = $this->_objAnimalModel->findRefuge();  // Refuges disponibles
            $this->_arrData['arrSpecie'] = $this->_objAnimalModel->findSpecie();  // Espèces d'animaux
            $this->_arrData['arrBreed'] = $this->_objAnimalModel->findBreed();  // Races d'animaux
        
            // Traitement et préparation des animaux à afficher
            // On récupère la liste des animaux à afficher à partir de la méthode findAll()
            $arrAnimals = $this->_objAnimalModel->findAll();
            
            // Tableau pour stocker les objets Animal
            $arrAnimalsDisplay = array();
        
            // Boucle pour transformer chaque tableau d'animaux en objets Animal
            foreach ($arrAnimals as $arrDetAnimals){
                $objAnimals = new Animal();  // Création d'un nouvel objet Animal
                $objAnimals->hydrate($arrDetAnimals);  // Hydratation de l'objet avec les données récupérées
                $arrAnimalsDisplay[] = $objAnimals;  // Ajout de l'animal hydraté au tableau des animaux à afficher
            }
        
            // Affectation du tableau des animaux à la vue
            $this->_arrData['arrAnimals'] = $arrAnimalsDisplay;
        
            // Affichage de la page avec le nom "list_animal"
            $this->display("list_animal");
        }

        /**
         * Méthode permettant d'afficher le détail de l'animal.
         * Cette méthode affiche un caroussel d'image  lié a l'animal ainsi que ces caractéristique.
         */
        public function details_animal(){
           
            // Définir la page à afficher pour le rendu comme "details_animal"
            $this->_arrData['strPage']  = "details_animal";
        
            // Récupération de l'ID de l'animal 
            $this->_arrData['id'] = $_GET['id'];
        
            // Recherche de l'animal correspondant à l'ID 
            $arrAnimal = $this->_objAnimalModel->findOne($_GET['id']);
        
            // Initialisation d'un objet Animal
            $objAnimals = new Animal;
            // Hydrater l'objet avec les données de l'animal
            $objAnimals->hydrate($arrAnimal);  
            // Récupération des images associées à l'animal à partir de la méthode findPicture()
            $arrPicture = $this->_objAnimalModel->findPicture($_GET['id']);
            if ($arrPicture != null) {
            // Initialisation du tableau pour stocker les objets Image
            $arrPictureDisplay = array();  
        
            // Boucle pour transformer chaque image en objet et ajouter à la liste à afficher
            foreach ($arrPicture as $keys => $arrDetPicture) {
                // Création d'un nouvel objet Image pour chaque image
                $objPicture = new Animal;
                // Hydratation de l'objet image avec les données de l'image
                $objPicture->hydrate($arrDetPicture);
                 // Ajout de l'image à la liste des images à afficher
                $arrPictureDisplay[] = $objPicture; 
            }
            // Affectation des objets Animal et Image à la vue
            $this->_arrData['objPicture'] = $objPicture; 
            $this->_arrData['arrPicture'] = $arrPictureDisplay; 
        } 
            $this->_arrData['objAnimals'] = $objAnimals; 
        
            // Affichage de la page "details_animal"
            $this->display("details_animal");
        }

        /**
         * Méthode permettant la modification de l'animal.
         * Cette méthode sert a modifier l'image  lié a l'animal ainsi que ces caractéristique (status, sexe, disponibilité, etc...).
         */
        public function edit_animal(){
            
            // Variables d'affichage
            $this->_arrData['strPage'] = "edit_animal";

            // Test pour vérifier si l'utilisateur est connecté et s'il n'est pas de type 'UC' 
            if (!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')){
                header("Location:index.php?ctrl=error&action=error_403");
            }

            // Récupération de l'ID de l'animal 
            $animalId = $_GET['id'];  
            // Récupération des données de l'animal 
            $arrAnimal = $this->_objAnimalModel->findAnimalOneAdmin($animalId);
            // Création d'un objet Animal et hydratation avec les données récupérées
            $objAnimal = new Animal;  
            $objAnimal->hydrate($arrAnimal);
            
            // Vérification si le formulaire possede des données
            if (count($_POST) > 0){
                // Hydrate l'objet Animal avec les données du formulaire
                $objAnimal->hydrate($_POST);

                // On récupère l'ID de l'animal à modifier et on l'ajoute à l'objet
                $objAnimal->setId($animalId);

                // Validation des champs du formulaire
                if ($objAnimal->getName() == ""){
                    $this->_arrErrors['name'] = "Le nom est obligatoire";
                }
                if ($objAnimal->getStatus() == ""){
                    $this->_arrErrors['status'] = "Le status est obligatoire";
                }
                if ($objAnimal->getRefuge_id() == ""){
                    $this->_arrErrors['refuge_id'] = "Le refuge est obligatoire";
                } 
                if ($objAnimal->getSexe() == ""){
                    $this->_arrErrors['sexe'] = "Le sexe est obligatoire";
                }
                if ($objAnimal->getDescription() == ""){
                    $this->_arrErrors['description'] = "La description est obligatoire";
                }
                if ($objAnimal->getCompatibility_animals() == ""){
                    $this->_arrErrors['compatibility_animals'] = "La compatibilité animaux est obligatoire";
                }
                if ($objAnimal->getCompatibility_children() == ""){
                    $this->_arrErrors['compatibility_childrens'] = "La compatibilité enfants est obligatoire";
                }
                if ($objAnimal->getBreed_id() == ""){
                    $this->_arrErrors['breed_id'] = "La race est obligatoire";
                }
           
                $objAnimal->getBreed_name();

                // Gestion de l'image envoyée par le formulaire
                $arrImage = $_FILES['image']; // on utilise une variable pour éviter de rappeler le name de l'input
                if ($arrImage['name'] != ""){
                    // Si aucun fichier n'est envoyé, on affiche une erreur
                    if ($arrImage['error'] == 4){
                        $this->_arrErrors['image'] = "L'image est obligatoire";
                    } else {
                        // Vérification des erreurs de téléchargement du fichier
                        if ($arrImage['error'] != 0){
                            $this->_arrErrors['image'] = "Le fichier a rencontré un problème";
                        } elseif ($arrImage['type'] != 'image/jpeg'){
                            // Vérification que le fichier soit une image JPEG
                            $this->_arrErrors['image'] = "Uniquement les images JPEG sont acceptées";
                        }
                    }

                    // Si aucune erreur n'a été trouvée sur l'image, on procède à son traitement
                    if (!isset($this->_arrErrors['image'])){
                        // Récupération du fichier source (temporaire)
                        $strSource = $arrImage['tmp_name'];
                        // Récupération de l'extension du fichier pour le traitement
                        $arrFileExplode = explode(".", $arrImage['name']);
                        $strFileExt = $arrFileExplode[count($arrFileExplode) - 1];
                        $strFileName = bin2hex(random_bytes(10)) . ".webp"; // Génération d'un nom de fichier unique
                        $strDest = "assets/images/animal/card/" . $strFileName; // Destination du fichier

                        // Récupération des dimensions de l'image
                        list($intWidth, $intHeight) = getimagesize($strSource);
                        // Création d'une nouvelle image redimensionnée
                        $objDest = imagecreatetruecolor(500, 500); // Image vide avec les nouvelles dimensions
                        $objSource = imagecreatefromjpeg($strSource); // Création de l'image à partir du fichier source
                        imagecopyresized($objDest, $objSource, 0, 0, 0, 0, 500, 500, $intWidth, $intHeight); // Redimensionnement
                        imagewebp($objDest, $strDest); // Sauvegarde de l'image au format WebP

                        // On met à jour l'objet Animal avec le nom du fichier image
                        $objAnimal->setPicture($strFileName);
                    }
                }
                
                // Si aucune erreur n'a été trouvée, on procède à l'enregistrement des modifications
                if (count($this->_arrErrors) === 0){
                    // Appel à la méthode pour mettre à jour l'animal dans la base de données
                    $boolOk = $this->_objAnimalModel->animalUpd($objAnimal);
                   

                    // Si la mise à jour a réussi
                    if ($boolOk){
                        $this->_arrSuccess[] = "Vos modifications ont été ajoutées avec succès !";

                        // Réhydratation de l'objet animal pour mettre à jour les données dans l'affichage
                        $arrAnimal = $this->_objAnimalModel->findAnimalOneAdmin($animalId);
                        $objAnimal->hydrate($arrAnimal);
                    } else {
                        // Si la mise à jour échoue
                        $this->_arrErrors[] = "Les modifications ont échoué";
                    }
                }
            }
                
                 
            

            // Passer les données de l'animal à la vue
           
            $this->_arrData['arrBreed'] = $this->_objAnimalModel->findBreed();
            $this->_arrData['objAnimal'] = $objAnimal;
            $this->_arrData['arrAnimal'] = $arrAnimal;

            // Affichage de la page
            $this->display("admin/animal/edit_animal");
        }

        /**
         * Méthode permettant d'afficher la list_animal_admin.
         * Cette méthode sert a afficher la liste des animaux pour l'admin et redirige (suivant le choix) vers la modification ou la suppression de l'animal.
         */
        public function list_animal_admin(){
            // Variables d'affichage
            $this->_arrData['strPage'] = "list_animal_admin";

             // Test pour vérifier si l'utilisateur est connecté et s'il n'est pas de type 'UC' 
             if (!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')){
                header("Location:index.php?ctrl=error&action=error_403");
            }

            // Récupération des données des animaux 
            $arrFindAnimalAdmin = $this->_objAnimalModel->findAnimalAdmin();
            
            // Initialisation d'un tableau pour stocker les objets Animal hydratés
            $arrAnimalsDisplay = array();

            // Boucle pour traiter chaque animal récupéré et créer un objet Animal pour chaque entrée
            foreach ($arrFindAnimalAdmin as $arrDetFindAnimalAdmin){
                // Création d'un nouvel objet Animal
                $objAnimals = new Animal();
                // Hydratation de l'objet Animal avec les données de l'animal
                $objAnimals->hydrate($arrDetFindAnimalAdmin);
                // Ajout de l'animal hydraté dans le tableau d'animaux à afficher
                $arrAnimalsDisplay[] = $objAnimals;
            }

            // Passer les animaux à afficher à la vue
            $this->_arrData['arrFindAnimalAdmin'] = $arrAnimalsDisplay;

            // Affichage de la page list_animal_admin
            $this->display("admin/animal/list_animal_admin");
        }     
    }	  