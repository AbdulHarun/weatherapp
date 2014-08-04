-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 05, 2014 at 01:16 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `weatherapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `weather_searches`
--

CREATE TABLE IF NOT EXISTS `weather_searches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `url` varchar(30) DEFAULT NULL,
  `json_received` mediumtext NOT NULL,
  `searchBy` varchar(20) DEFAULT NULL,
  `searchLocation` varchar(255) DEFAULT NULL,
  `searchIp` varchar(15) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `weather_searches`
--

INSERT INTO `weather_searches` (`id`, `user_id`, `url`, `json_received`, `searchBy`, `searchLocation`, `searchIp`, `time`) VALUES
(1, NULL, 'http://api.openweathermap.org/', '{"cod":"200","message":0.117,"city":{"id":2655603,"name":"Birmingham","coord":{"lon":-1.89983,"lat":52.481419},"country":"GB","population":0,"sys":{"population":0}},"cnt":1,"list":[{"dt":1407153600,"temp":{"day":292.16,"min":285.36,"max":292.16,"night":285.36,"eve":292.16,"morn":292.16},"pressure":1017.3,"humidity":59,"weather":[{"id":803,"main":"Clouds","description":"broken clouds","icon":"04d"}],"speed":3.42,"deg":258,"clouds":76}]}\n', 'city', 'Birmingham, United Kingdom', '127.0.0.1', NULL),
(2, 12, 'http://api.openweathermap.org/', '{"cod":"200","message":0.059,"city":{"id":2655603,"name":"Birmingham","coord":{"lon":-1.89983,"lat":52.481419},"country":"GB","population":0,"sys":{"population":0}},"cnt":1,"list":[{"dt":1407153600,"temp":{"day":292.16,"min":285.36,"max":292.16,"night":285.36,"eve":292.16,"morn":292.16},"pressure":1017.3,"humidity":59,"weather":[{"id":803,"main":"Clouds","description":"broken clouds","icon":"04d"}],"speed":3.42,"deg":258,"clouds":76}]}\n', 'city', 'Birmingham, United Kingdom', '127.0.0.1', NULL),
(3, 15, 'http://api.openweathermap.org/', '{"cod":"200","message":0.0773,"city":{"id":2655603,"name":"Birmingham","coord":{"lon":-1.89983,"lat":52.481419},"country":"GB","population":0,"sys":{"population":0}},"cnt":1,"list":[{"dt":1407153600,"temp":{"day":292.16,"min":285.36,"max":292.16,"night":285.36,"eve":292.16,"morn":292.16},"pressure":1017.3,"humidity":59,"weather":[{"id":803,"main":"Clouds","description":"broken clouds","icon":"04d"}],"speed":3.42,"deg":258,"clouds":76}]}\n', 'city', 'Birmingham, United Kingdom', '127.0.0.1', NULL),
(4, 15, 'http://api.openweathermap.org/', '{"cod":"200","message":0.2077,"city":{"id":2655603,"name":"Birmingham","coord":{"lon":-1.89983,"lat":52.481419},"country":"GB","population":0,"sys":{"population":0}},"cnt":1,"list":[{"dt":1407153600,"temp":{"day":288.54,"min":285.06,"max":288.54,"night":285.06,"eve":288.54,"morn":288.54},"pressure":1016.45,"humidity":86,"weather":[{"id":801,"main":"Clouds","description":"few clouds","icon":"02n"}],"speed":1.61,"deg":247,"clouds":12}]}\n', 'city', 'Birmingham, United Kingdom', '127.0.0.1', '2014-08-04 23:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `weather_users`
--

CREATE TABLE IF NOT EXISTS `weather_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `weather_users`
--

INSERT INTO `weather_users` (`id`, `username`, `password`, `name`, `email`) VALUES
(11, 'abdul1', '7706e268aad4a1a7a952', 'abdul1', 'abdul1'),
(12, 'abdul', '83878c91171338902e0f', 'abdul', 'abdul'),
(13, 'abdul2', 'f561aaf6ef0bf14d4208', 'abdul2', 'xxx'),
(14, 'Abz', 'e4b07d665df98a63f451', 'Abz', 'Abz'),
(15, 'abc123', 'e99a18c428cb38d5f260', 'abc123', 'abc123');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
