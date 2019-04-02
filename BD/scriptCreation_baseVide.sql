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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examen`
--

LOCK TABLES `examen` WRITE;
/*!40000 ALTER TABLE `examen` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personne`
--

LOCK TABLES `personne` WRITE;
/*!40000 ALTER TABLE `personne` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sujet`
--

LOCK TABLES `sujet` WRITE;
/*!40000 ALTER TABLE `sujet` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valeurs`
--

LOCK TABLES `valeurs` WRITE;
/*!40000 ALTER TABLE `valeurs` DISABLE KEYS */;
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

-- Dump completed on 2019-03-10 16:56:50
