-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: fansport
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
-- Table structure for table `fantasysport`
--

DROP TABLE IF EXISTS `fantasysport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fantasysport` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(32) NOT NULL,
  `userPW` varchar(64) NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `emailAd` varchar(50) NOT NULL,
  `activeSession` varchar(128) DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `permission` tinyint(1) NOT NULL,
  PRIMARY KEY (`userId`,`userName`,`emailAd`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fantasysport`
--

LOCK TABLES `fantasysport` WRITE;
/*!40000 ALTER TABLE `fantasysport` DISABLE KEYS */;
INSERT INTO `fantasysport` VALUES (1,'jonv92','b7f432c3abf3e4f29b2d4387fd09ef47c4c99ad1','Jonathan','Vidal','jonv92@aol.com','2016-03-08 01:58:58','2016-03-08 01:58:58',0),(2,'owen7','c2fef6aa65559ebc9719149b33a191ba84560c22','Owen','Punay','owen@email.com','2016-03-10 12:37:17','2016-03-10 12:37:17',0),(3,'geo5','c0c6d2e26e78af2320b6d21f1538bcc2c42370a5','Geovanny','Garcia','geo@email.com','2016-03-19 08:48:56','2016-03-19 08:48:56',0),(6,'admin','admin123','admin','admin','admin',NULL,NULL,1);
/*!40000 ALTER TABLE `fantasysport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `geo5`
--

DROP TABLE IF EXISTS `geo5`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `geo5` (
  `playerId` int(11) NOT NULL,
  PRIMARY KEY (`playerId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `geo5`
--

LOCK TABLES `geo5` WRITE;
/*!40000 ALTER TABLE `geo5` DISABLE KEYS */;
INSERT INTO `geo5` VALUES (20);
/*!40000 ALTER TABLE `geo5` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jonv92`
--

DROP TABLE IF EXISTS `jonv92`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jonv92` (
  `playerId` int(11) NOT NULL,
  KEY `playerId` (`playerId`),
  CONSTRAINT `jonv92_ibfk_2` FOREIGN KEY (`playerId`) REFERENCES `nbarosters` (`playerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jonv92`
--

LOCK TABLES `jonv92` WRITE;
/*!40000 ALTER TABLE `jonv92` DISABLE KEYS */;
INSERT INTO `jonv92` VALUES (10),(20),(35);
/*!40000 ALTER TABLE `jonv92` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mblteam`
--

DROP TABLE IF EXISTS `mblteam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mblteam` (
  `teamId` int(11) NOT NULL AUTO_INCREMENT,
  `teamName` varchar(40) NOT NULL,
  PRIMARY KEY (`teamId`,`teamName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mblteam`
--

LOCK TABLES `mblteam` WRITE;
/*!40000 ALTER TABLE `mblteam` DISABLE KEYS */;
/*!40000 ALTER TABLE `mblteam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nbarosters`
--

DROP TABLE IF EXISTS `nbarosters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nbarosters` (
  `teamId` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `position` varchar(10) NOT NULL,
  `fieldGoal` float(7,3) NOT NULL,
  `freeThrow` float(7,3) NOT NULL,
  `threePoint` float(7,1) NOT NULL,
  `rebound` float(7,1) NOT NULL,
  `assist` float(7,1) NOT NULL,
  `steal` float(7,1) NOT NULL,
  `block` float(7,1) NOT NULL,
  `turnovers` float(7,1) NOT NULL,
  `points` float(7,1) NOT NULL,
  `playerID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`playerID`),
  KEY `teamId` (`teamId`),
  CONSTRAINT `nbarosters_ibfk_1` FOREIGN KEY (`teamId`) REFERENCES `nbateam` (`teamId`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nbarosters`
--

LOCK TABLES `nbarosters` WRITE;
/*!40000 ALTER TABLE `nbarosters` DISABLE KEYS */;
INSERT INTO `nbarosters` VALUES (1,'Marcus','Smart','PG',0.367,0.646,1.4,3.3,3.1,1.5,0.3,1.3,7.8,1),(1,'Avery','Bradley','SG',0.428,0.790,1.6,3.1,1.8,1.1,0.2,1.4,13.9,2),(1,'Evan','Turner','SF',0.429,0.752,0.4,5.1,5.5,1.0,0.2,2.4,9.5,3),(1,'Brandon','Bass','PF',0.504,0.790,0.1,4.9,1.3,0.5,0.4,1.0,10.6,4),(1,'Tyler','Zeller','C',0.549,0.823,0.0,5.7,1.4,0.2,0.6,0.9,10.2,5),(1,'Isaiah','Thomas','PG',0.421,0.868,1.9,2.3,4.2,0.9,0.1,2.1,16.4,6),(1,'Jae','Crowder','SF',0.420,0.773,0.7,3.6,1.1,0.9,0.3,0.6,7.7,7),(1,'Jared','Sullinger','PF',0.439,0.744,0.9,7.6,2.3,0.8,0.7,1.3,13.3,8),(1,'Kelly','Olynyk','C',0.475,0.684,1.0,4.7,1.7,1.0,0.6,1.5,10.3,9),(2,'Deron','Williams','PG',0.387,0.834,1.3,3.5,6.6,0.9,0.3,2.3,13.0,10),(2,'Joe','Johnson','SG',0.435,0.801,1.5,4.8,3.7,0.7,0.2,1.7,14.4,11),(2,'Bojan','Bogdanovic','SF',0.453,0.821,1.2,2.7,0.9,0.4,0.1,1.0,9.0,12),(2,'Thaddeus','Young','PF',0.466,0.655,0.5,5.4,2.3,1.6,0.3,1.5,14.1,13),(2,'Brook','Lopez','C',0.513,0.814,0.0,7.4,0.7,0.6,1.8,1.4,17.2,14),(2,'Alan','Anderson','SG',0.439,0.443,1.0,2.8,1.1,0.8,0.1,0.8,7.4,15),(2,'Jarret','Jack','PG',0.439,0.881,0.5,3.1,4.7,0.9,0.2,2.4,12.0,16),(2,'Mirza','Teletovic','PF',0.382,0.717,1.6,4.9,1.2,0.4,0.4,1.3,8.5,17),(2,'Plumlee','Mason','C',0.573,0.495,0.0,6.2,0.9,0.8,0.8,1.3,8.7,18),(3,'Jose','Calderon','PG',0.415,0.906,1.4,3.0,4.7,0.7,0.0,1.8,9.1,19),(3,'Carmelo','Anthony','PF',0.444,0.797,1.5,6.6,3.1,1.0,0.4,2.2,24.2,20),(3,'Langston','Galloway','SG',0.399,0.808,1.4,4.2,3.3,1.2,0.3,1.4,11.8,21),(3,'Tim','Hardaway Jr.','SF',0.389,0.801,1.7,2.2,1.8,0.3,0.2,1.2,11.5,22),(3,'Jason','Smith','C',0.434,0.830,0.2,4.0,1.7,0.4,0.5,1.3,8.0,23),(3,'Shane','Larkin','PG',0.433,0.782,0.5,2.3,3.0,1.2,0.1,1.1,6.2,24),(3,'Quincy','Acy','PF',0.459,0.784,0.3,4.4,1.0,0.4,0.3,0.9,5.9,25),(3,'Andrea','Bargnani','C',0.454,0.813,0.5,4.4,1.6,0.1,0.9,1.4,14.8,26),(4,'Tony','Wroten','PG',0.403,0.667,1.2,2.9,5.2,1.6,0.3,3.8,16.9,27),(4,'Robert','Covington','SG',0.396,0.820,2.4,2.4,1.5,1.4,0.4,1.8,13.5,28),(4,'Luc','Mbah a Moute','SF',0.395,0.589,0.9,4.9,1.6,1.2,0.3,1.5,9.9,29),(4,'Henry','Sims','PF',0.474,0.774,0.1,4.9,1.1,0.5,0.4,1.4,8.0,30),(4,'Nerlens','Noel','C',0.462,0.609,0.0,8.1,1.7,1.8,1.9,1.9,9.9,31),(4,'Hollis','Thompson','SG',0.413,0.708,1.6,2.8,1.2,0.8,0.4,0.9,8.8,32),(4,'Jerami','Grant','SF',0.352,0.591,0.8,3.0,1.2,0.6,1.0,1.3,6.3,33),(5,'Kyle','Lowry','PG',0.412,0.808,1.9,4.7,6.8,1.6,0.2,2.5,17.8,34),(5,'DeMar','DeRozan','SG',0.413,0.832,0.4,4.6,3.5,1.2,0.2,2.3,20.1,35),(5,'Terrence','Ross','SF',0.410,0.786,1.8,2.8,1.0,0.6,0.3,0.8,9.8,36),(5,'Amir','Johnson','PF',0.574,0.612,0.3,6.1,1.6,0.6,0.8,1.5,9.3,37),(5,'Jonas','Valanciunas','C',0.572,0.786,0.0,8.7,0.5,0.4,1.2,1.4,12.0,38),(5,'Greivis','Vasquez','PG',0.408,0.758,1.6,2.6,3.7,0.6,0.1,1.5,9.5,39),(5,'Lou','Williams','SG',0.404,0.861,1.9,1.9,2.1,1.1,0.1,1.3,15.5,40),(5,'Patrick','Patterson','PF',0.449,0.788,1.3,5.3,1.9,0.7,0.5,0.7,8.0,41);
/*!40000 ALTER TABLE `nbarosters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nbateam`
--

DROP TABLE IF EXISTS `nbateam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nbateam` (
  `teamId` int(11) NOT NULL AUTO_INCREMENT,
  `teamName` varchar(40) NOT NULL,
  `wins` int(2) DEFAULT NULL,
  `losses` int(2) DEFAULT NULL,
  `division` varchar(25) DEFAULT NULL,
  `conference` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`teamId`,`teamName`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nbateam`
--

LOCK TABLES `nbateam` WRITE;
/*!40000 ALTER TABLE `nbateam` DISABLE KEYS */;
INSERT INTO `nbateam` VALUES (1,'Boston Celtics',40,42,'atlantic','east'),(2,'Brooklyn Nets',38,44,'atlantic','east'),(3,'New York Knicks',17,65,'atlantic','east'),(4,'Philadelphia 76ers',18,64,'atlantic','east'),(5,'Toronto Raptors',49,33,'atlantic','east'),(6,'Chicago Bulls',50,32,'central','east'),(7,'Cleveland Cavaliers',53,29,'central','east'),(8,'Detroit Pistons',32,50,'central','east'),(9,'Indiana Pacers',38,44,'central','east'),(10,'Milwaukee Bucks',41,41,'central','east'),(11,'Atlanta Hawks',60,22,'southeast','east'),(12,'Charlotte Hornets',33,49,'southeast','east'),(13,'Miami Heat',37,45,'southeast','east'),(14,'Orlando Magic',25,57,'southeast','east'),(15,'Washington Wizards',46,36,'southeast','east'),(16,'Denver Nuggets',30,52,'northwest','west'),(17,'Minnesota Timberwolves',16,66,'northwest','west'),(18,'Oklahoma City Thunder',45,37,'northwest','west'),(19,'Portland Trail Blazers',51,31,'northwest','west'),(20,'Utah Jazz',38,44,'northwest','west'),(21,'Golden State Warriors',67,15,'pacific','west'),(22,'Los Angeles Clippers',56,26,'pacific','west'),(23,'Los Angeles Lakers',21,61,'pacific','west'),(24,'Pheonix Suns',39,43,'pacific','west'),(25,'Sacramento Kings',29,53,'pacific','west'),(26,'Dallas Mavericks',50,32,'southwest','west'),(27,'Houston Rockets',56,26,'southwest','west'),(28,'Memphis Grizzlies',55,27,'southwest','west'),(29,'New Orleans Pelicans',45,37,'southwest','west'),(30,'San Antonio Spurs',55,27,'southwest','west');
/*!40000 ALTER TABLE `nbateam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nflteam`
--

DROP TABLE IF EXISTS `nflteam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nflteam` (
  `teamId` int(11) NOT NULL AUTO_INCREMENT,
  `teamName` varchar(40) NOT NULL,
  PRIMARY KEY (`teamId`,`teamName`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nflteam`
--

LOCK TABLES `nflteam` WRITE;
/*!40000 ALTER TABLE `nflteam` DISABLE KEYS */;
INSERT INTO `nflteam` VALUES (1,'Arizona Cradinals'),(2,'Chicago Bears'),(3,'Green Bay Packers'),(4,'New York Giants'),(5,'Detroit Lions'),(6,'Washington Redskins'),(7,'Philiadelphia Eagles'),(8,'Pittsburgh Steelers'),(9,'Los Angeles Rams'),(10,'San Francisco 49ers'),(11,'Cleveland Browns'),(12,'Indianapolis Colts'),(13,'Dallas Cowboys'),(14,'Kansas City Chiefs'),(15,'San Diego Chargers'),(16,'Denver Broncos'),(17,'New York Jets'),(18,'New England Patriots'),(19,'Oakland Raiders'),(20,'Tennessee Titans'),(21,'Buffalo Bills'),(22,'Minnesota Vikings'),(23,'Atlanta Falcons'),(24,'Miami Dolphins'),(25,'New Orleans Saints'),(26,'Cincinnati Bengals'),(27,'Tampa Bay Buccaneers'),(28,'Carolina Panthers'),(29,'Jacksonville Jaguars'),(30,'Baltimore Ravens'),(31,'Houston Texans'),(32,'Seattle Seahawks');
/*!40000 ALTER TABLE `nflteam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `owen7`
--

DROP TABLE IF EXISTS `owen7`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `owen7` (
  `playerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `owen7`
--

LOCK TABLES `owen7` WRITE;
/*!40000 ALTER TABLE `owen7` DISABLE KEYS */;
INSERT INTO `owen7` VALUES (6),(14),(28),(26),(16),(20),(21),(39);
/*!40000 ALTER TABLE `owen7` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-23 22:06:28
