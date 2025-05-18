-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 26 fév. 2025 à 15:44
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `compagnon_de_vie`
--

-- --------------------------------------------------------

--
-- Structure de la table `adopt`
--

DROP TABLE IF EXISTS `adopt`;
CREATE TABLE IF NOT EXISTS `adopt` (
  `adopt_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''adoption',
  `adopt_status` enum('ECV','V','NV') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Statut de la demande d''adoption',
  `adopt_date_demand` datetime NOT NULL COMMENT 'Date de la demande d''adoption',
  `adopt_user_id` int UNSIGNED NOT NULL COMMENT 'Identifiant de l''utilisateur',
  `adopt_animal_id` int UNSIGNED NOT NULL COMMENT 'Identifiant de l''animal',
  PRIMARY KEY (`adopt_id`),
  KEY `adopt_user_id` (`adopt_user_id`),
  KEY `adopt_animal_id` (`adopt_animal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adopt`
--

INSERT INTO `adopt` (`adopt_id`, `adopt_status`, `adopt_date_demand`, `adopt_user_id`, `adopt_animal_id`) VALUES
(1, 'V', '2025-01-08 21:08:18', 1, 4),
(2, 'V', '2025-01-08 21:08:18', 1, 13),
(3, 'NV', '2025-01-08 21:08:18', 1, 3),
(4, 'ECV', '2025-01-08 21:08:18', 1, 1),
(6, 'NV', '2025-01-08 21:08:18', 5, 2),
(7, 'ECV', '2025-01-08 21:08:18', 5, 12),
(8, 'V', '2025-01-08 21:08:18', 6, 10),
(9, 'NV', '2025-01-08 21:08:18', 6, 9),
(10, 'ECV', '2025-01-16 19:46:34', 6, 6),
(11, 'V', '2025-01-08 21:08:18', 2, 15),
(12, 'NV', '2025-01-08 21:08:18', 2, 17),
(13, 'ECV', '2025-01-16 21:46:35', 2, 16);

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

DROP TABLE IF EXISTS `animal`;
CREATE TABLE IF NOT EXISTS `animal` (
  `animal_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''animal',
  `animal_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nom de l''animal',
  `animal_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Description de l''animal',
  `animal_sexe` enum('M','F') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Sexe de l''animal',
  `animal_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `animal_compatibility_animals` enum('O','N','AV') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Compatibilité animal, animal',
  `animal_compatibility_children` enum('O','N','AV') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Compatibilité animal, enfant',
  `animal_status` enum('D','ND') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Statut de l''animal',
  `animal_date_birth` date NOT NULL COMMENT 'Date de naissance de l''animal',
  `animal_date_crea` datetime NOT NULL COMMENT 'Date de création de la fiche animal',
  `animal_refuge_id` int UNSIGNED NOT NULL COMMENT 'Identifiant du refuge de l''animal',
  `animal_breed_id` int UNSIGNED NOT NULL COMMENT 'Identifiant de la race',
  PRIMARY KEY (`animal_id`),
  KEY `animal_refuge_id` (`animal_refuge_id`),
  KEY `animal_breed_id` (`animal_breed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`animal_id`, `animal_name`, `animal_description`, `animal_sexe`, `animal_picture`, `animal_compatibility_animals`, `animal_compatibility_children`, `animal_status`, `animal_date_birth`, `animal_date_crea`, `animal_refuge_id`, `animal_breed_id`) VALUES
(1, 'Jazz', 'Chienne de couleur blanche avec ses deux oreilles noires', 'F', '83afb01858fd4c45bc05.webp', 'N', 'O', 'D', '2018-08-22', '2025-01-08 21:07:10', 1, 1),
(2, 'Gigolo', 'Chien trés sociable de couleur noir/acajou/gris', 'M', 'f8678df9b9655f2ccbc9.webp', 'O', 'O', 'D', '2014-07-14', '2025-01-08 21:07:10', 2, 2),
(3, 'Felix', 'Siamoise câline, très joueuse', 'F', 'b37170041af6491adf09.webp', 'O', 'O', 'D', '2022-01-15', '2024-12-29 18:58:30', 3, 3),
(4, 'Crunch', 'Chat affectueux avec une robe rousse', 'M', 'df208a0acd248221aa17.webp', 'N', 'N', 'ND', '2012-01-19', '2025-01-08 21:07:10', 4, 4),
(5, 'Nagini', 'Python docile et curieux', 'F', '65350b6a1ca098e985a2.webp', 'AV', 'O', 'D', '2021-06-20', '2024-12-29 18:58:30', 1, 5),
(6, 'Jafar', 'Grand boa très calme malgré sa taille imposante, habitué aux humains il a un tempérament posé', 'M', 'e81817ee6de4d5bb7262.webp', 'N', 'O', 'D', '2021-02-18', '2025-01-08 21:07:10', 2, 6),
(8, 'Gecko', 'Jeune gecko actif la nuit et joueur', 'M', 'e97c88c48bd12a7ea677.webp', 'N', 'O', 'D', '2021-02-18', '2025-01-08 21:07:10', 4, 8),
(9, 'Blur', 'Perruche ondulée sociable aux plumes bleues éclatantes. Aussi bavard que son homonyme', 'F', 'f0c79e7552652354b991.webp', 'N', 'O', 'D', '2023-06-15', '2025-01-08 21:07:10', 4, 9),
(10, 'Paulie', 'Calopsitte bavarde qui aime raconter des histoires', 'F', '502068efea89a09ac5fe.webp', 'N', 'O', 'ND', '2023-04-20', '2025-01-08 21:07:10', 2, 10),
(11, 'Iago', 'Ara au caractère bien trempé mais attachant. Très expressif', 'M', '4a316b8b75dee6470942.webp', 'O', 'N', 'D', '2020-03-10', '2025-01-08 21:07:10', 3, 11),
(12, 'Cotton', 'Gris du Gabon mystérieuse qui parle de façon énigmatique', 'F', 'cc0e2e63324bae0be8be.webp', 'O', 'O', 'D', '2021-08-15', '2025-01-08 21:07:10', 4, 12),
(13, 'Nemo', 'Fantail aventureux à la nageoire caractéristique', 'M', 'a280b0fc7d809875ed68.webp', 'N', 'N', 'ND', '2023-12-01', '2025-01-08 21:07:10', 1, 13),
(14, 'Dory', 'Poisson telescope aux grands yeux curieux et au comportement enjoué', 'F', 'e57aecea681c15a64a12.webp', 'O', 'O', 'D', '2023-10-01', '2025-01-08 21:07:10', 2, 14),
(15, 'Naveen', 'Rainette pleine d\'élégance et de charisme', 'M', 'a10d6ae85eb3eee7b7ed.webp', 'O', 'O', 'ND', '2023-09-20', '2025-01-08 21:07:10', 3, 15),
(16, 'Fiona', 'Grenouille cornue imposante', 'F', '27080cd6fb02e468b5f6.webp', 'N', 'N', 'D', '2023-05-15', '2025-01-08 21:07:10', 4, 16),
(17, 'Alfred', 'Tres affectueux', 'M', 'debe0c077c3c9aac0f63.webp', 'AV', 'O', 'D', '2025-01-11', '2025-01-11 01:31:42', 2, 7),
(33, 'One', 'Petite chienne Shar-pei très affectueuse mais un peu craintive', 'F', '19ea6f9bffe1482a14b2.webp', 'N', 'O', 'ND', '2019-02-05', '2025-02-15 14:59:04', 2, 1),
(34, 'Prada', 'Petite chienne retrouvé abandonnée.', 'F', '79fcd5622bcea68d3931.webp', 'O', 'O', 'ND', '2021-07-19', '2025-02-18 17:31:51', 3, 2),
(36, 'Kouros', 'Jeune berger-allemand, très gentil et social.', 'M', 'f9e53cb7b49072d03d25.webp', 'O', 'O', 'D', '2023-04-06', '2025-02-18 17:59:19', 4, 18),
(37, 'Nephertiti', 'Chatte craintive.', 'F', 'dd95b4d1c126865d35fe.webp', 'AV', 'AV', 'D', '2021-07-14', '2025-02-18 18:11:07', 1, 19),
(38, 'Simba', 'joueuse.', 'M', 'a39f63ea4dd1d2307263.webp', 'O', 'N', 'D', '2023-08-30', '2025-02-18 20:50:14', 3, 4),
(39, 'Wilfrid', 'Il était une fois, dans une jungle luxuriante, un petit gecko nommé Wilfrid. Contrairement à ses congénères qui se contentaient de grimper sur les troncs d\'arbres et de se cacher sous des feuilles, Wilfrid avait un esprit curieux et un cœur avide d\'aventures.\r\nUn matin, alors que le soleil commençait à peine à percer les cieux, Wilfrid entendit un bruit étrange venant de l\'autre côté de la jungle. C\'était un murmure doux, comme une mélodie ancienne. Intrigué, il se faufila entre les racines des arbres géants et s\'aventura dans une partie de la forêt qu\'il n\'avait jamais explorée auparavant.\r\nIl arriva devant un énorme rocher couvert de mousse. Là, dans une fissure, il aperçut une lumière bleue étincelante. C\'était un cristal magique, brillant d\'une lueur douce et hypnotisante. En s\'approchant, Wilfrid sentit une étrange chaleur l\'envahir, et tout à coup, le rocher se déplaça, révélant un passage secret. Curieux, il s\'y glissa et se retrouva dans une grotte souterraine.\r\nLa grotte était remplie de pierres précieuses et d\'anciennes gravures qui racontaient des légendes oubliées. Au centre, une immense fontaine d\'eau cristalline scintillait, et au-dessus, un arbre gigantesque, aux feuilles argentées, s\'élevait vers les cieux. C\'était l\'Arbre des Vœux, un arbre mythique dont les racines nourrissaient toute la jungle et exauçaient les vœux de ceux qui osaient le rencontrer.\r\nWilfrid s\'approcha et, sans réfléchir, fit un vœu. \"Je veux vivre des aventures extraordinaires, voyager à travers des terres lointaines et découvrir des trésors cachés.\" À peine avait-il formulé son vœu qu\'un éclair de lumière éclata, et en un clin d\'œil, Wilfrid se retrouva transporté dans un désert chaud, où d\'immenses pyramides se dressaient à l\'horizon.\r\nLes jours suivants, il parcourut des déserts de sable, navigua sur des océans mystérieux, combattit des créatures légendaires, et fit des rencontres incroyables avec des êtres aux pouvoirs extraordinaires. Un jour, il rencontra un phoenix enflammé qui lui offrit une plume magique capable de lui donner une vision infinie. Une autre fois, il affronta un serpent géant qui protégeait un trésor caché au fond d\'un volcan.\r\nMais malgré toutes ces aventures fascinantes, Wilfrid ne cessa de se demander ce qui avait bien pu se passer avec l\'Arbre des Vœux. Un soir, après avoir résolu une énigme ancienne et sauvé un village d’une tempête magique, il aperçut un portail scintillant dans le ciel. Il comprit que c\'était le chemin de retour vers sa jungle.\r\nLorsqu\'il rentra enfin chez lui, il n\'était plus le même petit gecko curieux. Il avait acquis une sagesse et une expérience rares, et il savait que, même dans les recoins les plus paisibles de la jungle, une aventure pouvait toujours commencer. Et ainsi, chaque jour, Wilfrid continua à explorer de nouveaux mystères et à vivre des aventures incroyables, tout en gardant un regard émerveillé sur le monde qui l\'entourait.\r\nEt c\'est ainsi que le gecko Wilfrid devint une légende, racontée à travers les générations, une source d\'inspiration pour tous ceux qui rêvaient d\'aventures extraordinaires.\r\n ', 'M', '9bb71dc24e69107e4472.webp', 'AV', 'O', 'D', '2024-04-03', '2025-02-18 21:26:23', 4, 8),
(40, 'Porcinet', 'Jeune cochon sauvage', 'M', 'dc6dcc61fcf1ec17686d.webp', 'O', 'N', 'D', '2024-12-10', '2025-02-22 10:48:50', 4, 20),
(41, 'Sidonnie', 'Sidonnie, cherche un espace vert.', 'F', 'acb9c33b1ee3db249696.webp', 'O', 'O', 'D', '2023-04-12', '2025-02-22 11:00:23', 2, 21),
(44, 'Prisca', 'Petite chevre naine', 'F', 'f623e95849b0aa3a897f.webp', 'O', 'O', 'D', '2024-11-05', '2025-02-22 12:27:58', 4, 22),
(45, 'Jolly jumper', 'Tres docile.', 'M', '45596a07c8f22ea9f66b.webp', 'O', 'AV', 'D', '2021-04-12', '2025-02-22 12:37:19', 1, 23);

-- --------------------------------------------------------

--
-- Structure de la table `animal_breed`
--

DROP TABLE IF EXISTS `animal_breed`;
CREATE TABLE IF NOT EXISTS `animal_breed` (
  `breed_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la race',
  `breed_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nom de de la race',
  `breed_characteristics` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Caractéristique de la race( environnement ..)',
  `breed_size` enum('PET','MOY','GRA') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Taille de l''animale',
  `breed_spec_id` int UNSIGNED NOT NULL COMMENT 'Identifiant de l''espèces',
  PRIMARY KEY (`breed_id`),
  KEY `breed_spec_id` (`breed_spec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animal_breed`
--

INSERT INTO `animal_breed` (`breed_id`, `breed_name`, `breed_characteristics`, `breed_size`, `breed_spec_id`) VALUES
(1, 'Bull-terrier', 'Le Bull Terrier est un chien d’origine anglaise, appartenant au 3e groupe des races de chien de la Fédération cynologique internationale, le groupe des terriers et non celui des molosses.\r\n\r\n Créé à l\'origine comme chien de combat, il est aujourd\'hui davantage apprécié comme chien de compagnie. C\'est la seule race de chien à tête ovoïde ce qui lui confère un attrait esthétique particulier. ', 'MOY', 1),
(2, 'Labrador', 'Chien familial, doux avec les enfants', 'GRA', 1),
(3, 'Siamois', 'Chat très vocal et affectueux', 'MOY', 2),
(4, 'Maine Coon', 'Chat de grande taille, calme et doux', 'GRA', 2),
(5, 'Python Royal', 'Calme et manipulable, taille modérée', 'MOY', 3),
(6, 'Boa Constrictor', 'Grand serpent puissant mais docile', 'GRA', 3),
(7, 'Pogona', 'Lézard calme et sociable', 'MOY', 4),
(8, 'Gecko léopard', 'Lézard nocturne facile a élever', 'PET', 4),
(9, 'Perruches ondulées', 'Les perruches ondulées, également connues sous le nom de perruches australiennes, sont parmi les espèces de perruches les plus populaires en tant qu’animaux de compagnie. Leur charme naturel et leur comportement enjoué en ont fait des compagnons appréciés dans de nombreux foyers. Dans cette section, nous explorerons en détail les caractéristiques des perruches ondulées, y compris leur apparence distinctive, leur tempérament et leur comportement sociaux, ainsi que les exigences spécifiques en matière de logement, de nourriture et de soins.', 'PET', 5),
(10, 'Perruches calopsitte', 'Les perruches Calopsittes sont fidèles à leur compagnon humain de référence. C\'est dans les gènes, car tous les cacatuidés sont monogames ! Elle s\'exprime avec sa tête expressive, surtout lorsqu\'elle veut 	attirer l\'attention. Plus elle est jeune, plus elle s\'attachera facilement à son maître.', 'PET', 5),
(11, 'Ara', 'Grand perroquet majestueux aux couleurs vives', 'GRA', 6),
(12, 'Gris du Gabon', 'Perroquet très intelligent, excellentes capacités vocales', 'GRA', 6),
(13, 'Poisson Rouge Fantail', 'Queue en éventail, nage élégante', 'PET', 7),
(14, 'Poisson Rouge Telescope', 'Yeux protubérants caractéristiques', 'PET', 7),
(15, 'Rainette verte', 'Grenouille arboricole active', 'PET', 8),
(16, 'Grenouille cornue', 'Grenouille terrestre massive', 'MOY', 8),
(17, 'Shar-pei', 'Le Shar-Pei est un chien de taille moyenne robuste, compact et au poil très court. Il est facilement reconnaissable aux plis qui caractérisent sa tête et son pelage. Le Shar-Pei est une race qui demande beaucoup d’affection, de la tendresse et de l’attention.', 'MOY', 1),
(18, 'Berger-allemand', 'Le Berger Allemand est un chien robuste, athlétique et endurant. Il est doté d’un corps très harmonieux et bâti pour l’effort physique. Depuis 10 ans, il règne en maître sur la 1e place du podium des chiens préférés des Français.', 'GRA', 1),
(19, 'Chat Sphynx', 'Le sphynx est décrit comme un chat extrêmement affectueux, et aimant vivre en société. Il aurait besoin de l\'attention de son propriétaire et adorerait se percher sur ses épaules.', 'MOY', 2),
(20, 'Cochon sauvage', 'Le cochon marron peut avoir côtoyé des êtres humains ou bien être né loin d\'eux, de sorte que la différence entre lui et un individu domestique proprement dit n\'est pas génétique mais uniquement éthologique, c\'est-à-dire liée à son mode de vie.', 'MOY', 9),
(21, 'Vache Tarentaise', 'Elle est classée vache mixte (vache laitière et allaitante). Cette race est bonne en production laitière et elle donne un lait riche en matières grasses sur des alpages où aucune race \"productive\" ne pourrait vivre en plein air. Elle donne 4 800 kg sur 292 jours de lactation par an.', 'GRA', 11),
(22, 'Chèvre naine', 'La chèvre domestique appartient à la famille des bovidés, comme les vaches, mais à la sous-famille des caprins. Essentiellement élevées pour leur lait, pour leur viande, pour leur laine, pour leur pelage et pour leur cuir, les chèvres ont été domestiquées depuis près de 10 000 ans par l’homme.', 'MOY', 10),
(23, 'Cheval Pur-Sang anglais', 'Le Pur-Sang (Thoroughbred), aussi appelé Pur-Sang anglais, est une race de chevaux de selle élevés pour la course.\r\n\r\nIl est originaire de Grande-Bretagne et est le résultat d’une sélection importante et de croisements avec des étalons arabes à la fin du XVIIème siècle.', 'GRA', 14);

-- --------------------------------------------------------

--
-- Structure de la table `animal_category`
--

DROP TABLE IF EXISTS `animal_category`;
CREATE TABLE IF NOT EXISTS `animal_category` (
  `cat_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la catégorie',
  `cat_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nom de la catégorie (mammifère , reptile ..)',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animal_category`
--

INSERT INTO `animal_category` (`cat_id`, `cat_name`) VALUES
(1, 'Mammifère'),
(2, 'Reptile'),
(3, 'Oiseau'),
(4, 'Poisson'),
(5, 'Amphibien');

-- --------------------------------------------------------

--
-- Structure de la table `animal_species`
--

DROP TABLE IF EXISTS `animal_species`;
CREATE TABLE IF NOT EXISTS `animal_species` (
  `spec_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''espèces',
  `spec_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nom de l''espèces',
  `spec_cat_id` int UNSIGNED NOT NULL COMMENT 'Identifiant de catégorie',
  PRIMARY KEY (`spec_id`),
  KEY `spec_cat_id` (`spec_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animal_species`
--

INSERT INTO `animal_species` (`spec_id`, `spec_name`, `spec_cat_id`) VALUES
(1, 'Chien', 1),
(2, 'Chat', 1),
(3, 'Serpent', 2),
(4, 'Lézard', 2),
(5, 'Perruche', 3),
(6, 'Perroquet', 3),
(7, 'Poisson rouge', 4),
(8, 'Grenouille', 5),
(9, 'Cochon', 1),
(10, 'Chèvres', 1),
(11, 'Vache', 1),
(12, 'Mouton', 1),
(13, 'Poule', 1),
(14, 'Cheval', 1);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''évènement',
  `event_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nom de l''évènement',
  `event_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Description de l''évènement',
  `event_picture` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Image de l''évènement',
  `event_status` enum('D','ND') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Statut de l''évènement',
  `event_date` date NOT NULL COMMENT 'Date de l''événement',
  `event_date_crea` datetime NOT NULL COMMENT 'Date de création de la fiche d''évènement',
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`event_id`, `event_name`, `event_description`, `event_picture`, `event_status`, `event_date`, `event_date_crea`) VALUES
(1, 'Journée adoption', 'Venez rencontrer nos animaux', '7e8e7fdc0b7f68ee7229', 'ND', '2024-03-01', '2025-01-01 21:07:10'),
(2, 'Collecte de dons', 'Collecte de nourriture et accessoires', '673f14ed5e54888a634e', 'D', '2025-03-20', '2025-01-08 21:07:10'),
(3, 'Journée randonnée', 'Venez assistez a notre journée promenade avec nos pensionnaire', 'c25fe1e3ca5de1aa0338', 'D', '2025-03-03', '2025-02-26 16:41:38');

-- --------------------------------------------------------

--
-- Structure de la table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
CREATE TABLE IF NOT EXISTS `favorite` (
  `fav_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du like',
  `fav_date_crea` datetime NOT NULL COMMENT 'Date du like',
  `fav_user_id` int UNSIGNED NOT NULL COMMENT 'Identifiant de l''utilisateur',
  `fav_animal_id` int UNSIGNED NOT NULL COMMENT 'Identifiant de l''animal',
  PRIMARY KEY (`fav_id`),
  KEY `fav_user_id` (`fav_user_id`),
  KEY `fav_animal_id` (`fav_animal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favorite`
--

INSERT INTO `favorite` (`fav_id`, `fav_date_crea`, `fav_user_id`, `fav_animal_id`) VALUES
(11, '2025-01-05 21:08:18', 1, 2),
(12, '2025-01-06 21:08:18', 1, 3),
(13, '2025-01-07 21:08:18', 1, 5),
(14, '2025-01-04 21:08:18', 1, 11),
(15, '2025-01-01 21:08:18', 2, 2),
(16, '2025-01-02 21:08:18', 2, 5),
(17, '2025-01-08 21:08:18', 2, 14),
(18, '2025-01-01 21:08:18', 3, 17),
(19, '2025-01-05 21:08:18', 4, 8),
(20, '2025-01-01 21:08:18', 5, 14),
(21, '2025-01-03 21:08:18', 6, 11);

-- --------------------------------------------------------

--
-- Structure de la table `participate`
--

DROP TABLE IF EXISTS `participate`;
CREATE TABLE IF NOT EXISTS `participate` (
  `particip_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de participation',
  `particip_date` datetime NOT NULL COMMENT 'Date de participation',
  `particip_user_id` int UNSIGNED NOT NULL COMMENT 'Identifiant de l''utilisateur',
  `particip_event_id` int UNSIGNED NOT NULL COMMENT 'Identifiant de l''évènement',
  PRIMARY KEY (`particip_id`),
  KEY `particip_user_id` (`particip_user_id`),
  KEY `particip_event_id` (`particip_event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `participate`
--

INSERT INTO `participate` (`particip_id`, `particip_date`, `particip_user_id`, `particip_event_id`) VALUES
(1, '2025-01-08 21:08:18', 1, 2),
(2, '2025-01-08 21:08:18', 2, 2),
(3, '2025-01-08 21:08:18', 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `pic_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la photo',
  `pic_picture` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Chemin vers l''image de l''animal',
  `pic_animal_id` int UNSIGNED NOT NULL COMMENT 'Identifiant de l''animal',
  PRIMARY KEY (`pic_id`),
  KEY `pîc_animal_id` (`pic_animal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`pic_id`, `pic_picture`, `pic_animal_id`) VALUES
(15, 'e57a1b0a4a6b6b3628d1', 33),
(16, 'bc178d9e92008606ea6b', 33),
(17, '88b9abded3d655c58838', 33),
(18, 'f38bb239d567620ebb3e', 17),
(19, 'af293f56ea1124a4b36b', 17),
(20, '0723fa423d01c816c8c1', 17),
(21, '31628dac3ec2b7b3c3d0', 17),
(29, 'fb155fe48d0306fd5f9f', 13),
(31, '43faac40ce3c0cee6412', 13),
(32, '5f5288569f320d87dc5f', 13),
(33, '8ef4a37c69fcc1ed1bf5', 13),
(38, '9a9d1310b3ad0949dc8e', 6),
(39, '1a6a0446659d040ab339', 6),
(41, '517c9609746d7fb4af5a', 6),
(44, 'c8f7f9fb52d91dc8fd86', 33),
(45, 'abbdc334d8a38d978bf4', 14),
(47, '58ec67cf7ce79a76ab7f', 14),
(48, 'f95c9f54041bf5422471', 14),
(49, '58f6e6e59f5e685586ce', 1),
(50, 'd0be051551bd8db438a6', 1),
(51, '13f49a162544d71c7f8d', 1),
(52, 'e6cef13f8217c4c74962', 2),
(53, 'd5d0ec636bafdef92766', 2),
(54, 'e021cd44eaba680f9fc7', 2),
(55, '11c27f67d93c9db2cb31', 2),
(56, 'a8fa0fbe07ad35f71037', 2),
(57, 'fe0920f5b6b290cc7355', 10),
(58, 'bdb9deea4ead1da05da0', 10),
(59, '2667209d901bc8f8ed76', 11),
(60, 'f50459566aaa06972d18', 11),
(61, '8e9e47c314034b1c7fcc', 11),
(62, 'e15c3cfb9c563a8a671c', 4),
(63, '321149c0b07c08c91a99', 4),
(64, '8abc4a4005372f4534dd', 15),
(65, '8bdbcefc8b18bd934678', 15),
(66, '46b69654514d592656fe', 3),
(67, 'df55c15da418f5aca774', 3),
(68, 'c74423e237da3b0d60a4', 3),
(69, 'bc23a0192b518757d25d', 5),
(70, '458d404d29b9828a6bf7', 5),
(71, '370559d535d9b401b790', 8),
(72, 'd06bffdedbcc47a2060f', 8),
(73, '12ab3e61f57a85328eca', 8),
(74, 'd402591a5873fea76955', 14),
(75, 'cbc3f502314839615d16', 16),
(76, '34ff67e083eb58158c41', 16),
(77, '73a5363862c1ade059ef', 12),
(78, '6903fe064084b71f8b64', 12),
(79, 'c3fc136106260c609f62', 9),
(80, '623186258c09f8ee9108', 9),
(81, 'e9059b21398558b07e87', 34),
(82, 'd69652f471b41d4f904a', 34),
(84, 'cf8c24bddd776438c080', 34),
(85, 'f07ee1d314e5a4e67832', 36),
(86, '0bdefddbb388a9fe1285', 36),
(87, 'bb3cdd668339d602dd3f', 37),
(88, 'ee39557e1a5efa2c4060', 37),
(89, '872ac8ab434eac543570', 37),
(90, '744605f8d9b587147557', 38),
(91, '8362a45aced74ede5c70', 38),
(92, '82fa5b7d8ab90e5ad7ec', 39),
(93, 'f29f8c304f528c0e32b6', 39),
(95, '6e8b31867984d966edbb', 40),
(96, '17446aa7b6969a089e17', 40),
(98, '2e76bd9efae5c4de310c', 41),
(99, '38bed6e3feced91e0c79', 41),
(100, 'e05bf6f2ff9becc8ea2a', 44),
(101, '9fc7995be582211ccb28', 44),
(102, 'f1de5a24d8c6d03c478e', 44),
(103, 'bf59ce2a4cce7ac8fd98', 45),
(104, '7f8896d9bf545b1eb921', 45);

-- --------------------------------------------------------

--
-- Structure de la table `refuge`
--

DROP TABLE IF EXISTS `refuge`;
CREATE TABLE IF NOT EXISTS `refuge` (
  `refuge_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la catégorie',
  `refuge_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nom du refuge',
  `refuge_town` enum('STRAS','COL','NIED','SL') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nom de la ville',
  `refuge_contact` char(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Numéro de téléphone',
  `refuge_adress` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Adresse du refuge',
  PRIMARY KEY (`refuge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `refuge`
--

INSERT INTO `refuge` (`refuge_id`, `refuge_name`, `refuge_town`, `refuge_contact`, `refuge_adress`) VALUES
(1, 'Refuge de Strasbourg', 'STRAS', '0388610548', '7 rue de l\'Entenloch, 68008'),
(2, 'Refuge de Colmar', 'COL', '0389279074', '47 route de Schoenenwerd, 68000'),
(3, 'Refuge de Saint-Louis', 'SL', '0389699382', '10 rue du Canal, 68000'),
(4, 'Refuge de Niederschaeffolsheim', 'NIED', '0387584574', '3 rue des gonquille, 67515');

-- --------------------------------------------------------

--
-- Structure de la table `testify`
--

DROP TABLE IF EXISTS `testify`;
CREATE TABLE IF NOT EXISTS `testify` (
  `test_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du témoignage',
  `test_title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Titre du témoignage',
  `test_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Contenu du témoignage',
  `test_picture` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Chemin vers l''image',
  `test_status` enum('ECV','V','NV') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Statut du témoignage',
  `test_date_crea` datetime NOT NULL COMMENT 'Date de création du témoignage',
  `test_user_id` int UNSIGNED NOT NULL COMMENT 'Identifiant de l''utilisateur',
  `test_animal_id` int UNSIGNED DEFAULT NULL COMMENT 'Identifiant de l''animal',
  PRIMARY KEY (`test_id`),
  KEY `test_user_id` (`test_user_id`),
  KEY `test_animal_id` (`test_animal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `testify`
--

INSERT INTO `testify` (`test_id`, `test_title`, `test_description`, `test_picture`, `test_status`, `test_date_crea`, `test_user_id`, `test_animal_id`) VALUES
(1, 'Une adoption réussie', 'Crunch est un compagnon formidable', 'd543a6dc3e2e24dc536d', 'V', '2025-01-10 21:07:10', 1, 4),
(4, 'Ne venez pas ici', 'Paulie nous à attaquer nous souhaitons une réclamation', 'ed477a00837a8eb852f3', 'NV', '2025-01-10 21:07:10', 6, 10),
(5, 'Super adoption', 'Super accompagnement pour l\'adoption de notre chien !', '59bb4f9342074e5a675e', 'V', '2025-01-11 19:55:24', 2, 15),
(7, 'Notre nouvelle vie avec Max', 'L\'équipe a été formidable durant tout le processus d\'adoption de notre chiot. Leurs conseils nous ont permis de bien préparer son arrivée à la maison!', 'c41720161355e6941ef7', 'V', '2025-02-26 16:19:45', 1, NULL),
(8, 'Un compagnon fidèle', 'Adopter un chat senior était la meilleure décision. Merci pour votre patience et vos explications sur ses besoins spécifiques.', '4dbb0af426a73cd92461', 'V', '2025-02-26 16:21:20', 1, NULL),
(9, 'Une famille recomposée', 'Grâce à vos conseils, nos deux chats s\'entendent à merveille. L\'intégration s\'est faite en douceur!', 'bbc41909137d227c2ed5', 'V', '2025-02-26 16:22:52', 2, NULL),
(10, 'Une seconde chance pour Luna', 'Votre soutien a été précieux pour l\'adoption de Luna qui a des besoins particuliers. Vos recommandations ont facilité son adaptation.', '2cfe1f7fd9318088fee9', 'ECV', '2025-02-26 16:25:31', 2, NULL),
(11, 'Déception et manque de suivi', 'Procédure d\'adoption trop compliquée et communication défaillante. Après plusieurs semaines d\'attente et de paperasse, nous avons finalement abandonné. L\'animal que nous voulions adopter méritait mieux que cette administration chaotique.', 'b8955835d19c5e4f657a', 'ECV', '2025-02-26 16:26:59', 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''utilisateur',
  `user_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nom de l''utilisateur',
  `user_surname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Prénom de l''utilisateur',
  `user_pseudo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Pseudo de l''utilisateur, unique',
  `user_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Email de l''utilisateur',
  `user_password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Mot de passe de l''utilisateur',
  `user_type` enum('UC','MOD','ADM') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Type de profil utilisateur',
  `user_date_crea` datetime NOT NULL COMMENT 'Date de création du comte',
  `user_code` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Code pour mot de passe oublié',
  `user_date_demand` datetime DEFAULT NULL COMMENT 'Date de demande du code ',
  `user_date_exp` datetime DEFAULT NULL COMMENT 'Date d''expiration du code ',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_surname`, `user_pseudo`, `user_email`, `user_password`, `user_type`, `user_date_crea`, `user_code`, `user_date_demand`, `user_date_exp`) VALUES
(1, 'Martin', 'Sophie', 'SophieM78', 'useruc0@mail.com', '$2y$10$PgN5z3oF6ZiOzBlMtoPu4e5arWVulGLlhNEPBsVYlY4lmA6nFifPm', 'UC', '2025-02-02 17:50:28', NULL, NULL, NULL),
(2, 'Dubois', 'Thomas', 'DuboisFamily', 'useruc1@mail.com', '$2y$10$3O2KqK0ge7jDb6GSRPzyT.KKZxCNqAyHtFDvaVj7pQ7ZDKWWke5y2', 'UC', '2025-02-02 17:52:58', NULL, NULL, NULL),
(3, 'Lambert', 'Françoise', 'Francoise045', 'useruc2@mail.com', '$2y$10$PzMsQtK/1.tEFzYcehI6hO.JR4yqTBPY2dxCNLil8ZaK3TP/AGV1C', 'UC', '2025-02-02 17:54:01', NULL, NULL, NULL),
(4, 'Petit', 'Lucas', 'LucasP_Paris', 'useruc3@mail.com', '$2y$10$HhcFKAzgJd3DafNFBrJc4uNQoitGtgKnLAoda3ICoqjcY5p7L/YiW', 'UC', '2025-02-02 17:54:28', NULL, NULL, NULL),
(5, 'Bernard', 'Marie', 'Marie68', 'useruc4@mail.com', '$2y$10$Z2BI0WPCDpUJcozl8ndhtemXkUZ3HgTFGAqb11UNnTvdBtjS01516', 'UC', '2025-02-02 17:55:19', NULL, NULL, NULL),
(6, 'Garcia', 'Antoine', 'AntoineEtLea', 'useruc5@mail.com', '$2y$10$jquKGqZoscbFE3CaX4kUa.3cqMptVJb5AxFnf.4o4QTt1iO2lF5.S', 'UC', '2025-02-02 17:55:37', NULL, NULL, NULL),
(7, 'Fabrice', 'Braun', 'Novix', 'usermod0@mail.com', '$2y$10$iR7mQy7tlZ42wA2rMtwYhevMjVPT/AUtZ1dzRVlnPstp8HOTN9Zum', 'MOD', '2025-02-02 17:57:44', NULL, NULL, NULL),
(8, 'Bentchikou', 'Nabil', 'Clark', 'usermod1@mail.com', '$2y$10$qm3muVdmCEZOqEQ8.qaHHOtKKtFsR16RzHWfxZOz5dnYdHiHsWUyS', 'MOD', '2025-02-02 17:58:11', NULL, NULL, NULL),
(9, 'Soubeyroux ', 'Gabriel', 'Ashdeuzoh', 'usermod2@mail.com', '$2y$10$6ZhCHJvWaXXXM.fcF6iFX.Chb1UEjsZXuWqWzUId1Ch.82VTIVlSm', 'MOD', '2025-02-02 17:58:35', NULL, NULL, NULL),
(10, 'Sauron', 'Lord', 'TheOneAdmin', 'admin@mail.com', '$2y$10$ie8JblpHgbbMwBfDDAb/vuviQUDXru3YXzebclq6YD4Nm.pRhZzI2', 'ADM', '2025-02-02 18:01:55', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_log`
--

DROP TABLE IF EXISTS `user_log`;
CREATE TABLE IF NOT EXISTS `user_log` (
  `log_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la connexion',
  `log_date_crea` datetime NOT NULL COMMENT 'Date de la connexion',
  `log_user_id` int UNSIGNED NOT NULL COMMENT 'Identifiant de l''utilisateur de la connexion',
  PRIMARY KEY (`log_id`),
  KEY `log_user_id` (`log_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user_log`
--

INSERT INTO `user_log` (`log_id`, `log_date_crea`, `log_user_id`) VALUES
(11, '2025-02-12 21:06:19', 10),
(12, '2025-02-12 21:32:40', 10),
(13, '2025-02-12 21:47:07', 1),
(14, '2025-02-12 21:49:57', 10),
(15, '2020-02-13 22:32:38', 7),
(16, '2025-02-12 22:32:51', 10),
(17, '2025-02-12 23:12:09', 5),
(18, '2025-02-12 23:12:23', 7),
(19, '2025-02-12 23:12:32', 10),
(20, '2025-02-12 23:58:31', 3),
(21, '2025-02-12 23:58:40', 10),
(22, '2025-02-13 00:03:12', 4),
(23, '2025-02-13 00:03:43', 9),
(24, '2025-02-13 00:03:57', 10),
(25, '2025-02-13 18:51:57', 1),
(26, '2025-02-26 14:17:29', 10),
(27, '2025-02-26 14:27:38', 1),
(28, '2025-02-26 14:29:04', 7),
(29, '2025-02-26 15:03:32', 7),
(30, '2025-02-26 15:34:10', 1),
(31, '2025-02-26 15:37:58', 1),
(32, '2025-02-26 15:38:40', 10),
(33, '2025-02-26 15:47:52', 1),
(34, '2025-02-26 15:49:33', 10),
(35, '2025-02-26 15:52:39', 1),
(36, '2025-02-26 15:56:17', 7),
(37, '2025-02-26 16:06:58', 1),
(38, '2025-02-26 16:11:16', 7),
(39, '2025-02-26 16:16:36', 1),
(40, '2025-02-26 16:21:38', 2),
(41, '2025-02-26 16:26:08', 3),
(42, '2025-02-26 16:27:08', 7);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adopt`
--
ALTER TABLE `adopt`
  ADD CONSTRAINT `adopt_ibfk_1` FOREIGN KEY (`adopt_animal_id`) REFERENCES `animal` (`animal_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adopt_ibfk_2` FOREIGN KEY (`adopt_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`animal_breed_id`) REFERENCES `animal_breed` (`breed_id`),
  ADD CONSTRAINT `animal_ibfk_2` FOREIGN KEY (`animal_refuge_id`) REFERENCES `refuge` (`refuge_id`);

--
-- Contraintes pour la table `animal_breed`
--
ALTER TABLE `animal_breed`
  ADD CONSTRAINT `animal_breed_ibfk_1` FOREIGN KEY (`breed_spec_id`) REFERENCES `animal_species` (`spec_id`);

--
-- Contraintes pour la table `animal_species`
--
ALTER TABLE `animal_species`
  ADD CONSTRAINT `animal_species_ibfk_1` FOREIGN KEY (`spec_cat_id`) REFERENCES `animal_category` (`cat_id`);

--
-- Contraintes pour la table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`fav_animal_id`) REFERENCES `animal` (`animal_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`fav_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `participate`
--
ALTER TABLE `participate`
  ADD CONSTRAINT `participate_ibfk_1` FOREIGN KEY (`particip_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participate_ibfk_2` FOREIGN KEY (`particip_event_id`) REFERENCES `event` (`event_id`);

--
-- Contraintes pour la table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`pic_animal_id`) REFERENCES `animal` (`animal_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `testify`
--
ALTER TABLE `testify`
  ADD CONSTRAINT `testify_ibfk_1` FOREIGN KEY (`test_animal_id`) REFERENCES `animal` (`animal_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `testify_ibfk_2` FOREIGN KEY (`test_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `user_log_ibfk_1` FOREIGN KEY (`log_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
