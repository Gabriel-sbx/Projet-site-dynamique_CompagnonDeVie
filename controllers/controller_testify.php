<?php
/**
* Classe du Ctrl TestifyCtrl
* @author Soubeyroux Gabriel
* @version 1.0
* @date 25/01/2025-15/02/2025
*/
	
	class TestifyCtrl extends MotherCtrl{
		// Déclaration d'un attribut privé pour stocker une instance du modèle TestifyModel
		private object $_objTestifyModel;
		/**
		* Constructeur
		*/
		public function __construct(){
			// inclure les fichiers modèle et entité 
			require_once("models/model_testify.php");
			require_once("entities/entity_testify.php");
			// instancier
			$this->_objTestifyModel = new TestifyModel();
			parent::__construct();
		}
		/**
		 * Méthode gérant l'affichage des témoignages sur la page principale des témoignages
		 * 
		 * Cette méthode :
		 * - Définit la page courante comme "testify"
		 * - Récupère tous les témoignages validés depuis la base de données
		 * - Crée des objets Testify pour chaque témoignage
		 * - Prépare les données pour l'affichage dans la vue testify
		 * 
		*/
		public function home_testify() {
			// Définition de l'identifiant de la page courante
			$this->_arrData['strPage'] = "testify";

			// Récupération de tous les témoignages depuis la base de données
			$arrTestify = $this->_objTestifyModel->readTestify();
			
			// Création d'un tableau pour stocker les objets Testify
			$arrTestifyDisplay = array();
			
			// Pour chaque témoignage récupéré de la base de données
			foreach ($arrTestify as $arrDetTestify) {
				// Création d'un nouvel objet Testify
				$objTestify = new Testify();
				// Hydratation de l'objet avec les données du témoignage
				$objTestify->hydrate($arrDetTestify);
				// Ajout de l'objet au tableau d'affichage
				$arrTestifyDisplay[] = $objTestify;
			}

			// Transmission du tableau des témoignages à la vue
			$this->_arrData['arrTestify'] = $arrTestifyDisplay;

			// Affichage de la vue des témoignages
			$this->display("testify");
		}
		
		/**
		 * Méthode gérant l'affichage des témoignages d'un utilisateur dans son profil
		 * 
		 * Cette méthode :
		 * - Vérifie que l'utilisateur est connecté
		 * - Récupère l'ID de l'utilisateur depuis la session
		 * - Récupère tous les témoignages de cet utilisateur depuis la base de données
		 * - Crée des objets Testify pour chaque témoignage
		 * - Prépare les données pour l'affichage dans la vue list_testify_profil
		 * 
		 		 */
		public function list_testify_profil() {
			// Définition de l'identifiant de la page courante
			$this->_arrData['strPage'] = "list_testify_profil";

			// Redirection vers la page de connexion si l'utilisateur n'est pas connecté
			if (!isset($_SESSION['user'])) {
				header("Location:index.php?ctrl=user&action=login");
			}

			// Récupération de l'ID de l'utilisateur connecté depuis la session
			$userId = $_SESSION['user']->getId();

			// Récupération de tous les témoignages de l'utilisateur depuis la base de données
			$arrTestify = $this->_objTestifyModel->readTestifyOneUser($userId);
			
			// Création d'un tableau pour stocker les objets Testify
			$arrTestifyDisplay = array();
			
			// Pour chaque témoignage récupéré de la base de données
			foreach ($arrTestify as $arrDetTestify) {
				// Création d'un nouvel objet Testify
				$objTestify = new Testify();
				// Hydratation de l'objet avec les données du témoignage
				$objTestify->hydrate($arrDetTestify);
				// Ajout de l'objet au tableau d'affichage
				$arrTestifyDisplay[] = $objTestify;
			}

			// Transmission du tableau des témoignages à la vue
			$this->_arrData['arrTestify'] = $arrTestifyDisplay;

			// Affichage de la vue des témoignages dans le profil utilisateur
			$this->display("user/testify/list_testify_profil");
		}
		
		/**
		 * Méthode gérant l'ajout d'un témoignage par un utilisateur
		 * 
		 * Cette méthode :
		 * - Vérifie que l'utilisateur est connecté
		 * - Traite le formulaire d'ajout de témoignage
		 * - Valide les champs requis (titre, description)
		 * - Gère l'upload et le traitement de l'image
		 * - Crée le nouveau témoignage dans la base de données
		 * - Gère les messages de succès/erreur
		 * 
		 		 */
		public function add_testify_profil() {
			// Définition de l'identifiant de la page courante
			$this->_arrData['strPage'] = "add_testify_profil";

			// Redirection vers la page de connexion si l'utilisateur n'est pas connecté
			if (!isset($_SESSION['user'])) {
				header("Location:index.php?ctrl=user&action=login");
			}

			// Récupération de l'ID de l'utilisateur connecté
			$userId = $_SESSION['user']->getId();

			// Création d'un nouvel objet Testify
			$objTestify = new Testify();

			// Traitement du formulaire lors de sa soumission
			if (count($_POST) > 0) {
				// Hydratation de l'objet avec les données du formulaire
				$objTestify->hydrate($_POST);
				$objTestify->setId($userId);

				// Validation du titre
				if ($objTestify->getTitle() == "") {
					$this->_arrErrors['title'] = "Le titre est obligatoire";
				}

				// Validation de la description
				if ($objTestify->getDescription() == "") {
					$this->_arrErrors['description'] = "Le contenu est obligatoire";
				}

				// Récupération du fichier image uploadé
				$arrImageTestify = $_FILES['image'];

				// Validation de l'upload de l'image
				if ($arrImageTestify['error'] == 4) {
					$this->_arrErrors['image'] = "L'image est obligatoire";
				} else {
					// Vérification des erreurs d'upload
					if ($arrImageTestify['error'] != 0) {
						$this->_arrErrors['image'] = "Le fichier a rencontré un pb";
					}
					// Vérification du type de fichier
					elseif ($arrImageTestify['type'] != 'image/jpeg') {
						$this->_arrErrors['image'] = "Uniquement les images jpeg sont acceptés";
					}
					// Vérification de la taille du fichier (200Ko max)
					elseif ($arrImageTestify['size'] > 200000) {
						$this->_arrErrors['image'] = "Le fichier ne doit pas dépasser 100Ko";
					}
				}

				// Traitement de l'image si aucune erreur de validation
				if (!isset($this->_arrErrors['image'])) {
					// Définition du fichier source (temporaire)
					$strSource = $arrImageTestify['tmp_name'];
					
					// Génération d'un nom de fichier aléatoire
					$strFileName = bin2hex(random_bytes(10)) . ".webp";
					$strDest = "assets/images/testify/" . $strFileName;

					// Récupération des dimensions de l'image source
					list($intWidth, $intHeight) = getimagesize($strSource);

					// Création de l'image redimensionnée
					$objDest = imagecreatetruecolor(200, 200);
					$objSource = imagecreatefromjpeg($strSource);

					// Redimensionnement de l'image
					imagecopyresized($objDest, $objSource, 0, 0, 0, 0, 200, 200, $intWidth, $intHeight);

					// Sauvegarde de l'image au format WebP
					imagewebp($objDest, $strDest);

					// Mise à jour du nom de l'image dans l'objet Testify
					$objTestify->setPicture($strFileName);
				}

				// Ajout du témoignage si aucune erreur de validation
				if (count($this->_arrErrors) === 0) {
					// Tentative d'ajout dans la base de données
					$boolTrue = $this->_objTestifyModel->testifyAdd($objTestify);

					// Gestion des messages de retour
					if ($boolTrue) {
						$this->_arrSuccess[] = "Le témoignages a été ajouté avec succès ! ";
					} else {
						$this->_arrErrors[] = "L'insertion s'est mal passée";
					}
				}
			}

			// Transmission des données à la vue
			$this->_arrData['objTestify'] = $objTestify;

			// Affichage de la vue d'ajout de témoignage
			$this->display("user/testify/add_testify_profil");
		}
	


		/**
		 * Méthode gérant la modification d'un témoignage par un utilisateur
		 * 
		 * Cette méthode :
		 * - Vérifie que l'utilisateur est connecté
		 * - Vérifie que l'utilisateur a le droit de modifier ce témoignage (propriétaire ou admin)
		 * - Récupère les données du témoignage existant
		 * - Traite le formulaire de modification
		 * - Valide les champs requis (titre, description, statut)
		 * - Gère l'upload et le traitement optionnel d'une nouvelle image
		 * - Met à jour le témoignage dans la base de données
		 * - Gère les messages de succès/erreur
		 * 
		 * Les statuts possibles sont :
		 * - NV : Non Validé
		 * - ECV : En Cours de Validation
		 * - V : Validé
		 * 
		 * Les utilisateurs standards (UC) ne peuvent pas modifier le statut vers NV ou V.
		 * 
		 		 */
		public function edit_testify_profil() {
			// Définition de l'identifiant de la page courante
			$this->_arrData['strPage'] = "edit_testify_profil";

			// Redirection vers la page de connexion si l'utilisateur n'est pas connecté
			if (!isset($_SESSION['user'])) {
				header("Location:index.php?ctrl=user&action=login");
			}

			// Récupération de l'ID du témoignage depuis l'URL
			$testifyId = $_GET['id'];
			// Récupération des données du témoignage depuis la base de données
			$arrTestify = $this->_objTestifyModel->readTestifyOne($testifyId);

			// Vérification des droits d'accès pour les utilisateurs standards (UC)
			if ($_SESSION['user']->getType() == "UC") {
				// Redirection si l'utilisateur n'est pas le propriétaire du témoignage
				if ($_SESSION['user']->getId() != $arrTestify['test_user_id']) {
					header("Location:index.php?ctrl=user&action=profil");
				}
			}

			// Création et hydratation d'un nouvel objet Testify avec les données existantes
			$objTestify = new Testify();
			$objTestify->hydrate($arrTestify);

			// Traitement du formulaire lors de sa soumission
			if (count($_POST) > 0) {
				// Debug des données POST

				// Mise à jour de l'objet avec les nouvelles données
				$objTestify->hydrate($_POST);
				$objTestify->setId($testifyId);

				// Validation du titre
				if ($objTestify->getTitle() == "") {
					$this->_arrErrors['title'] = "Le titre est obligatoire";
				}

				// Validation de la description
				if ($objTestify->getDescription() == "") {
					$this->_arrErrors['description'] = "Le contenu est obligatoire";
				}

				// Validation du statut
				if ($objTestify->getStatus() == "") {
					$this->_arrErrors['status'] = "Le status doit etre remplit ";
				} else if ($objTestify->getStatus() != "NV" && $objTestify->getStatus() != "ECV" && $objTestify->getStatus() != "V") {
					$this->_arrErrors['status'] = "Le status de compte doit etre valide ";
				}

				// Vérification des droits de modification du statut pour les utilisateurs standards
				if ($_SESSION['user']->getType() == "UC" && ($objTestify->getStatus() == "NV" || $objTestify->getStatus() == "V")) {
					$this->_arrErrors['status'] = "Vous ne pouvez pas modifier le status ";
				}

				// Traitement de l'image si une nouvelle image est fournie
				$arrImageTestify = $_FILES['image'];
				if ($arrImageTestify['name'] != "") {
					// Validation de l'upload de l'image
					if ($arrImageTestify['error'] == 4) {
						$this->_arrErrors['image'] = "L'image est obligatoire";
					} else {
						// Vérification des erreurs d'upload
						if ($arrImageTestify['error'] != 0) {
							$this->_arrErrors['image'] = "Le fichier a rencontré un pb";
						}
						// Vérification du type de fichier
						elseif ($arrImageTestify['type'] != 'image/jpeg') {
							$this->_arrErrors['image'] = "Uniquement les images jpeg sont acceptés";
						}
						// Vérification de la taille du fichier (200Ko max)
						elseif ($arrImageTestify['size'] > 200000) {
							$this->_arrErrors['image'] = "Le fichier ne doit pas dépasser 200Ko";
						}
					}

					// Traitement de l'image si aucune erreur de validation
					if (!isset($this->_arrErrors['image'])) {
						// Définition du fichier source (temporaire)
						$strSource = $arrImageTestify['tmp_name'];

						// Génération du nom de fichier
						$arrFileExplode = explode(".", $arrImageTestify['name']);
						$strFileExt = $arrFileExplode[count($arrFileExplode) - 1];
						$strFileName = bin2hex(random_bytes(10)) . ".webp";
						$strDest = "assets/images/testify/" . $strFileName;

						// Récupération des dimensions de l'image source
						list($intWidth, $intHeight) = getimagesize($strSource);

						// Création de l'image redimensionnée
						$objDest = imagecreatetruecolor(200, 200);
						$objSource = imagecreatefromjpeg($strSource);

						// Redimensionnement de l'image
						imagecopyresized($objDest, $objSource, 0, 0, 0, 0, 200, 200, $intWidth, $intHeight);

						// Sauvegarde de l'image au format WebP
						imagewebp($objDest, $strDest);
						$strOldImg	= $objTestify->getPicture(); // Récupération de l'image avant changement
						// Mise à jour du nom de l'image dans l'objet Testify
						$objTestify->setPicture($strFileName);

						// Debug de l'objet mis à jour
					}
				}

				// Mise à jour du témoignage si aucune erreur de validation
				if (count($this->_arrErrors) === 0) {
					// Tentative de mise à jour dans la base de données
					$boolTrue = $this->_objTestifyModel->testifyUpd($objTestify);

					// Gestion des messages de retour
					if ($boolTrue) {
						if(isset($strOldImg)){
							unlink("assets/images/testify/".$strOldImg.".webp");

						}

						$this->_arrSuccess[] = "Le témoignages a été modifé avec succès ! ";
					} else {
						$this->_arrErrors[] = "La modification s'est mal passée";
					}
				}
			}

			// Transmission des données à la vue
			$this->_arrData['arrTestify'] = $arrTestify;
			$this->_arrData['objTestify'] = $objTestify;

			// Affichage de la vue de modification de témoignage
			$this->display("user/testify/edit_testify_profil");
		}


		/**
		 * Méthode gérant la suppression d'un témoignage par un utilisateur ou administrateur modérateur
		 * 
		 * Cette méthode :
		 * - Vérifie que l'utilisateur est connecté
		 * - Vérifie que l'utilisateur a le droit de supprimer ce témoignage (propriétaire ou admin)
		 * - Récupère les données du témoignage existant
		 * - Traite le formulaire de confirmation de suppression
		 * - Vérifie que l'utilisateur a confirmé la suppression en tapant "SUPPRIMER"
		 * - Supprime le témoignage de la base de données
		 * - Gère la redirection selon le type d'utilisateur
		 * - Gère les messages de succès/erreur
		 * 
		 		 */
		public function delete_testify_profil() {
			// Définition de l'identifiant de la page courante
			$this->_arrData['strPage'] = "delete_testify_profil";

			// Redirection vers la page de connexion si l'utilisateur n'est pas connecté
			if (!isset($_SESSION['user'])) {
				header("Location:index.php?ctrl=user&action=login");
			}

			// Récupération de l'ID du témoignage depuis l'URL
			$testifyId = $_GET['id'];
			// Récupération des données du témoignage depuis la base de données
			$arrTestify = $this->_objTestifyModel->readTestifyOne($testifyId);

			// Vérification des droits d'accès pour les utilisateurs standards (UC)
			if ($_SESSION['user']->getType() == "UC") {
				// Redirection si l'utilisateur n'est pas le propriétaire du témoignage
				if ($_SESSION['user']->getId() != $arrTestify['test_user_id']) {
					header("Location:index.php?ctrl=user&action=profil");
				}
			}

			// Création d'un nouvel objet Testify
			$objTestify = new Testify();

			// Traitement du formulaire lors de sa soumission
			if (count($_POST) > 0) {
				// Validation de la confirmation de suppression
				if ($_POST['verifDelete'] != "SUPPRIMER") {
					$this->_arrErrors['verifDelete'] = "Taper SUPPRIMER dans le champ de vérification pour confirmer la suppression";
				}

				// Création et hydratation d'un nouvel objet Testify avec les données du formulaire
				$objTestify = new Testify();
				$objTestify->hydrate($_POST);
				$objTestify->setId($testifyId);

				// Suppression du témoignage si aucune erreur de validation
				if (count($this->_arrErrors) === 0) {
					// Tentative de suppression dans la base de données
					$boolTrue = $this->_objTestifyModel->testifyDel($objTestify);

					// Gestion de la redirection et des messages selon le résultat
					if ($boolTrue) {
						// Redirection différente selon le type d'utilisateur
						if ($_SESSION['user']->getType() == "UC") {
							header("Location:index.php?ctrl=testify&action=list_testify_profil");
							// Note : problème connu avec cette redirection qui bloque l'utilisateur lenvoie sur 403 ou admin modo envois sur list_testify_profil
						}else if (($_SESSION['user']->getType() == "ADM") || ($_SESSION['user']->getType() == "MOD")){							
							header("Location:index.php?ctrl=testify&action=list_testify_archives_admin");
						}
					} else {
						$this->_arrErrors[] = "Les modifications ont échouées";
					}
				}
			}

			// Transmission des données à la vue
			$this->_arrData['objTestify'] = $objTestify;

			// Affichage de la vue de suppression de témoignage
			$this->display("user/testify/delete_testify_profil");
		}
	



		/**
		 * Méthode gérant l'affichage de tous les témoignages pour l'administration
		 * 
		 * Cette méthode :
		 * - Vérifie que l'utilisateur est connecté et a les droits d'administration
		 * - Récupère tous les témoignages depuis la base de données
		 * - Crée des objets Testify pour chaque témoignage
		 * - Prépare les données pour l'affichage dans la vue admin
		 * 
		 		 */
		public function list_testify_admin() {
			// Définition de l'identifiant de la page courante
			$this->_arrData['strPage'] = "list_testify_admin";

			// Redirection vers l'erreur 403 si l'utilisateur n'est pas admin
			if (!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')) {
				header("Location:index.php?ctrl=error&action=error_403");
			}

			// Récupération de tous les témoignages depuis la base de données
			$arrTestify = $this->_objTestifyModel->readTestify();
			$arrTestifyDisplay = array();
			
			// Création des objets Testify pour chaque témoignage
			foreach ($arrTestify as $arrDetTestify) {
				$objTestify = new Testify();
				$objTestify->hydrate($arrDetTestify);
				$arrTestifyDisplay[] = $objTestify;
			}

			// Transmission du tableau des témoignages à la vue
			$this->_arrData['arrTestify'] = $arrTestifyDisplay;

			// Affichage de la vue admin des témoignages
			$this->display("admin/testify/list_testify_admin");
		}

		/**
		 * Méthode gérant l'affichage des témoignages en cours de validation
		 * 
		 * Cette méthode :
		 * - Vérifie que l'utilisateur est connecté et a les droits d'administration
		 * - Récupère les témoignages en attente de validation
		 * - Crée des objets Testify pour chaque témoignage
		 * - Prépare les données pour l'affichage dans la vue admin
		 * 
		 		 */
		public function list_testify_validating_admin() {
			// Définition de l'identifiant de la page courante
			$this->_arrData['strPage'] = "list_testify_validating_admin";

			// Redirection vers l'erreur 403 si l'utilisateur n'est pas admin
			if (!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')) {
				header("Location:index.php?ctrl=error&action=error_403");
			}

	
			// Récupération des témoignages en validation depuis la base de données
			$arrTestify = $this->_objTestifyModel->readTestifyValidating();
			if(empty($arrTestify)) {
				$this->_arrSuccess['testify'] = "Bon travail tout les témoignages on était traiter";

			} else {
				$arrTestifyDisplay = array();
				
				// Création des objets Testify pour chaque témoignage
				foreach ($arrTestify as $arrDetTestify) {
					$objTestify = new Testify();
					$objTestify->hydrate($arrDetTestify);
					$arrTestifyDisplay[] = $objTestify;
				}

				// Transmission du tableau des témoignages à la vue
				$this->_arrData['arrTestify'] = $arrTestifyDisplay;
			} 
			// Affichage de la vue admin des témoignages en validation
			$this->display("admin/testify/list_testify_validating_admin");
		}

		/**
		 * Méthode gérant l'affichage des témoignages archivés
		 * 
		 * Cette méthode :
		 * - Vérifie que l'utilisateur est connecté et a les droits d'administration
		 * - Récupère les témoignages archivés depuis la base de données
		 * - Crée des objets Testify pour chaque témoignage
		 * - Prépare les données pour l'affichage dans la vue admin
		 * 
		 		 */
		public function list_testify_archives_admin() {
			// Définition de l'identifiant de la page courante
			$this->_arrData['strPage'] = "list_testify_archives_admin";

			// Redirection vers l'erreur 403 si l'utilisateur n'est pas admin
			if (!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')) {
				header("Location:index.php?ctrl=error&action=error_403");
			}

			// Récupération des témoignages archivés depuis la base de données
			$arrTestify = $this->_objTestifyModel->readTestifyArchives();
			$arrTestifyDisplay = array();
			
			// Création des objets Testify pour chaque témoignage
			foreach ($arrTestify as $arrDetTestify) {
				$objTestify = new Testify();
				$objTestify->hydrate($arrDetTestify);
				$arrTestifyDisplay[] = $objTestify;
			}

			// Transmission du tableau des témoignages à la vue
			$this->_arrData['arrTestify'] = $arrTestifyDisplay;

			// Affichage de la vue admin des témoignages archivés
			$this->display("admin/testify/list_testify_archives_admin");
		}

		/**
		 * Méthode gérant la validation d'un témoignage par un administrateur
		 * 
		 * Cette méthode :
		 * - Vérifie que l'utilisateur est connecté et a les droits d'administration
		 * - Récupère l'ID du témoignage à valider
		 * - Met à jour le statut du témoignage dans la base de données
		 * - Redirige vers la liste des témoignages en validation
		 * 
		 		 */
		public function update_testify_validating_admin() {
			// Redirection vers l'erreur 403 si l'utilisateur n'est pas admin
			if (!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')) {
				header("Location:index.php?ctrl=error&action=error_403");
			}

			// Récupération de l'ID du témoignage et création de l'objet
			$testifyId = $_GET['id'];
			$objTestify = new Testify();
			$objTestify->setId($testifyId);

			// Mise à jour du statut en "validé"
			$boolTrue = $this->_objTestifyModel->testifyValidateUpd($objTestify);

			// Redirection vers la liste des témoignages en validation
			if ($boolTrue) {
				header("Location: index.php?ctrl=testify&action=list_testify_validating_admin");
			}
		}

		/**
		 * Méthode gérant le refus d'un témoignage par un administrateur
		 * 
		 * Cette méthode :
		 * - Vérifie que l'utilisateur est connecté et a les droits d'administration
		 * - Récupère l'ID du témoignage à refuser
		 * - Met à jour le statut du témoignage dans la base de données
		 * - Redirige vers la liste des témoignages en validation
		 * 
		 		 */
		public function update_testify_no_validating_admin() {
			// Redirection vers l'erreur 403 si l'utilisateur n'est pas admin
			if (!isset($_SESSION['user']) || ($_SESSION['user']->getType() == 'UC')) {
				header("Location:index.php?ctrl=error&action=error_403");
			}

			// Récupération de l'ID du témoignage et création de l'objet
			$testifyId = $_GET['id'];
			$objTestify = new Testify();
			$objTestify->setId($testifyId);

			// Mise à jour du statut en "non validé"
			$boolTrue = $this->_objTestifyModel->testifyNoValidateUpd($objTestify);

			// Redirection vers la liste des témoignages en validation
			if ($boolTrue) {
				header("Location: index.php?ctrl=testify&action=list_testify_validating_admin");
			}
		}
        
}



