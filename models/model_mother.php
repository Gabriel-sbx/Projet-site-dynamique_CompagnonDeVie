<?php
	/**
	* Classe MotherModel permettant la connexion à la base de données.
	* Cette classe sert de modèle parent pour les interactions avec la base de données.
	*/
	class MotherModel{
		
		/// Objet PDO représentant la connexion à la base de données
		protected object $_db;

		/**
		* Constructeur de la classe
		* Initialise la connexion à la base de données et gère les erreurs éventuelles
		*/
		public function __construct(){
			try{
				/// Connexion à la base de données via PDO
				$this->_db = new PDO(

					"mysql:host=localhost;dbname=compagnondevie",  /// Serveur et nom de la base de données

					"root",  // Nom d'utilisateur de la base de données
					"",  // Mot de passe de la base de données (vide par défaut)
					array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC) /// Configuration du mode de récupération des résultats sous forme de tableau associatif
				);

				/// Pour éviter les problèmes d'encodage des caractères
				$this->_db->exec("SET CHARACTER SET utf8"); 
				
				/// Configuration du mode d'erreur pour lever des exceptions en cas de problème

				$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			}catch(PDOException $e){ 
				/// Affichage d'un message d'erreur en cas d'échec de connexion
				echo "Échec : " . $e->getMessage(); 
			}
		}
	}
