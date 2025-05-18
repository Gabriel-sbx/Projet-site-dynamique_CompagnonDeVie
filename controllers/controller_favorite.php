<?php 

    /**
	* Controller de la class FavoriteCtrl
	* @author Gabriel
	* @version 1.0
	* @date 19/01/2025-15/02/2025
	*/
class FavoriteCtrl extends MotherCtrl{
    // Déclaration d'un attribut privé pour stocker une instance du modèle FavoriteModel
    private object $_objFavoriteModel;

    /**
    * Constructeur de la classe
    */
    public function __construct(){
        // Inclusion des fichiers nécessaires pour le modèle et l'entité Favorite
        require_once("models/model_favorite.php");
        require_once("entities/entity_favorite.php");
        
        // Instanciation du modèle FavoriteModel
        $this->_objFavoriteModel = new FavoriteModel();
    }

    /**
    * Liste des favoris de l'utilisateur
    */
    public function list_favorite(){
        // Définition de la page actuelle
        $this->_arrData['strPage'] = "list_favorite";
        
        // Inclusion des fichiers nécessaires pour le modèle et l'entité Animal
        require_once("models/model_animal.php");
        require_once("entities/entity_animal.php");
        
        // Vérification si l'utilisateur est connecté, sinon redirection
        if(!isset($_SESSION['user'])){
            header("Location:index.php?ctrl=user&action=login");
        }
        
        // Récupération de l'ID utilisateur
        $userId = $_SESSION['user']->getId();
        
        // Récupération des favoris de l'utilisateur
        $arrFavorite = $this->_objFavoriteModel->favoriteReadAll($userId);
        $arrFavoriteDisplay = array();
        $arrFavoriteDetails = array();

        // Hydratation des objets Animal et Favorite
        foreach ($arrFavorite as $arrDetAnimals){
            $objAnimals = new Animal();
            $objAnimals->hydrate($arrDetAnimals);
            $arrFavoriteDisplay[] = $objAnimals;

            // Hydratation de l'objet Favorite pour récupérer des détails supplémentaires
            $objFavorite = new Favorite();    
            $objFavorite->hydrate($arrDetAnimals); 
            $arrFavoriteDetails[$objAnimals->getId()] = $objFavorite;
        }    

        // Stockage des données à afficher
            $this->_arrData['arrFavorite'] = $arrFavoriteDisplay;
            $this->_arrData['arrFavoriteDetails'] = $arrFavoriteDetails;
        
        // Affichage de la page des favoris
        $this->display("user/list_favorite_profil");
    }

    /**
    * Ajout d'un favori pour l'utilisateur
    */
    public function add_favorite() {
        // Vérification si l'utilisateur est connecté
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?ctrl=user&action=login");
        }
        
        // Vérification de l'ID de l'animal à ajouter en favori
        if(!isset($_POST['animal_id'])) {
            $this->_arrErrors['animal_id'] = "Identifiant de l'animal manquant";
        }
        
        // Création d'un nouvel objet Favorite
        $objFavorite = new Favorite();
        $objFavorite->setUser_id($_SESSION['user']->getId());
        $objFavorite->setAnimal_id($_POST['animal_id']);
        
        // Vérification si l'animal est déjà en favori
        if($this->_objFavoriteModel->favoriteVerifExist($objFavorite->getUser_id(), $objFavorite->getAnimal_id())) {
            $this->_arrErrors['favorite'] = "Cet animal est déjà dans vos favoris";
        }
        
        // Ajout du favori si aucune erreur
        if (count($this->_arrErrors) === 0) {
            $boolTrue = $this->_objFavoriteModel->favoriteAdd($objFavorite);
            if($boolTrue){
                header("Location:index.php?ctrl=animal&action=list_animal");
            }
        } else {
            header("Location:index.php?ctrl=animal&action=list_animal");
            $this->_arrErrors['favorite'] = "Ajout échoué";
        }

        // Stockage des données du favori
        $this->_arrData['objFavorite'] = $objFavorite;
    }
}

