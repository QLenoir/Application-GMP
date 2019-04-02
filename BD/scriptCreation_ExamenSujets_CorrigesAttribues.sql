-- MySQL dump 10.13  Distrib 5.7.19, for Win64 (x86_64)
--
-- Host: localhost    Database: intera_notes
-- ------------------------------------------------------
-- Server version	5.7.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `dependances`
--

DROP TABLE IF EXISTS `dependances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dependances` (
  `idValeur` int(11) NOT NULL,
  `idValeurDependante` int(11) NOT NULL,
  PRIMARY KEY (`idValeur`,`idValeurDependante`),
  KEY `idValeurDependante` (`idValeurDependante`),
  CONSTRAINT `dependances_ibfk_1` FOREIGN KEY (`idValeur`) REFERENCES `valeurs` (`idValeur`),
  CONSTRAINT `dependances_ibfk_2` FOREIGN KEY (`idValeurDependante`) REFERENCES `valeurs` (`idValeur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dependances`
--

LOCK TABLES `dependances` WRITE;
/*!40000 ALTER TABLE `dependances` DISABLE KEYS */;
INSERT INTO `dependances` VALUES (6,1),(7,2),(8,3),(9,4),(10,5),(23,21),(24,21),(25,21),(26,21),(27,21),(28,21),(29,21),(30,21),(31,22),(32,22),(33,22),(34,22),(35,22),(36,22),(37,22),(38,22);
/*!40000 ALTER TABLE `dependances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eleve` (
  `idEleve` int(11) NOT NULL,
  `annee` int(4) NOT NULL,
  `nomPromo` varchar(30) NOT NULL,
  PRIMARY KEY (`idEleve`),
  CONSTRAINT `eleve_ibfk_1` FOREIGN KEY (`idEleve`) REFERENCES `personne` (`idPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eleve`
--

LOCK TABLES `eleve` WRITE;
/*!40000 ALTER TABLE `eleve` DISABLE KEYS */;
INSERT INTO `eleve` VALUES (1,2018,'Promo 1A 2018'),(3,2018,'Promo 1A 2018'),(4,2018,'Promo 1A 2018'),(5,2018,'Promo 1A 2018');
/*!40000 ALTER TABLE `eleve` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enonce`
--

DROP TABLE IF EXISTS `enonce`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enonce` (
  `idEnonce` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `consigne` text NOT NULL,
  PRIMARY KEY (`idEnonce`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enonce`
--

LOCK TABLES `enonce` WRITE;
/*!40000 ALTER TABLE `enonce` DISABLE KEYS */;
INSERT INTO `enonce` VALUES (1,'Simulation de fusée','En 2016, la fusée Ariane 5 a décollé du Centre Spatial Guyanais en direction de Lune qui se situe à 340000 Kms de notre chère Terre !<br><br>Nous savons que la fusée possède 1 moteur(s), la fusée peut aller à une vitesse de 1000 Km/H et chaque moteur a une consommation de carburant qui vaut 100 Tonnes/1000 Kms !<br><br>A bord de cette fusée, l\'équipage est constitué de 3 personnes et chaque personne consomme 2 Kgs de nourriture, 1.5 L d\'eau et 60 L d\'O² par jour.'),(2,'Simulation de fusée','En 2016, la fusée Ariane 5 a décollé du Centre Spatial Guyanais en direction de Mars qui se situe à 100000000 Kms de notre chère Terre !<br><br>Nous savons que la fusée possède 2 moteur(s), la fusée peut aller à une vitesse de 2000 Km/H et chaque moteur a une consommation de carburant qui vaut 100 Tonnes/1000 Kms !<br><br>A bord de cette fusée, l\'équipage est constitué de 6 personnes et chaque personne consomme 2 Kgs de nourriture, 1.5 L d\'eau et 60 L d\'O² par jour.');
/*!40000 ALTER TABLE `enonce` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enseignant` (
  `idEnseignant` int(11) NOT NULL,
  PRIMARY KEY (`idEnseignant`),
  CONSTRAINT `enseignant_ibfk_1` FOREIGN KEY (`idEnseignant`) REFERENCES `personne` (`idPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enseignant`
--

LOCK TABLES `enseignant` WRITE;
/*!40000 ALTER TABLE `enseignant` DISABLE KEYS */;
INSERT INTO `enseignant` VALUES (2);
/*!40000 ALTER TABLE `enseignant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examen`
--

DROP TABLE IF EXISTS `examen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examen` (
  `idExamen` int(11) NOT NULL AUTO_INCREMENT,
  `titreExamen` varchar(50) NOT NULL,
  `consigneExamen` text NOT NULL,
  `nbEssaiPossible` int(11) NOT NULL,
  `dateDepot` datetime NOT NULL,
  `anneeScolaire` int(4) NOT NULL,
  PRIMARY KEY (`idExamen`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examen`
--

LOCK TABLES `examen` WRITE;
/*!40000 ALTER TABLE `examen` DISABLE KEYS */;
INSERT INTO `examen` VALUES (1,'Simulation d\'une fusée','En 2016, la fusée Ariane 5 a décollé du Centre Spatial Guyanais en direction de $destinationPlanète$ qui se situe à $distanceDestination$ Kms de notre chère Terre !<br><br>Nous savons que la fusée possède $nbMoteur$ moteur(s), la fusée peut aller à une vitesse de $vitesse$ Km/H et chaque moteur a une consommation de carburant qui vaut $consoCarburantParMoteurs$ Tonnes/1000 Kms !<br><br>A bord de cette fusée, l\'équipage est constitué de $nbPersonne$ personnes et chaque personne consomme $consoNourrituresParPersonneParJour$ Kgs de nourriture, $consoEauParPersonnesParJour$ L d\'eau et $consoO2ParPersonnesParJour$ L d\'O² par jour.',5,'2019-01-30 00:00:00',2018);
/*!40000 ALTER TABLE `examen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exerciceattribue`
--

DROP TABLE IF EXISTS `exerciceattribue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exerciceattribue` (
  `idEleve` int(11) NOT NULL,
  `idSujet` int(11) NOT NULL,
  PRIMARY KEY (`idEleve`,`idSujet`),
  KEY `idSujet` (`idSujet`),
  CONSTRAINT `exerciceattribue_ibfk_1` FOREIGN KEY (`idEleve`) REFERENCES `eleve` (`idEleve`),
  CONSTRAINT `exerciceattribue_ibfk_2` FOREIGN KEY (`idSujet`) REFERENCES `sujet` (`idSujet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exerciceattribue`
--

LOCK TABLES `exerciceattribue` WRITE;
/*!40000 ALTER TABLE `exerciceattribue` DISABLE KEYS */;
INSERT INTO `exerciceattribue` VALUES (3,1),(5,2);
/*!40000 ALTER TABLE `exerciceattribue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exercicegenere`
--

DROP TABLE IF EXISTS `exercicegenere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exercicegenere` (
  `idSujet` int(11) NOT NULL,
  `idValeur` int(11) NOT NULL,
  PRIMARY KEY (`idSujet`,`idValeur`),
  KEY `idValeur` (`idValeur`),
  CONSTRAINT `exercicegenere_ibfk_1` FOREIGN KEY (`idSujet`) REFERENCES `sujet` (`idSujet`),
  CONSTRAINT `exercicegenere_ibfk_2` FOREIGN KEY (`idValeur`) REFERENCES `valeurs` (`idValeur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exercicegenere`
--

LOCK TABLES `exercicegenere` WRITE;
/*!40000 ALTER TABLE `exercicegenere` DISABLE KEYS */;
INSERT INTO `exercicegenere` VALUES (1,1),(2,2),(1,6),(2,7),(1,11),(2,14),(1,21),(2,22),(1,23),(2,32),(1,39),(2,39),(1,40),(2,40),(1,41),(2,41),(1,42),(2,42);
/*!40000 ALTER TABLE `exercicegenere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `idImage` int(11) NOT NULL AUTO_INCREMENT,
  `cheminImage` text NOT NULL,
  PRIMARY KEY (`idImage`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'sigma.png');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `note` (
  `idEleve` int(11) NOT NULL,
  `idSujet` int(11) NOT NULL,
  `note` decimal(4,2) NOT NULL,
  PRIMARY KEY (`idEleve`,`idSujet`),
  KEY `idSujet` (`idSujet`),
  CONSTRAINT `note_ibfk_1` FOREIGN KEY (`idEleve`) REFERENCES `eleve` (`idEleve`),
  CONSTRAINT `note_ibfk_2` FOREIGN KEY (`idSujet`) REFERENCES `sujet` (`idSujet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note`
--

LOCK TABLES `note` WRITE;
/*!40000 ALTER TABLE `note` DISABLE KEYS */;
/*!40000 ALTER TABLE `note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personne`
--

DROP TABLE IF EXISTS `personne`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personne` (
  `idPersonne` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `login` varchar(30) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  PRIMARY KEY (`idPersonne`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personne`
--

LOCK TABLES `personne` WRITE;
/*!40000 ALTER TABLE `personne` DISABLE KEYS */;
INSERT INTO `personne` VALUES (1,'Dupont','Jean','jean.dupont@etu.unilim.fr','Dupont07','dd12a0be622525ca9c70087737495a20c41870f7'),(2,'Poitou','Nicolas','nicolas.poitou@etu.unilim.fr','Poitou13','d5abe173b1bf9ff8fe318c8744fe236c8a0614f8'),(3,'Potter','Harry','harry.potter@etu.unilim.fr','Potter01','4c0bc787843c7a78ffe1bccf9761b19c6cd3ec72'),(4,'McQueen','Flash','flash.mcqueen@etu.unilim.fr','McQueen05','391fbf9ce3238312c7d3f9c5e24e1b06d061de96'),(5,'Sparrow','Jack','jack.sparrow@etu.unilim.fr','Sparrow54','6e9dcda6d2f78b48a2724b629ddcc96fc9ae8710');
/*!40000 ALTER TABLE `personne` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `points`
--

DROP TABLE IF EXISTS `points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `points` (
  `idPoint` int(11) NOT NULL,
  `idExamen` int(11) NOT NULL,
  `nomPoint` varchar(50) NOT NULL,
  `estDonneesCatia` tinyint(1) NOT NULL,
  `idSymboleMathematique` int(11) NOT NULL,
  `idFormuleMathematique` int(11) NOT NULL,
  PRIMARY KEY (`idPoint`,`idExamen`),
  KEY `idExamen` (`idExamen`),
  CONSTRAINT `points_ibfk_1` FOREIGN KEY (`idExamen`) REFERENCES `examen` (`idExamen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `points`
--

LOCK TABLES `points` WRITE;
/*!40000 ALTER TABLE `points` DISABLE KEYS */;
INSERT INTO `points` VALUES (1,1,'nbMoteur',0,0,0),(2,1,'vitesse',0,0,0),(3,1,'nbPersonne',1,0,0),(4,1,'destinationPlanète',0,0,0),(5,1,'distanceDestination',1,1,0),(6,1,'consoCarburantParMoteurs',0,0,0),(7,1,'consoEauParPersonnesParJour',0,0,0),(8,1,'consoNourrituresParPersonneParJour',0,0,0),(9,1,'consoO2ParPersonnesParJour',0,0,0);
/*!40000 ALTER TABLE `points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `idQuestion` int(11) NOT NULL,
  `idExamen` int(11) NOT NULL,
  `intituleQuestion` tinytext NOT NULL,
  `baremeQuestion` decimal(4,2) NOT NULL,
  `zoneTolerance` int(11) NOT NULL,
  PRIMARY KEY (`idQuestion`,`idExamen`),
  KEY `idExamen` (`idExamen`),
  CONSTRAINT `question_ibfk_1` FOREIGN KEY (`idExamen`) REFERENCES `examen` (`idExamen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,1,'Combien de jours seront nécessaires pour effectuer ce voyage ?',2.00,95),(2,1,'Indiquez la quantité d\'O2 nécessaire pour effectuer ce voyage ?',2.00,80),(3,1,'Indiquez la quantité de carburant nécessaire pour effectuer ce voyage ?',2.00,80),(4,1,'Indiquez la quantité de nourriture nécessaire pour effectuer ce voyage ?',2.00,75),(5,1,'Indiquez la quantité d\'eau nécessaire pour effectuer ce voyage ?',2.00,80);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultatsattendus`
--

DROP TABLE IF EXISTS `resultatsattendus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultatsattendus` (
  `idSujet` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL,
  `resultat` decimal(20,2) NOT NULL,
  `resultatExposant` int(11) NOT NULL,
  `resultatUnite` varchar(30) NOT NULL,
  `exposantUnite` int(11) NOT NULL,
  PRIMARY KEY (`idQuestion`,`idSujet`),
  KEY `idSujet` (`idSujet`),
  CONSTRAINT `resultatsattendus_ibfk_1` FOREIGN KEY (`idSujet`) REFERENCES `sujet` (`idSujet`),
  CONSTRAINT `resultatsattendus_ibfk_2` FOREIGN KEY (`idQuestion`) REFERENCES `question` (`idQuestion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultatsattendus`
--

LOCK TABLES `resultatsattendus` WRITE;
/*!40000 ALTER TABLE `resultatsattendus` DISABLE KEYS */;
INSERT INTO `resultatsattendus` VALUES (1,1,14.00,0,'jours',0),(2,1,2083.00,0,'jours',0),(1,2,2550.00,0,'L',0),(2,2,750.00,3,'L',0),(1,3,34.00,3,'g',6),(2,3,20000000.00,12,'g',0),(1,4,85.00,0,'g',3),(2,4,25000.00,3,'g',0),(1,5,63.75,0,'L',0),(2,5,18750.00,0,'L',0);
/*!40000 ALTER TABLE `resultatsattendus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultatseleves`
--

DROP TABLE IF EXISTS `resultatseleves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultatseleves` (
  `dateResult` datetime NOT NULL,
  `idEleve` int(11) NOT NULL,
  `idSujet` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL,
  `resultat` decimal(20,2) NOT NULL,
  `resultatExposant` int(11) NOT NULL,
  `resultatUnite` varchar(30) NOT NULL,
  `exposantUnite` int(11) NOT NULL,
  `justification` text NOT NULL,
  `precisionReponse` decimal(10,2) NOT NULL,
  PRIMARY KEY (`dateResult`,`idEleve`,`idSujet`,`idQuestion`),
  KEY `idEleve` (`idEleve`),
  KEY `idSujet` (`idSujet`),
  KEY `idQuestion` (`idQuestion`),
  CONSTRAINT `resultatseleves_ibfk_1` FOREIGN KEY (`idEleve`) REFERENCES `eleve` (`idEleve`),
  CONSTRAINT `resultatseleves_ibfk_2` FOREIGN KEY (`idSujet`) REFERENCES `sujet` (`idSujet`),
  CONSTRAINT `resultatseleves_ibfk_3` FOREIGN KEY (`idQuestion`) REFERENCES `question` (`idQuestion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultatseleves`
--

LOCK TABLES `resultatseleves` WRITE;
/*!40000 ALTER TABLE `resultatseleves` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultatseleves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sujet`
--

DROP TABLE IF EXISTS `sujet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sujet` (
  `idSujet` int(11) NOT NULL AUTO_INCREMENT,
  `idEnonce` int(11) NOT NULL,
  `semestre` tinyint(1) NOT NULL,
  `idExamen` int(11) NOT NULL,
  `nbEssaiRealise` int(11) NOT NULL,
  PRIMARY KEY (`idSujet`,`idEnonce`),
  KEY `idEnonce` (`idEnonce`),
  KEY `idExamen` (`idExamen`),
  CONSTRAINT `sujet_ibfk_1` FOREIGN KEY (`idEnonce`) REFERENCES `enonce` (`idEnonce`),
  CONSTRAINT `sujet_ibfk_2` FOREIGN KEY (`idExamen`) REFERENCES `examen` (`idExamen`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sujet`
--

LOCK TABLES `sujet` WRITE;
/*!40000 ALTER TABLE `sujet` DISABLE KEYS */;
INSERT INTO `sujet` VALUES (1,1,1,1,0),(2,2,1,1,0);
/*!40000 ALTER TABLE `sujet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valeurs`
--

DROP TABLE IF EXISTS `valeurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valeurs` (
  `idValeur` int(11) NOT NULL AUTO_INCREMENT,
  `idPoint` int(11) NOT NULL,
  `valeur` varchar(50) NOT NULL,
  `exposantValeur` int(11) NOT NULL,
  `uniteValeur` varchar(30) NOT NULL,
  `uniteExposant` int(11) NOT NULL,
  PRIMARY KEY (`idValeur`),
  KEY `idPoint` (`idPoint`),
  CONSTRAINT `valeurs_ibfk_1` FOREIGN KEY (`idPoint`) REFERENCES `points` (`idPoint`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valeurs`
--

LOCK TABLES `valeurs` WRITE;
/*!40000 ALTER TABLE `valeurs` DISABLE KEYS */;
INSERT INTO `valeurs` VALUES (1,1,'1',0,'unité',0),(2,1,'2',0,'unité',0),(3,1,'3',0,'unité',0),(4,1,'4',0,'unité',0),(5,1,'5',0,'unité',0),(6,2,'1000',0,'km/h',0),(7,2,'2000',0,'km/h',0),(8,2,'3000',0,'km/h',0),(9,2,'4000',0,'km/h',0),(10,2,'5000',0,'km/h',0),(11,3,'3',0,'unité',0),(12,3,'4',0,'unité',0),(13,3,'5',0,'unité',0),(14,3,'6',0,'unité',0),(15,3,'7',0,'unité',0),(16,3,'8',0,'unité',0),(17,3,'9',0,'unité',0),(18,3,'10',0,'unité',0),(19,3,'11',0,'unité',0),(20,3,'12',0,'unité',0),(21,4,'Lune',0,'',0),(22,4,'Mars',0,'',0),(23,5,'340',0,'m',6),(24,5,'350',0,'m',6),(25,5,'360',0,'m',6),(26,5,'370',0,'m',6),(27,5,'380',0,'m',6),(28,5,'390',0,'m',6),(29,5,'400',0,'m',6),(30,5,'410',0,'m',6),(31,5,'50',0,'m',9),(32,5,'100',0,'m',9),(33,5,'150',0,'m',9),(34,5,'200',0,'m',9),(35,5,'250',0,'m',9),(36,5,'300',0,'m',9),(37,5,'350',0,'m',9),(38,5,'400',0,'m',9),(39,6,'100',0,'tonnes/1000km',0),(40,7,'1.5',0,'L',0),(41,8,'2',0,'g',3),(42,9,'60',0,'L',0);
/*!40000 ALTER TABLE `valeurs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-10 16:59:16
