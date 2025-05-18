<?php
	require('vendor/autoload.php');
	require_once('entities/entity_user.php');
	session_start();
	// session_destroy();



	
	// Récupération des informations dans l'url
	$strController	= $_GET['ctrl']??"animal";
	//var_dump($strController);
	$strAction		= $_GET['action']??"home";
	//var_dump($strAction);
	
	$boolError= false;
	// Appeler le controller et la méthode 
	require_once("controllers/controller_mother.php");
	$strFileAction = "controllers/controller_".$strController.".php";
		if(file_exists($strFileAction)){
			require_once($strFileAction);	
			// Construction du nom du controller
			$strCtrlName	= ucfirst($strController)."Ctrl";
			if(class_exists($strCtrlName)){
					// Instanciation du controller
				$objController 	= new $strCtrlName();
				if(method_exists($objController, $strAction)){	
					// Appel de la méthode
					$objController -> $strAction();
				}else{
					$boolError= true;
				}
			}else{
				$boolError= true;

			}

		}else{
			$boolError= true;

		}
		if($boolError){
			header("Location:index.php?ctrl=error&action=error_404");

		}

	/***** ATTENTION *****
		Prévoir les erreurs fichier, classe, méthode
	*/
	