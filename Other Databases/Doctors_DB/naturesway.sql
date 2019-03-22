-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2014 at 02:48 PM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `naturesway`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` int(5) NOT NULL,
  `idnum` int(11) NOT NULL,
  `consul_date` datetime NOT NULL,
  `medaid_num` varchar(5) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `sec_id` int(6) NOT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `idnum` (`idnum`),
  KEY `doctor_id` (`doctor_id`),
  KEY `sec_id` (`sec_id`),
  KEY `sec_id_2` (`sec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `doctor_id` int(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `cell` varchar(13) NOT NULL COMMENT 'provide national code',
  `email` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `time` datetime NOT NULL,
  `username` varchar(6) NOT NULL,
  `password` varchar(10) NOT NULL,
  `tell` varchar(10) NOT NULL COMMENT 'include area code',
  PRIMARY KEY (`doctor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `idnum` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `address` varchar(80) NOT NULL,
  `tell` varchar(10) NOT NULL COMMENT 'should include area code',
  `cell` varchar(13) NOT NULL COMMENT 'should include area code',
  `gender` tinyint(1) NOT NULL,
  `employer` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `marital_status` tinyint(1) NOT NULL,
  `illness` varchar(100) NOT NULL,
  `passwrd` varchar(10) NOT NULL,
  `username` varchar(6) NOT NULL,
  PRIMARY KEY (`idnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `profile_id` int(6) NOT NULL,
  `idnum` int(11) NOT NULL,
  `med_aid_num` int(10) NOT NULL,
  `med_aid_type` varchar(10) NOT NULL,
  PRIMARY KEY (`profile_id`),
  KEY `idnum` (`idnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secretary`
--

CREATE TABLE IF NOT EXISTS `secretary` (
  `sec_id` int(6) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `cell` varchar(13) NOT NULL COMMENT 'include country code',
  `tell` varchar(10) NOT NULL COMMENT 'include area code',
  `username` varchar(6) NOT NULL,
  `password` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`sec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FK_doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`),
  ADD CONSTRAINT `FK_idnum` FOREIGN KEY (`idnum`) REFERENCES `patient` (`idnum`),
  ADD CONSTRAINT `FK_sec_id` FOREIGN KEY (`sec_id`) REFERENCES `secretary` (`sec_id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `p_FK_id_num` FOREIGN KEY (`idnum`) REFERENCES `patient` (`idnum`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
