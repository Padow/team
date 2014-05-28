-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.6.12-log - MySQL Community Server (GPL)
-- Serveur OS:                   Win64
-- HeidiSQL Version:             8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for dispo
CREATE DATABASE IF NOT EXISTS `dispo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dispo`;


-- Dumping structure for table dispo.dispo
CREATE TABLE IF NOT EXISTS `dispo` (
  `clee` varchar(100) NOT NULL,
  `dispo` varchar(50) NOT NULL,
  `date` date DEFAULT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`clee`),
  KEY `FK_dispo_players` (`pseudo`),
  CONSTRAINT `FK_dispo_players` FOREIGN KEY (`pseudo`) REFERENCES `players` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dispo.dispo: ~10 rows (environ)
/*!40000 ALTER TABLE `dispo` DISABLE KEYS */;
/*!40000 ALTER TABLE `dispo` ENABLE KEYS */;


-- Dumping structure for table dispo.leagues
CREATE TABLE IF NOT EXISTS `leagues` (
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dispo.leagues: ~4 rows (environ)
/*!40000 ALTER TABLE `leagues` DISABLE KEYS */;
INSERT INTO `leagues` (`name`) VALUES
	('ETF2L'),
	('PCW'),
	('TF2C');
/*!40000 ALTER TABLE `leagues` ENABLE KEYS */;


-- Dumping structure for table dispo.maps
CREATE TABLE IF NOT EXISTS `maps` (
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dispo.maps: ~3 rows (environ)
/*!40000 ALTER TABLE `maps` DISABLE KEYS */;
/*!40000 ALTER TABLE `maps` ENABLE KEYS */;


-- Dumping structure for table dispo.matchs
CREATE TABLE IF NOT EXISTS `matchs` (
  `clee` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time DEFAULT NULL,
  `league` varchar(50) DEFAULT NULL,
  `team` varchar(50) DEFAULT NULL,
  `map1` varchar(50) DEFAULT NULL,
  `map2` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`clee`),
  KEY `FK_league` (`league`),
  KEY `FK_map1` (`map1`),
  KEY `FK_map2` (`map2`),
  CONSTRAINT `FK_league` FOREIGN KEY (`league`) REFERENCES `leagues` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_map1` FOREIGN KEY (`map1`) REFERENCES `maps` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_map2` FOREIGN KEY (`map2`) REFERENCES `maps` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dispo.matchs: ~2 rows (environ)
/*!40000 ALTER TABLE `matchs` DISABLE KEYS */;
/*!40000 ALTER TABLE `matchs` ENABLE KEYS */;


-- Dumping structure for table dispo.players
CREATE TABLE IF NOT EXISTS `players` (
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `classe` varchar(50) NOT NULL,
  `Lun` varchar(10) DEFAULT NULL,
  `Mar` varchar(10) DEFAULT NULL,
  `Mer` varchar(10) DEFAULT NULL,
  `Jeu` varchar(10) DEFAULT NULL,
  `Ven` varchar(10) DEFAULT NULL,
  `Sam` varchar(10) DEFAULT NULL,
  `Dim` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dispo.players: ~10 rows (environ)
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
