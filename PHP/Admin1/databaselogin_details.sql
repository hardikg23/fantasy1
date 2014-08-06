-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2014 at 11:06 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fantasy1`
--

-- --------------------------------------------------------

--
-- Table structure for table `databaselogin_details`
--

CREATE TABLE IF NOT EXISTS `databaselogin_details` (
  `data_hash_password` varchar(128) NOT NULL,
  `data_salt` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `databaselogin_details`
--

INSERT INTO `databaselogin_details` (`data_hash_password`, `data_salt`) VALUES
('e1ac7c0c0f8aa3c4cb937f0fd4421bcab102c847f523254cd2101d433cf10cf8', '1978679514531878a2b1b8d5.8835870');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
