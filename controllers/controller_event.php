<?php

/**
* Classe du Ctrl événement
* @author Nabil
* @version 1.0
* @date 25/01/2025-15/02/2025
*/

	class EventCtrl extends MotherCtrl{// Je crée une classe qui hérite de MotherCtrl.
	//  Cela signifie qu'elle a accès aux propriétés et méthodes de MotherCtrl.
        private object $_objEventModel;//private signifie que cette propriété est accessible uniquement à l'intérieur de la classe.

		/*
		* Constructeur
		*/

		public function __construct(){
            // Variables fonctionnelles inclure les fichiers modèle et entité 
            require_once("models/model_event.php");
			//Inclut le fichier contenant la classe EventModel
            require_once("entities/entity_event.php");
			// Instancier
            $this->_objEventModel = new EventModel();
			parent::__construct();
			//:: l'operateur de résolution de pôrté appelle le constructeur de la classe MotherCtrl, permettant d'hériter des configurations ou fonctionnalités définies dans MotherCtrl.
		}

		/**
 		* Fonction qui gère l'affichage des événements sur la page home_event
 		*/
		public function home_event(){
			// Variables d'affichage
			$this->_arrData['strPage'] = "home_event"; 
			// instencie un tableau arrData permet d'etre ciblé par la function Display *
			// instancier  
			// Récupérer les événements depuis le modèle
			$arrEvent = $this->_objEventModel->findAll();// on instancie _objEventModel de l'entyti avec la methode findAll et on le stock dans le tableau $arrEvent
			// Vérification si des événements existent
			$arrEventDisplay = array();						

			// la variable $arrEventDisplay devien un tableau comme sont nom l'indique
				foreach ($arrEvent as $arrDetEvent){				

					$objEvent = new Event();						
					$objEvent->hydrate($arrDetEvent);						
					$arrEventDisplay[] = $objEvent;
				}
		// crée un tableau arrEvent = a la variable objet utiliser pour recuperation des donné BDD pour réutilisation
		$this->_arrData['arrEvent'] = $arrEventDisplay;
		// place les donné recuperé dans le tab arrEvent dans le tab _arrData tab en privete donc plus securisé, un truck comme sa 
		$this->display("event");
		// function de ciblage pour affichage
		}
		 
		/**
 		* Fonction qui gère l'affichage des événements sur la page add_event_admin
 		*/
		public function add_event_admin(){
			// Variable d'affichage
			$this->_arrData['strPage'] = "add_event_admin";

             // Vérification des droits d'accès : redirection si l'utilisateur n'est pas autorisé
             if (!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')) {
                header("Location:index.php?ctrl=error&action=error_403");
            }

			// Création d'un nouvel objet Evenement vide
			$objEvent = new Event();
			if(count($_POST) > 0){
			// Si le formulaire est envoyé
				$objEvent->hydrate($_POST);
				//Hydrate l'objet Event avec les nouvelles valeurs du formulaire.
				// Vérifications des champs obligatoires

				if ($objEvent->getName() == ""){
					$this->_arrErrors['event_name'] = "Le nom est obligatoire";
				}
				if ($objEvent->getDescription() == ""){
					$this->_arrErrors['event_description'] = "La description est obligatoire";
				}
				if ($objEvent->getDate() == ""){
					$this->_arrErrors['event_date'] = "La date est obligatoire";
				}

				// Gestion de l'image
                $arrImage = $_FILES['event_picture']??[];
				if (isset($arrImage['error']) && $arrImage['error'] == 4) {
					$this->_arrErrors['event_picture'] = "le fichier est obligatoire";
				}

				// Vérification du type et de la taille si aucune erreur Vérification du type MIME et de laimage
				if (!isset($this->_arrErrors['event_picture'])) {

					if (!in_array($arrImage['type'], ['image/jpeg', 'image/png'])) {
						$this->_arrErrors['event_picture'] = "Seules les images JPEG et PNG sont acceptées";
					} elseif ($arrImage['size'] > 200000 ) { // 2 Mo max
						$this->_arrErrors['event_picture'] = "L'image est trop lourde (max 2 Mo)";
					}
					$strSource = $arrImage['tmp_name'];
					$strFileName = bin2hex(random_bytes(10)) . ".webp";
					$strDest = "assets/images/event/" . $strFileName; // place l'image du dossier FILE dans image event
	
					list($intWidth, $intHeight) = getimagesize($strSource);
					$objDest = imagecreatetruecolor(500, 500);
					if ($arrImage['type'] === "image/jpeg") {
						$objSource = imagecreatefromjpeg($strSource);
					} elseif ($arrImage['type'] === "image/png") {
						$objSource = imagecreatefrompng($strSource);
					}
					imagecopyresampled($objDest, $objSource, 0, 0, 0, 0, 500, 500, $intWidth, $intHeight);
					imagewebp($objDest, $strDest);
					
					$objEvent->setPicture($strFileName);
				}// a decortiquer pour commantaire
				
				
				// Si aucune erreur, insertion de l'article en BDD
				if (empty($this->_arrErrors)){
					$boolOk = $this->_objEventModel->eventAdd($objEvent);
					// Dans le controlleur la function eventEdit() retourn un bool 
					if ($boolOk){
						$this->_arrSuccess[] = "Evenement créé avec succès !";
					} else {
						$this->_arrErrors[] = "Erreur lors de l'ajout de l'évenement";
					}
				}
			}
			
			$this->_arrData["objEvent"] = $objEvent ;
			// stock l'objet dans le tableau arrData ["objEvent"] est un nom arbitraire 
			$this->display("admin/event/add_event_admin");
            }    

			/**
			 *  Méthode d'afichage de tout les événement pour l'administration
			 *  Cette méthode :
			 * - Vérifie que l'utilisateur est connecté

			 * - Récupère tous les événement depuis la base de données
			 * - Crée des objets objEvent pour chaque évenement
			 * - Prépare les données pour l'affichage dans la vue list_event_admin
			*/

            public function list_event_admin(){

				// Vérification des droits d'accès : redirection si l'utilisateur n'est pas autorisé
				if (!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')) {
				header("Location:index.php?ctrl=error&action=error_403");
				}
                $this->_arrData['strPage'] = "list_event_admin";
 				// Récupérer les événements depuis le modèle
                $arrData	  = $this->_objEventModel->findAll();
                $arrEventDisplay  = array();
                foreach($arrData as $arrEventDetAll){ 
                        $objEvent = new Event;
                        $objEvent->hydrate($arrEventDetAll);
                        $arrEventDisplay[] =  $objEvent;
                }

                    $this->_arrData['arrEventAll'] = $arrEventDisplay;
                    $this->display("admin/event/list_event_admin"); 

            }

			/**
			* Méthode de suppression d'un  événement
			* Méthode gérant la suppression d'un événement par administrateur modérateur
			* 
			* Cette méthode :
			* - Vérifie que l'utilisateur est connecté
			* - Vérifie que l'utilisateur a le droit de supprimer ce témoignage (propriétaire ou admin)
			* - Récupère les données de l'événement existant
			* - Traite le formulaire de confirmation de suppression
			* - Vérifie que l'utilisateur a confirmé la suppression en tapant "SUPPRIMER"
			* - Supprime l'événement de la base de données
			* - Gère la redirection selon le type d'utilisateur
			* - Gère les messages de succès/erreur
				*/

			public function delete_event_admin(){
				$this->_arrData['strPage']      ="del_event_admin";

			// Vérification des droits d'accès : redirection si l'utilisateur n'est pas autorisé
			if (!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')) {
			header("Location:index.php?ctrl=error&action=error_403");
			}

			// Récupération de l'ID de l'évenement depuis la requête GET
			//$this->_arrData['id'] = $_GET['id'];



				/*
			* Récupération de l'ID de l'utilisateur connecté depuis la session
			*$userId = $_SESSION['user']->getId();
				}
				*/

					$objEventDel = new Event;
					$eventId = $_GET['id'];  
					
				if (count($_POST) > 0 ){ 
					if ($_POST['verifDelete'] != "SUPPRIMER") {
						$this->_arrErrors['verifDelete'] = "Taper SUPPRIMER  dans le champ de vérification pour confirmer la suppression";
					}                   
						// On récupère les données du formulaire et on hydrate
						$objEventDel->hydrate($_POST);
						$objEventDel->setId($eventId);
						if (count($this->_arrErrors) === 0){
							// Appel une méthode dans le modèle, avec en paramètre l'objet  
							$boolTrue = $this->_objEventModel->eventDel($objEventDel);
							// Informer l'utilisateur si insertion ok/pas ok
							if ($boolTrue){    
								header("Location:index.php?ctrl=event&action=list_event_admin");
								
							}else{
								
								$this->_arrErrors[] = "Les modifications ont échouées";
								
							}
						}                              		
				}
							$this->_arrData['objEventDel']     = $objEventDel;
							$this->display("admin/event/del_event_admin");
			}

	        
					/**
			 *  Méthode gérant l'affichage de tous les événement pour l'administration
			 *  Cette méthode :
			 * - Vérifie que l'utilisateur est connecté et a les droits d'administration
			 * - Récupère tous les événement depuis la base de données
			 * - Crée des objets Testify pour chaque témoignage
			 * - Prépare les données pour l'affichage dans la vue edit_event_admin
			 * 
					 */

			public function edit_event_admin(){

			// Variables fonctionnelles
			$this->_arrData['strPage']	= "edit_event_admin";
			//Test si personne n'existe dans la session alors tu redirige

             // Vérification des droits d'accès : redirection si l'utilisateur n'est pas autorisé
             if (!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')) {
                header("Location:index.php?ctrl=error&action=error_403");
            }

			// Récupération de l'ID de l'évenement depuis la requête GET
			$objEvent = new Event;



			   $eventId = $_GET['id'];  
			   $arrEvent = $this->_objEventModel->findOne($eventId); // je crée un tableau $arrEvent 
			   // (je l'instancie avec la classe de mon model pour lui donné acces a la methode de se dernier->findOneavec en parametre $evenId)
			   //j'ai ainsi un tableau aillant la capcitér de cherché dans ma BDD event toute les entrée corespondant à ID event
			   $objEvent = new Event;  // je crée objEvent 
			   $objEvent->hydrate($arrEvent); // mon objet hydrater a donc les meme capacité que mon tableau 
			  
		 
			   if (count($_POST) > 0){
				   // On récupère les données du formulaire et on hydrate 
				  
				  $objEvent->hydrate($_POST);// j'hydrate mon objet avec les donné POST il a donc maintenant les donné et la capacité de les traité
   
				  
				  // On récupere l'id de la session qu'on met dans l'objet (a voir si cest la soution mais ca marche)
				   $objEvent->setId($eventId);
				  if ($objEvent->getName() == ""){
				   $this->_arrErrors['name'] = "Le nom est obligatoire";
				  }

				  if ($objEvent->getDescription() == ""){
				   $this->_arrErrors['description'] = "La description est obligatoire";
				  }
					   $arrImage= $_FILES['picture']; // on utilise une variable pour éviter de rappeler le name de l'input
				   if ($arrImage['name'] != ""){
				   if ($arrImage['error'] == 4){
					   $this->_arrErrors['picture'] = "L'image est obligatoire";
				   }else{
					   if ($arrImage['error'] != 0){
						   $this->_arrErrors['picture'] = "Le fichier a rencontré un pb";
					   }elseif ($arrImage['type'] != 'image/jpeg'){
						   $this->_arrErrors['picture'] = "Uniquement les images jpeg sont acceptés";
					   }
				   }
		
				   if (!isset($this->_arrErrors['picture'])){
					   // fichier temporaire = source
					   $strSource		= $arrImage['tmp_name'];
					   // destination du fichier
					   $arrFileExplode	= explode(".", $arrImage['name']);
					   $strFileExt		= $arrFileExplode[count($arrFileExplode)-1];
					   $strFileName 	= bin2hex(random_bytes(10)).".webp";//.$strFileExt;
					   $strDest		= "assets/images/event/".$strFileName;
   
					   // Dimensions de mon image
					   list($intWidth, $intHeight) = getimagesize($strSource);
					   // Redimensionner
					   $objDest		= imagecreatetruecolor(340, 340); // vide;
					   $objSource		= imagecreatefromjpeg($strSource);
					   
					   imagecopyresized($objDest, $objSource, 0, 0, 0, 0, 340, 340, $intWidth, $intHeight);
					   imagewebp($objDest, $strDest);
					   $objEvent->setPicture($strFileName);
					   
					   }   
			   }        
			  
				   if (count($this->_arrErrors) === 0){
					  // Appel une méthode dans le modèle, avec en paramètre l'objet	
					  $boolOk = $this->_objEventModel->eventEdit($objEvent);//$boolOK est crée on lui donne la methode eventEdit avec en parmetre objet event 
					 
					  // Informer l'utilisateur si insertion ok/pas ok 
					  if ($boolOk){                        
					   $this->_arrSuccess[] = " Vos modifications on été ajouté avec succès !";
   
						//Rehydrater ici pour que l'affichage soit directement a jour a voir si c'est la solution mais ca marche 
						//$arrEvent = $this->_objEventModel->findOne($eventId);
				   		$objEvent->hydrate($arrEvent);
						  
				   }else{
					   $this->_arrErrors[] = "Les modifications ont échouées";
		  
					  } 
				  } 
				  
			   }  
	 
			$this->_arrData['objEvent']	        = $objEvent; 
			 $this->_arrData['arrEvent']	        = $arrEvent;  
			  $this->display("admin/event/edit_event_admin");
   
			  
		   
		   
		   }
	
}
	
        ?>