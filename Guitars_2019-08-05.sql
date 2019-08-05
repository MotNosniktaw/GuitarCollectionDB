# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 192.168.20.20 (MySQL 5.6.44)
# Database: Guitars
# Generation Time: 2019-08-05 12:44:54 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table brand
# ------------------------------------------------------------

DROP TABLE IF EXISTS `brand`;

CREATE TABLE `brand` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;

INSERT INTO `brand` (`id`, `brand`)
VALUES
	(1,'Fender'),
	(2,'Gibson'),
	(3,'Epiphone'),
	(4,'Squier'),
	(5,'Ibanez'),
	(6,'PRS'),
	(7,'Yamaha'),
	(8,'Rickenbacker'),
	(9,'Martin'),
	(10,'Washington'),
	(11,'Crafter');

/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table countries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;

INSERT INTO `countries` (`id`, `country`)
VALUES
	(1,'America'),
	(2,'Mexico'),
	(3,'Japan'),
	(4,'Scotland'),
	(5,'Spain'),
	(6,'China'),
	(9,'Denmark');

/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table guitars
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guitars`;

CREATE TABLE `guitars` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `brandID` int(11) unsigned NOT NULL,
  `model` varchar(255) NOT NULL DEFAULT '',
  `year` year(4) DEFAULT NULL,
  `typeID` int(11) unsigned NOT NULL,
  `countryID` int(11) unsigned NOT NULL,
  `LH or RH` enum('LH','RH') NOT NULL,
  `value` int(11) DEFAULT NULL,
  `serialCode` varchar(255) DEFAULT NULL,
  `dateAcquired` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brand` (`brandID`),
  KEY `countries` (`countryID`),
  KEY `type` (`typeID`),
  CONSTRAINT `brand` FOREIGN KEY (`brandID`) REFERENCES `brand` (`id`),
  CONSTRAINT `countries` FOREIGN KEY (`countryID`) REFERENCES `countries` (`id`),
  CONSTRAINT `type` FOREIGN KEY (`typeID`) REFERENCES `type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `guitars` WRITE;
/*!40000 ALTER TABLE `guitars` DISABLE KEYS */;

INSERT INTO `guitars` (`id`, `brandID`, `model`, `year`, `typeID`, `countryID`, `LH or RH`, `value`, `serialCode`, `dateAcquired`)
VALUES
	(1,5,'Big One','2014',2,6,'RH',NULL,'af76agfa7','2019-08-04'),
	(2,5,'GSR 205','2016',3,1,'RH',250,'','2016-05-14'),
	(4,10,'Rocker','1967',3,1,'RH',NULL,NULL,'2015-05-14'),
	(7,10,'Rocker','1967',9,1,'RH',NULL,NULL,'2015-05-14'),
	(8,10,'Rocker','1967',9,1,'RH',NULL,NULL,'2015-05-14'),
	(9,6,'Thunder','1998',4,3,'LH',99999,'A12345','2010-08-19');

/*!40000 ALTER TABLE `guitars` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `guitarID` int(11) unsigned DEFAULT NULL,
  `fileLocation` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `images` (`guitarID`),
  CONSTRAINT `images` FOREIGN KEY (`guitarID`) REFERENCES `guitars` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;

INSERT INTO `images` (`id`, `guitarID`, `fileLocation`)
VALUES
	(3,2,'./img/guitar1.jpg'),
	(4,2,'./img/guitar2.jpg'),
	(5,2,'./img/guitar3.jpg'),
	(6,2,'./img/guitar4.jpg');

/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type`;

CREATE TABLE `type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;

INSERT INTO `type` (`id`, `type`)
VALUES
	(1,'Electric'),
	(2,'Acoustic'),
	(3,'Bass'),
	(4,'Banjo'),
	(5,'Sitar'),
	(9,'Ukelele');

/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
