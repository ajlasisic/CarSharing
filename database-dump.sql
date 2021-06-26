/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 8.0.23 : Database - carsharing-do
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`carsharing-do` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `carsharing-do`;

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'PENDING',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`username`,`password`,`status`) values 
(15,'testo','test1','ACTIVE'),
(40,'ajla','123','ACTIVE'),
(50,'asisic1','password','ACTIVE');

/*Table structure for table `locations` */

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `locationID` int unsigned NOT NULL AUTO_INCREMENT,
  `locationName` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `locationAddress` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`locationID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `locations` */

insert  into `locations`(`locationID`,`locationName`,`locationAddress`) values 
(1,'Grbavica','Kemala Kapetanovica 12'),
(2,'AP','TMP 7'),
(3,'Otoka','Gradacacka 32');

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `rentalID` int unsigned NOT NULL,
  `total_amount` double NOT NULL,
  `payment_date` date NOT NULL,
  `payment_details` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rental` (`rentalID`),
  CONSTRAINT `fk_rental` FOREIGN KEY (`rentalID`) REFERENCES `rentaldetails` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `payments` */

/*Table structure for table `rentaldetails` */

DROP TABLE IF EXISTS `rentaldetails`;

CREATE TABLE `rentaldetails` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `dateOfRental` date NOT NULL,
  `pickupTime` time NOT NULL,
  `dropofTime` time NOT NULL,
  `vehicleID` int unsigned NOT NULL,
  `accountID` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vehicleID` (`vehicleID`),
  KEY `fk_account` (`accountID`),
  CONSTRAINT `fk_account` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`id`),
  CONSTRAINT `fk_vehicleID` FOREIGN KEY (`vehicleID`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `rentaldetails` */

insert  into `rentaldetails`(`id`,`dateOfRental`,`pickupTime`,`dropofTime`,`vehicleID`,`accountID`) values 
(1,'2021-04-07','08:45:00','09:50:00',2,50),
(2,'2021-05-05','19:38:29','22:22:00',3,40);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `fullName` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `DOB` date NOT NULL,
  `email` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `phoneNumber` int NOT NULL,
  `role` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT 'USER',
  `token` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `token_created_at` timestamp NULL DEFAULT NULL,
  `accountID` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`),
  KEY `fk_accountID` (`accountID`),
  CONSTRAINT `fk_accountID` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `users` */

insert  into `users`(`id`,`fullName`,`DOB`,`email`,`phoneNumber`,`role`,`token`,`token_created_at`,`accountID`) values 
(34,'blablabla','1911-10-05','test123@gmail.com',865874,'USER','2f33b8236dd59a66970669e7852c7cff',NULL,15),
(57,'Ajla Sisic','2000-07-19','ajlasisic00@gmail.com',532525,'USER','5dbf2c6f3c7ae12a675ec443e7078506',NULL,40),
(65,'Ajla Sisic','2000-02-10','ajla.sisic19@gmail.com',634634,'ADMIN',NULL,NULL,50);

/*Table structure for table `vehicles` */

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `car_brand` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `car_model` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mileage` int NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `locationID` int unsigned DEFAULT NULL,
  `licensePlate` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pricePerHour` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_locationID` (`locationID`),
  CONSTRAINT `fk_locationID` FOREIGN KEY (`locationID`) REFERENCES `locations` (`locationID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `vehicles` */

insert  into `vehicles`(`id`,`car_brand`,`car_model`,`mileage`,`availability`,`locationID`,`licensePlate`,`pricePerHour`) values 
(2,'renault','clio',10231,1,1,'123A432B',5.46),
(3,'peugeot','308',4503,1,2,'276P432K',4.89),
(4,'vw','up',173,0,3,'840H946L',6.5),
(5,'renault','kadjar',1286,1,1,'347H215N',4.45);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
