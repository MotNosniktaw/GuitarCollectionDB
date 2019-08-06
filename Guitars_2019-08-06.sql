# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 192.168.20.20 (MySQL 5.6.44)
# Database: Guitars
# Generation Time: 2019-08-06 08:56:19 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table brands
# ------------------------------------------------------------

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;

INSERT INTO `brands` (`id`, `brand`)
VALUES
	(1,'Fender'),
	(2,'Squier'),
	(3,'Gibson'),
	(4,'Epiphone'),
	(5,'Gretsch'),
	(6,'PRS'),
	(7,'Rickenbacker'),
	(8,'Ibanez'),
	(9,'Jackson'),
	(10,'Martin'),
	(11,'Taylor'),
	(12,'Guild'),
	(13,'Yamaha'),
	(14,'Washburn'),
	(15,'Ovation'),
	(16,'Guild'),
	(17,'Crafter'),
	(18,'Vintage');

/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
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
	(1,'Germany'),
	(2,'USA'),
	(3,'Canada'),
	(4,'Japan'),
	(5,'France'),
	(6,'China'),
	(7,'UK'),
	(8,'India');

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
  CONSTRAINT `brand` FOREIGN KEY (`brandID`) REFERENCES `brands` (`id`),
  CONSTRAINT `countries` FOREIGN KEY (`countryID`) REFERENCES `countries` (`id`),
  CONSTRAINT `type` FOREIGN KEY (`typeID`) REFERENCES `types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `guitars` WRITE;
/*!40000 ALTER TABLE `guitars` DISABLE KEYS */;

INSERT INTO `guitars` (`id`, `brandID`, `model`, `year`, `typeID`, `countryID`, `LH or RH`, `value`, `serialCode`, `dateAcquired`)
VALUES
	(1,3,'Les Paul Classic, Gold Top','2019',1,2,'RH',1649,NULL,'2019-08-05'),
	(2,1,'Stratocaster','1983',1,4,'RH',340,'E432-Q34ER3','2017-02-14'),
	(3,4,'Dot 335, Cherry Red','2004',1,1,'RH',349,'ED04-23486','2005-04-16'),
	(4,8,'GSR205, Walnut Flat','2016',3,5,'RH',269,'105279','2016-05-26'),
	(5,4,'Casino, Sunburst','1964',1,2,'RH',4000,'1345543-EC64','1978-03-19'),
	(6,18,'ElectroAcoustic, Natural Satin','2017',3,7,'RH',399,'17EAB-VNS491','2018-05-14'),
	(7,7,'4003LE, Pillar Box Red','1996',3,1,'RH',2739,'139408','2001-10-18'),
	(8,5,'G5420T Electromatic, Aspen Green','1958',1,3,'RH',879,'GEAG-23512','1987-11-01');

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
	(1,1,'./img/LesPaul1.jpg'),
	(2,2,'./img/FenderStratocaster1.jpg'),
	(3,3,'./img/EpiphoneDot1.jpg'),
	(4,4,'./img/IbanezGSR1.jpg'),
	(5,5,'./img/EpiphoneCasino2.jpg'),
	(6,6,'./img/VintageEAB1.jpg'),
	(7,6,'./img/VintageEAB2.jpg'),
	(8,7,'./img/Rickenbacker5003LE1.jpg'),
	(9,7,'./img/Rickenbacker5003LE2.jpg'),
	(10,8,'./img/GretschElectromatic1.jpg');

/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `types`;

CREATE TABLE `types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;

INSERT INTO `types` (`id`, `type`)
VALUES
	(1,'Electric'),
	(2,'Acoustic'),
	(3,'Bass'),
	(4,'Banjo'),
	(5,'Sitar'),
	(6,'Ukelele'),
	(7,'Violin');

/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
