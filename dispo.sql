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

-- Dumping data for table dispo.dispo: ~0 rows (environ)
/*!40000 ALTER TABLE `dispo` DISABLE KEYS */;
/*!40000 ALTER TABLE `dispo` ENABLE KEYS */;


-- Dumping structure for table dispo.historic
CREATE TABLE IF NOT EXISTS `historic` (
  `etf2lkey` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `league` varchar(50) NOT NULL,
  `map1` varchar(50) NOT NULL,
  `scoreteam1` int(11) NOT NULL,
  `scoreopponent1` int(11) NOT NULL,
  `logs1` varchar(500) DEFAULT NULL,
  `result1` varchar(50) NOT NULL,
  `map2` varchar(50) DEFAULT NULL,
  `scoreteam2` int(11) DEFAULT NULL,
  `scoreopponent2` int(11) DEFAULT NULL,
  `logs2` varchar(500) DEFAULT NULL,
  `result2` varchar(50) DEFAULT NULL,
  `team` varchar(50) DEFAULT NULL,
  `comments` text,
  PRIMARY KEY (`etf2lkey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dispo.historic: ~0 rows (environ)
/*!40000 ALTER TABLE `historic` DISABLE KEYS */;
/*!40000 ALTER TABLE `historic` ENABLE KEYS */;


-- Dumping structure for table dispo.leagues
CREATE TABLE IF NOT EXISTS `leagues` (
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dispo.leagues: ~3 rows (environ)
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

-- Dumping data for table dispo.maps: ~4 rows (environ)
/*!40000 ALTER TABLE `maps` DISABLE KEYS */;
INSERT INTO `maps` (`name`) VALUES
	('cp_badlands'),
	('cp_process_final'),
	('ctf_turbine_pro_rc4'),
	('koth_pro_viaduct_rc4');
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
  `etf2l` varchar(50) DEFAULT '',
  PRIMARY KEY (`clee`),
  KEY `FK_league` (`league`),
  KEY `FK_map1` (`map1`),
  KEY `FK_map2` (`map2`),
  CONSTRAINT `FK_league` FOREIGN KEY (`league`) REFERENCES `leagues` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_map1` FOREIGN KEY (`map1`) REFERENCES `maps` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_map2` FOREIGN KEY (`map2`) REFERENCES `maps` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dispo.matchs: ~0 rows (environ)
/*!40000 ALTER TABLE `matchs` DISABLE KEYS */;
/*!40000 ALTER TABLE `matchs` ENABLE KEYS */;


-- Dumping structure for table dispo.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '0',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text,
  PRIMARY KEY (`id`),
  KEY `FK_messages_players` (`name`),
  CONSTRAINT `FK_messages_players` FOREIGN KEY (`name`) REFERENCES `players` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dispo.messages: ~0 rows (environ)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;


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
  `lastmess` int(11) NOT NULL DEFAULT '0',
  `language` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dispo.players: ~0 rows (environ)
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
