<?php

 /// Définir les fichiers à utiliser 
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 
 /**
  * Controller de la class Pagectrl
  * @author Gabriel, 
  * @version 1.0
  * @date 19/01/2025-15/02/2025
  */
  


class PageCtrl extends MotherCtrl{
	/**
	* Constructeur de la classe
	*/
	public function __construct(){
		parent::__construct();
	}

    /**
    * Gestion de la page de contact
    */
    public function contact(){
        // Inclusion des modèles et entités nécessaires
		require_once("models/model_refuge.php");
        require_once("entities/entity_refuge.php");
		
        // Définition de la page actuelle
		$this->_arrData['strPage'] = "contact";
		
        // Récupération et hydratation des refuges pour affichage
		$objRefugeModel = new RefugeModel();
		$arrRefugeAll = $objRefugeModel->refugeAll();
		
		$arrRefugeAllDisplay = array();
		foreach($arrRefugeAll as $arrDetRefugeAll) {        
			$objRefugeAll = new Refuge();
			$objRefugeAll->hydrate($arrDetRefugeAll);
			$arrRefugeAllDisplay[] = $objRefugeAll;            
		}
		
        // Vérification si le formulaire est soumis
		if (count($_POST) > 0){
			// Récupération des valeurs du formulaire avec protection XSS
			$this->_arrData['name'] = htmlspecialchars($_POST['name'])??'';
			$this->_arrData['surname'] = $_POST['surname']??'';				
			$this->_arrData['email'] = $_POST['email']??'';
			$this->_arrData['subject'] = $_POST['subject']??'';
			$this->_arrData['content'] = $_POST['content']??'';
			$this->_arrData['tel'] = $_POST['tel']??0;
			$this->_arrData['rgpd'] = isset($_POST['rgpd'])??"off";
			
            // Vérification des champs obligatoires
			if ($_POST['name'] == ""){
				$this->_arrErrors['name'] = "Le nom est obligatoire";
			}
			if ($_POST['surname'] == ""){
				$this->_arrErrors['surname'] = "Le prénom est obligatoire";
			}
			if ($_POST['content'] == ""){
				$this->_arrErrors['content'] = "Le contenu est obligatoire";
			}
			
			// Vérification de l'adresse email
			if ($_POST['email'] == ""){
				$this->_arrErrors['email'] = "L'adresse mail est obligatoire";
			}else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$this->_arrErrors['email'] = "L'adresse mail n'est pas valide";
			}
			if ($_POST['tel'] == ""){
				$this->_arrErrors['tel'] = "Vous devez saisir un numéro";
			}else if (!preg_match("/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/", $_POST['tel'])){
				$this->_arrErrors['tel'] = "Le numéro doit etre valide : 06 XX XX XX XX ou +33 6 XX XX XX XX";
			}
			if (!isset($_POST['rgpd'])){
				$this->_arrErrors['rgpd'] = "Vous devez acceptez les RGPD";
			}
			
			// Initialisation de l'objet PHPMailer pour l'envoi d'email
			$objEmail = new PHPMailer();
			
			// Si aucune erreur, envoi du mail
			if (count($this->_arrErrors) == 0){
				$objEmail->IsSMTP();
				$objEmail->Mailer = "smtp";
				$objEmail->CharSet = PHPMailer::CHARSET_UTF8;
				$objEmail->SMTPDebug = 0;  // Désactivation des messages de debug
				$objEmail->SMTPAuth = TRUE;
				$objEmail->SMTPSecure = "tls";
				$objEmail->Port = 587;
				$objEmail->Host = "smtp.gmail.com";
				$objEmail->Username = 'gabriel68150@gmail.com';
				$objEmail->Password = 'llhu ywup cmfd tfmc';
				
				$objEmail->IsHTML(true);
				$objEmail->setFrom('no-reply@blog.fr', 'Refuge pour animaux');
				$objEmail->addAddress('gabriel.soubeyroux@outlook.com', 'Administrateur');
				$objEmail->Subject = 'Message provenant du formulaire de contact du site compagnon_de_vie.fr';
				$objEmail->Body = $this->display("emails/page_contact", false);
				
				if (!$objEmail->send()) {
					echo 'Erreur de Mailer : ' . $objEmail->ErrorInfo;
				} else {
					$this->_arrSuccess['success'] = 'Le message a été envoyé.';
				}
			}
		}
		
		// Passer les données des refuges à la vue
		$this->_arrData['arrRefugeAll'] = $arrRefugeAllDisplay;
		$this->display("contact");
	}

    /**
    * Gestion de la page des mentions légales
    */
    public function legal(){
        $this->_arrData['strPage'] = "legal";
        $this->display("legal");
    }
    
    /**
    * Gestion de la page RGPD
    */
    public function rgpd(){
        $this->_arrData['strPage'] = "rgpd";
        $this->display("rgpd");
    }
    
    /**
    * Gestion de la page d'aide
    */
    public function aide(){
        $this->_arrData['strPage'] = "aide";
        
        // Vérification si l'utilisateur est connecté
        if(!isset($_SESSION['user'])){
            header("Location:index.php?ctrl=user&action=login");
        }
        
        $this->display("aide");
    }
}
