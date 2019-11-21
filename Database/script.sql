CREATE DATABASE kano;
USE kano;

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


DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descrizione` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `domande`
--

DROP TABLE IF EXISTS `domande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domande` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descrizione` varchar(1000) NOT NULL,
  `funzionale` tinyint(1) NOT NULL DEFAULT '1',
  `id_funzionale` int(10) unsigned DEFAULT NULL,
  `id_lingua` int(10) unsigned NOT NULL,
  `id_categoria` int(10) unsigned NOT NULL,
  `id_sottocategoria` int(11) DEFAULT NULL,
  `suggerimento` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_funzionale` (`id_funzionale`),
  KEY `id_lingua` (`id_lingua`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_sottocategoria` (`id_sottocategoria`),
  CONSTRAINT `domande_ibfk_1` FOREIGN KEY (`id_funzionale`) REFERENCES `domande` (`id`),
  CONSTRAINT `domande_ibfk_2` FOREIGN KEY (`id_lingua`) REFERENCES `lingue` (`id`),
  CONSTRAINT `domande_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categorie` (`id`),
  CONSTRAINT `domande_ibfk_4` FOREIGN KEY (`id_sottocategoria`) REFERENCES `sottocategorie` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `importanza`
--

DROP TABLE IF EXISTS `importanza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `importanza` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_domanda` int(10) unsigned NOT NULL,
  `valore` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_domanda` (`id_domanda`),
  CONSTRAINT `importanza_ibfk_1` FOREIGN KEY (`id_domanda`) REFERENCES `domande` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lingue`
--

DROP TABLE IF EXISTS `lingue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lingue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sigla` varchar(4) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `risp_questionario`
--

DROP TABLE IF EXISTS `risp_questionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risp_questionario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_domanda` int(10) unsigned NOT NULL,
  `id_risposta` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_domanda` (`id_domanda`),
  KEY `id_risposta` (`id_risposta`),
  CONSTRAINT `risp_questionario_ibfk_1` FOREIGN KEY (`id_domanda`) REFERENCES `domande` (`id`),
  CONSTRAINT `risp_questionario_ibfk_2` FOREIGN KEY (`id_risposta`) REFERENCES `risposte` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `risposte`
--

DROP TABLE IF EXISTS `risposte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risposte` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descrizione` varchar(255) NOT NULL,
  `peso_funzionale` int(11) NOT NULL,
  `peso_disfunzionale` int(11) NOT NULL,
  `id_lingua` int(10) unsigned NOT NULL,
  `id_categoria` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_lingua` (`id_lingua`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `risposte_ibfk_1` FOREIGN KEY (`id_lingua`) REFERENCES `lingue` (`id`),
  CONSTRAINT `risposte_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sottocategorie`
--

DROP TABLE IF EXISTS `sottocategorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sottocategorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `descrizione` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'kano'
--

--
-- Dumping routines for database 'kano'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-21 16:31:20
