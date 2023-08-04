-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: ecf
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `application` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application`
--

LOCK TABLES `application` WRITE;
/*!40000 ALTER TABLE `application` DISABLE KEYS */;
INSERT INTO `application` VALUES (1,'test'),(2,'utrff'),(3,'uuu');
/*!40000 ALTER TABLE `application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chef_de_projet`
--

DROP TABLE IF EXISTS `chef_de_projet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chef_de_projet` (
  `boost_production` int DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `id_collaborateur` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `chef_de_projet_collaborateur_id_fk` (`id_collaborateur`),
  CONSTRAINT `chef_de_projet_collaborateur_id_fk` FOREIGN KEY (`id_collaborateur`) REFERENCES `collaborateur` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chef_de_projet`
--

LOCK TABLES `chef_de_projet` WRITE;
/*!40000 ALTER TABLE `chef_de_projet` DISABLE KEYS */;
INSERT INTO `chef_de_projet` VALUES (3,1,1),(2,2,5),(2,3,6);
/*!40000 ALTER TABLE `chef_de_projet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client` (
  `raison_sociale` varchar(50) DEFAULT NULL,
  `ridet` varchar(10) DEFAULT NULL,
  `ssi2` tinyint(1) DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES ('sdf','556656565',0,25);
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collaborateur`
--

DROP TABLE IF EXISTS `collaborateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `collaborateur` (
  `prenom` varchar(100) DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `prime_embauche` int DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `niveau_competence` enum('1','2','3') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collaborateur`
--

LOCK TABLES `collaborateur` WRITE;
/*!40000 ALTER TABLE `collaborateur` DISABLE KEYS */;
INSERT INTO `collaborateur` VALUES ('leon',1,50000,'morival','2'),('anselm',2,15000,'trinh','1'),('elias',3,25000,'dupin','1'),('colin',4,24000,'soriano','3'),('isaia',5,14000,'maperi','2'),('yohann',6,36000,'huedro','3'),('brandon',7,10000,'roatti','1'),('gregory',8,21000,'saimoen','3'),('maverick',9,23000,'mai','2'),('jonhattan',10,14000,'somny','3'),('vivian',11,16000,'uedre','2'),('corentin',12,18000,'thierry','3');
/*!40000 ALTER TABLE `collaborateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `composant`
--

DROP TABLE IF EXISTS `composant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `composant` (
  `type` enum('1','2','3') DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `progession` int DEFAULT NULL,
  `charge` int DEFAULT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `id_module` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `composant_module_id_fk` (`id_module`),
  CONSTRAINT `composant_module_id_fk` FOREIGN KEY (`id_module`) REFERENCES `module` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `composant`
--

LOCK TABLES `composant` WRITE;
/*!40000 ALTER TABLE `composant` DISABLE KEYS */;
INSERT INTO `composant` VALUES ('1',1,20,12,'composant1',1);
/*!40000 ALTER TABLE `composant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `composition_equipe`
--

DROP TABLE IF EXISTS `composition_equipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `composition_equipe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_equipe` int NOT NULL,
  `id_developpeur` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `composition_equipe_developpeur_id_fk` (`id_developpeur`),
  KEY `composition_equipe_equipe_id_fk` (`id_equipe`),
  CONSTRAINT `composition_equipe_developpeur_id_fk` FOREIGN KEY (`id_developpeur`) REFERENCES `developpeur` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `composition_equipe_equipe_id_fk` FOREIGN KEY (`id_equipe`) REFERENCES `equipe` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `composition_equipe`
--

LOCK TABLES `composition_equipe` WRITE;
/*!40000 ALTER TABLE `composition_equipe` DISABLE KEYS */;
INSERT INTO `composition_equipe` VALUES (181,127,4),(182,127,8),(183,128,1),(184,128,2);
/*!40000 ALTER TABLE `composition_equipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `developpeur`
--

DROP TABLE IF EXISTS `developpeur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `developpeur` (
  `competence` enum('1','2','3') DEFAULT NULL,
  `indice_production` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `id_collaborateur` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `developpeur_collaborateur_id_fk` (`id_collaborateur`),
  CONSTRAINT `developpeur_collaborateur_id_fk` FOREIGN KEY (`id_collaborateur`) REFERENCES `collaborateur` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `developpeur`
--

LOCK TABLES `developpeur` WRITE;
/*!40000 ALTER TABLE `developpeur` DISABLE KEYS */;
INSERT INTO `developpeur` VALUES ('2',5,1,2),('3',7,2,3),('2',3,4,4),('2',5,5,7),('3',4,6,8),('2',5,7,9),('2',3,8,1),('2',4,9,5);
/*!40000 ALTER TABLE `developpeur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_chef_de_projet` int NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `equipe_chef_de_projet_id_fk` (`id_chef_de_projet`),
  CONSTRAINT `equipe_chef_de_projet_id_fk` FOREIGN KEY (`id_chef_de_projet`) REFERENCES `chef_de_projet` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipe`
--

LOCK TABLES `equipe` WRITE;
/*!40000 ALTER TABLE `equipe` DISABLE KEYS */;
INSERT INTO `equipe` VALUES (127,1,'new team'),(128,1,'sdfsqf');
/*!40000 ALTER TABLE `equipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) DEFAULT NULL,
  `id_application` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `module_application_id_fk` (`id_application`),
  CONSTRAINT `module_application_id_fk` FOREIGN KEY (`id_application`) REFERENCES `application` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES (1,'module1',1);
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projet`
--

DROP TABLE IF EXISTS `projet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_developpeur` int DEFAULT NULL,
  `id_chef_de_projet` int DEFAULT NULL,
  `id_composant` int DEFAULT NULL,
  `id_application` int DEFAULT NULL,
  `id_module` int DEFAULT NULL,
  `type` enum('1','2','3') NOT NULL,
  `prix` int NOT NULL,
  `statut` enum('0','1','2','3','4') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `projet_application_id_fk` (`id_application`),
  KEY `projet_chef_de_projet_id_fk` (`id_chef_de_projet`),
  KEY `projet_composant_id_fk` (`id_composant`),
  KEY `projet_developpeur_id_fk` (`id_developpeur`),
  KEY `projet_module_id_fk` (`id_module`),
  CONSTRAINT `projet_application_id_fk` FOREIGN KEY (`id_application`) REFERENCES `application` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `projet_chef_de_projet_id_fk` FOREIGN KEY (`id_chef_de_projet`) REFERENCES `chef_de_projet` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `projet_composant_id_fk` FOREIGN KEY (`id_composant`) REFERENCES `composant` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `projet_developpeur_id_fk` FOREIGN KEY (`id_developpeur`) REFERENCES `developpeur` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `projet_module_id_fk` FOREIGN KEY (`id_module`) REFERENCES `module` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projet`
--

LOCK TABLES `projet` WRITE;
/*!40000 ALTER TABLE `projet` DISABLE KEYS */;
INSERT INTO `projet` VALUES (1,NULL,1,1,1,1,'2',200000,'1');
/*!40000 ALTER TABLE `projet` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-04 15:27:40
