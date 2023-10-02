-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour sessions
CREATE DATABASE IF NOT EXISTS `sessions` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sessions`;

-- Listage de la structure de table sessions. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessions.categorie : ~8 rows (environ)
INSERT INTO `categorie` (`id`, `nom_categorie`) VALUES
	(1, 'INFORMATIQUE'),
	(2, 'MEDICAL'),
	(3, 'RESSOURCES HUMAINES'),
	(4, 'COMPTABILITE'),
	(6, 'ol'),
	(7, 'test'),
	(8, 'tfqer'),
	(9, 'strh');

-- Listage de la structure de table sessions. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table sessions.doctrine_migration_versions : ~1 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20230921115118', '2023-09-21 11:51:29', 513);

-- Listage de la structure de table sessions. formateur
CREATE TABLE IF NOT EXISTS `formateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessions.formateur : ~7 rows (environ)
INSERT INTO `formateur` (`id`, `prenom`, `nom`) VALUES
	(1, 'Jean', 'DUPONT'),
	(2, 'Lucie', 'PAULIN'),
	(3, 'Angélique', 'HUBERT'),
	(4, 'Henri', 'CHARLES'),
	(5, 'Margaux', 'PORTE'),
	(7, 'Test update', 'Test update'),
	(8, 'dytu', 'dytj');

-- Listage de la structure de table sessions. formation
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_formation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessions.formation : ~21 rows (environ)
INSERT INTO `formation` (`id`, `nom_formation`) VALUES
	(1, 'BUREAUTIQUE'),
	(2, 'DEV WEB'),
	(3, 'COMPTABILITE'),
	(4, 'SECRETARIAT'),
	(5, 'ASSISTANCE DENTAIRE'),
	(6, 'Esthéthique'),
	(7, 'Formation test'),
	(9, 'Boucherie'),
	(10, 'Boulangerie'),
	(11, 'Assistant médical'),
	(12, 'Secrétaire médical'),
	(13, 'Masseur'),
	(14, 'Kinésithérapie'),
	(15, 'Comportementaliste animalier'),
	(16, 'Médiation animale'),
	(17, 'Art thérapie'),
	(18, 'Test Formation'),
	(19, 'Huissier de justice'),
	(20, 'Huissier de justice'),
	(21, 'Test 12'),
	(22, 'qger');

-- Listage de la structure de table sessions. messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessions.messenger_messages : ~0 rows (environ)

-- Listage de la structure de table sessions. module
CREATE TABLE IF NOT EXISTS `module` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categorie_id` int NOT NULL,
  `nom_module` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C242628BCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_C242628BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessions.module : ~15 rows (environ)
INSERT INTO `module` (`id`, `categorie_id`, `nom_module`) VALUES
	(1, 1, 'FRONT'),
	(2, 1, 'BACK'),
	(3, 1, 'RESPONSIVE'),
	(4, 1, 'PHP'),
	(5, 1, 'JS'),
	(6, 2, 'HYGIENE'),
	(7, 2, 'SECURITE'),
	(8, 2, 'ETHIQUE'),
	(9, 2, 'RADIOLOGIE'),
	(10, 3, 'LOGICIELS'),
	(11, 3, 'CANDIDATURES ET ENTRETIENS'),
	(12, 4, 'EXCEL'),
	(13, 4, 'FICHE DE PAIE'),
	(14, 4, 'COMMANDE FOURNISSEUR'),
	(17, 1, 'Test');

-- Listage de la structure de table sessions. programme
CREATE TABLE IF NOT EXISTS `programme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session_id` int NOT NULL,
  `duree` double NOT NULL,
  `module_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3DDCB9FF613FECDF` (`session_id`),
  KEY `IDX_3DDCB9FFAFC2B591` (`module_id`),
  CONSTRAINT `FK_3DDCB9FF613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`),
  CONSTRAINT `FK_3DDCB9FFAFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessions.programme : ~9 rows (environ)
INSERT INTO `programme` (`id`, `session_id`, `duree`, `module_id`) VALUES
	(1, 2, 365, 12),
	(2, 3, 365, 2),
	(3, 1, 354, 6),
	(5, 5, 35, 8),
	(8, 3, 5, 4),
	(9, 3, 5, 5),
	(13, 1, 12, 1),
	(14, 1, 14, 2),
	(19, 2, 45, 4);

-- Listage de la structure de table sessions. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `formation_id` int DEFAULT NULL,
  `formateur_id` int NOT NULL,
  `titre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_places` int NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D45200282E` (`formation_id`),
  KEY `IDX_D044D5D4155D8F51` (`formateur_id`),
  CONSTRAINT `FK_D044D5D4155D8F51` FOREIGN KEY (`formateur_id`) REFERENCES `formateur` (`id`),
  CONSTRAINT `FK_D044D5D45200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessions.session : ~12 rows (environ)
INSERT INTO `session` (`id`, `formation_id`, `formateur_id`, `titre`, `nb_places`, `date_debut`, `date_fin`) VALUES
	(1, 5, 1, 'Assistant(e) en chirurgie dentaire', 15, '2023-09-21 14:30:56', '2024-09-21 14:31:00'),
	(2, 3, 2, 'Responsable comptable', 10, '2023-10-21 14:31:25', '2024-09-21 14:31:32'),
	(3, 2, 3, 'Développeur web et web mobile', 13, '2024-09-21 00:00:00', '2025-09-21 00:00:00'),
	(4, 3, 5, 'Comptable', 10, '2023-11-22 13:34:38', '2024-09-22 13:34:44'),
	(5, 1, 2, 'Rédactrice PE', 25, '2023-10-01 13:36:09', '2024-03-22 13:36:19'),
	(6, 5, 5, 'test', 4, '2021-01-01 00:00:00', '2022-01-01 00:00:00'),
	(8, 1, 3, 'test update', 6, '2018-01-01 00:00:00', '2018-01-01 00:00:00'),
	(9, 16, 3, 'Médiation animale -', 5, '2024-02-01 00:00:00', '2024-09-30 00:00:00'),
	(10, 1, 3, 'Test Session', 50, '2023-09-26 00:00:00', '2025-09-30 00:00:00'),
	(11, 6, 2, 'Personal shopper', 5, '2020-01-01 00:00:00', '2020-12-12 00:00:00'),
	(14, 2, 4, 'Développeur web et web mobile', 15, '2023-09-28 00:00:00', '2023-10-28 00:00:00'),
	(20, 1, 1, 'dytu', 50, '2012-02-01 00:00:00', '2013-05-03 00:00:00');

-- Listage de la structure de table sessions. stagiaire
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` datetime NOT NULL,
  `ville` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `courriel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessions.stagiaire : ~14 rows (environ)
INSERT INTO `stagiaire` (`id`, `nom`, `prenom`, `sexe`, `date_naissance`, `ville`, `courriel`, `telephone`) VALUES
	(1, 'MIRIN', 'Pria', 'F', '2001-09-21 14:26:28', 'Strasbourg', 'priamirin@hotmail.fr', 615698745),
	(2, 'STEPHAN', 'Fanny', 'F', '1989-09-21 14:27:22', 'Sarreguemines', 'fannystephan@hotmail.fr', 659869472),
	(3, 'ANGE', 'Samuel', 'H', '2000-09-21 14:28:06', 'Strasbourg', 'samuelange@hotmail.fr', 415796830),
	(4, 'PIRON', 'Lucien', 'H', '1991-09-21 14:28:40', 'Sarrebourg', 'lucienpirton@live.fr', 696874965),
	(5, 'DERRAS', 'Leana', 'F', '2002-09-21 14:29:35', 'Strasbourg', 'leanaderras@live.fr', 457986362),
	(9, 'test', 'update', '1', '2018-01-01 00:00:00', 'test', 'test@test.fr', 5555),
	(10, 'MAYER', 'Marie', '', '1999-03-29 00:00:00', 'Strasbourg', 'mayermarie@live.fr', 65998745),
	(11, 'VALLERAN', 'Simon', '1', '1888-12-04 00:00:00', 'Sarreguemines', 'simon@vall.fr', 616325789),
	(12, 'MONTLUTRION', 'Pierre-Loup', '1', '1998-08-05 00:00:00', 'Colmar', 'pierreloup@hotmail.com', 116689452),
	(13, 'POCHIN', 'Ludovic', '1', '2001-04-05 00:00:00', 'Nice', 'ludo@outlook.fr', 613325987),
	(14, 'MINELLI', 'Jasmine', '1', '2004-06-05 00:00:00', 'Rome', 'jasminelli@gmail.com', 445632597),
	(15, 'LOUBOUTIN', 'Christian', '1', '1954-12-05 00:00:00', 'Paris', 'louboubou@outlook.com', 636569874),
	(16, 'SILENA', 'Aliya', '', '2000-08-04 00:00:00', 'Brest', 'aliyasile@outlook.com', 663354516),
	(17, 'VASILI', 'Julia', '', '1995-12-06 00:00:00', 'Rouen', 'juliavasili@outlook.com', 645236894);

-- Listage de la structure de table sessions. stagiaire_session
CREATE TABLE IF NOT EXISTS `stagiaire_session` (
  `stagiaire_id` int NOT NULL,
  `session_id` int NOT NULL,
  PRIMARY KEY (`stagiaire_id`,`session_id`),
  KEY `IDX_D32D02D4BBA93DD6` (`stagiaire_id`),
  KEY `IDX_D32D02D4613FECDF` (`session_id`),
  CONSTRAINT `FK_D32D02D4613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D32D02D4BBA93DD6` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaire` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessions.stagiaire_session : ~29 rows (environ)
INSERT INTO `stagiaire_session` (`stagiaire_id`, `session_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 4),
	(1, 6),
	(1, 9),
	(1, 14),
	(2, 1),
	(2, 2),
	(2, 3),
	(3, 1),
	(3, 3),
	(3, 4),
	(3, 6),
	(3, 9),
	(3, 11),
	(3, 14),
	(4, 1),
	(4, 3),
	(4, 4),
	(4, 6),
	(4, 11),
	(5, 1),
	(5, 3),
	(5, 4),
	(5, 6),
	(5, 9),
	(5, 11),
	(5, 14),
	(9, 3),
	(10, 1),
	(10, 3),
	(10, 4),
	(10, 9),
	(10, 14),
	(11, 3),
	(11, 6),
	(12, 3),
	(12, 4),
	(13, 3),
	(13, 4),
	(14, 3),
	(14, 4),
	(14, 9),
	(15, 3),
	(15, 4),
	(15, 9),
	(16, 3),
	(16, 4);

-- Listage de la structure de table sessions. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sessions.user : ~12 rows (environ)
INSERT INTO `user` (`id`, `pseudo`, `email`, `roles`, `password`) VALUES
	(1, '', 'test@test', '[]', '$2y$13$DeifcFPlbr50qKZh5iyW1Ol6IeNsTczthk74Ur.l5ngJvhWWws8bi'),
	(3, 'admin', 'admin@admin.fr', '["ROLE_ADMIN"]', '$2y$13$aqLC4Hs3Uj9lbxuLHl6xoOHZiX5y2BqzOzUgcU06S8wMU4VbcEnXq'),
	(4, 'admin1', 'admin@admin.com', '["ROLE_ADMIN"]', '$2y$13$1.TwhMG/274oKeWlRHJjDutCRUwWwWCMXfJmP/oVTw9QSRABw4/uq'),
	(5, 'Douvipop', 'douvipop@gmail.com', '[]', '$2y$13$2DgICVhu0h3YBaFe.bqLlOBR7eoJB.bhHnT1XXLptWZNPFjrBscJO'),
	(6, 'daviboule', 'daviboul@gmail.com', '[]', '$2y$13$R.iTaUSdqhfRTOvU7CKYfeJz1jwUVZCVdLUZw.V4mNF123luEqtOC'),
	(7, 'grominet', 'grominet@gmail.com', '[]', '$2y$13$fvd/pVeiCjy7W1hbEHG.R.GitLUpsRorp2Wkbm4MHsZOGmTigVDY6'),
	(8, 'titi', 'titi@gmail.com', '[]', '$2y$13$uI.hZaLxs/OcI7KH2YODI.yxyFk7E72PId9d8DTHwoDlskfP8Xuja'),
	(9, 'chucknorris', 'chucknorris@gmail.com', '[]', '$2y$13$YuSnKW2sn9YSriV.ftskjO.jf1DwqYPIlYRkl77ZFU3oQ6ehZtofS'),
	(10, 'indianajones', 'indianajones@gmail.com', '[]', '$2y$13$y6RqHgXbACFC7.yRJ69JFuY6iUHN0MJgQEuN0vAEOYb/cDb4qFdkC'),
	(11, 'test123', 'test@gmail.com', '[]', '$2y$13$e03scTrXDT6u2g9Bgb9HwO6WfLM36iewn0QPMOZwobi2NLErd9ZSm'),
	(12, 'TESTMDP', 'testmdp@testmdp', '[]', '$2y$13$A00XCISZhf3/eV1sKc0g4.BExChwGmOMjkBTGfBGGJeOCGNdbOQGW'),
	(13, 'Eleonore', 'ele@gmail.com', '[]', '$2y$13$uC0aIwxc9V/si5O1F2v8B.4dk0s.Fegds56FAStomFR.mjNX9zWce');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
