-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: health_web
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `advice`
--

DROP TABLE IF EXISTS `advice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advice` (
  `receiverId` int(11) NOT NULL,
  `advisorId` int(11) NOT NULL,
  `adviseTime` timestamp NOT NULL,
  `content` varchar(512) NOT NULL,
  PRIMARY KEY (`receiverId`,`advisorId`,`adviseTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advice`
--

LOCK TABLES `advice` WRITE;
/*!40000 ALTER TABLE `advice` DISABLE KEYS */;
INSERT INTO `advice` VALUES (2,1,'2016-05-01 18:05:41','慢跑作为一种养生的有氧运动，就要和快速跑区分开来。一般来说，最适合身体锻炼的心率律动次数是：(220-年龄)×60%左右。'),(2,1,'2016-05-04 01:42:32','跑步时的呼吸是深远而悠长的，一般采用鼻吸嘴呼，体力下降较为严重是可以采用嘴吸嘴呼方式。'),(2,1,'2016-05-04 07:01:28','假如你有看过别人跑步的过程，你也许就会发觉，几乎很多的人跑步的时候整个脚掌都会落在地面上，而且落地的时候声音很大，因此正确的跑步动作应该是脚后跟先落地，之后再整个脚掌全落地。这是对于脚踝、膝盖的一种保护，防止骨膜炎的发生。'),(2,1,'2016-05-04 15:22:55','抬头挺胸 双脚落地缓冲 脚掌落地时前脚掌不要太用力蹬地,以免造成小腿肌肉发达');
/*!40000 ALTER TABLE `advice` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-07 15:13:42
