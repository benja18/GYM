-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2013 at 03:30 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gym`
--
CREATE DATABASE IF NOT EXISTS `gym` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gym`;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `ci` varchar(45) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `mail` varchar(64) DEFAULT NULL,
  `emergency` varchar(45) DEFAULT NULL,
  `ocupation` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `ci_UNIQUE` (`ci`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE IF NOT EXISTS `configurations` (
  `configuration_id` int(11) NOT NULL AUTO_INCREMENT,
  `configuration_key` varchar(45) NOT NULL,
  `configuration_value` varchar(45) NOT NULL,
  PRIMARY KEY (`configuration_id`),
  UNIQUE KEY `key_UNIQUE` (`configuration_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`configuration_id`, `configuration_key`, `configuration_value`) VALUES
(1, 'EXPIRATION_INTERVAL_DAYS', '5');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE IF NOT EXISTS `exercises` (
  `exercise_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `muscles_muscle_id` int(11) NOT NULL,
  PRIMARY KEY (`exercise_id`,`muscles_muscle_id`),
  KEY `fk_exercises_muscles1_idx` (`muscles_muscle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exercises_has_routines`
--

CREATE TABLE IF NOT EXISTS `exercises_has_routines` (
  `day` varchar(45) DEFAULT NULL,
  `exercises_exercise_id` int(11) NOT NULL,
  `routines_routine_id` int(11) NOT NULL,
  KEY `fk_exercises_has_routines_exercises1_idx` (`exercises_exercise_id`),
  KEY `fk_exercises_has_routines_routines1_idx` (`routines_routine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `muscles`
--

CREATE TABLE IF NOT EXISTS `muscles` (
  `muscle_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`muscle_id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `routines`
--

CREATE TABLE IF NOT EXISTS `routines` (
  `routine_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `clients_client_id` int(11) NOT NULL,
  PRIMARY KEY (`routine_id`),
  KEY `fk_routines_clients1_idx` (`clients_client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `clients_client_id` int(11) NOT NULL,
  `subscription_types_subscription_type_id` int(11) NOT NULL,
  PRIMARY KEY (`subscription_id`,`clients_client_id`),
  KEY `fk_subscription_clients1_idx` (`clients_client_id`),
  KEY `fk_subscriptions_subscription_types1_idx` (`subscription_types_subscription_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_types`
--

CREATE TABLE IF NOT EXISTS `subscription_types` (
  `subscription_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `days` INT NOT NULL,
  `price` INT NOT NULL,
  PRIMARY KEY (`subscription_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `userscol_UNIQUE` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'admin', 'e2a7106f1cc8bb1e1318df70aa0a3540');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `fk_exercises_muscles1` FOREIGN KEY (`muscles_muscle_id`) REFERENCES `muscles` (`muscle_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `exercises_has_routines`
--
ALTER TABLE `exercises_has_routines`
  ADD CONSTRAINT `fk_exercises_has_routines_exercises1` FOREIGN KEY (`exercises_exercise_id`) REFERENCES `exercises` (`exercise_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_exercises_has_routines_routines1` FOREIGN KEY (`routines_routine_id`) REFERENCES `routines` (`routine_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `routines`
--
ALTER TABLE `routines`
  ADD CONSTRAINT `fk_routines_clients1` FOREIGN KEY (`clients_client_id`) REFERENCES `clients` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `fk_subscription_clients1` FOREIGN KEY (`clients_client_id`) REFERENCES `clients` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subscriptions_subscription_types1` FOREIGN KEY (`subscription_types_subscription_type_id`) REFERENCES `subscription_types` (`subscription_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
