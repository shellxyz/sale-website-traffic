-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 20, 2014 at 04:19 PM
-- Server version: 5.5.39
-- PHP Version: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stage_visitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `isActive` smallint(1) NOT NULL DEFAULT '1',
  `source` varchar(100) NOT NULL,
  `remaining_visit` int(11) NOT NULL,
  `target_country` varchar(100) NOT NULL,
  `visits_bought` int(11) NOT NULL,
  `our_sites_only` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_index` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=535 ;

-- --------------------------------------------------------

--
-- Table structure for table `daily_traffic_history`
--

CREATE TABLE IF NOT EXISTS `daily_traffic_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `web_site_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `traffic_delivered` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6753 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_ip_and_display_track`
--

CREATE TABLE IF NOT EXISTS `jobs_ip_and_display_track` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `accessed` text NOT NULL,
  `is_displayed` tinyint(1) NOT NULL,
  `times` bigint(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10372 ;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE IF NOT EXISTS `survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isReseller` varchar(10) NOT NULL,
  `clientId` int(11) NOT NULL,
  `websiteId` int(11) NOT NULL,
  `overallSatisfaction` int(11) NOT NULL,
  `priceSatisfaction` varchar(11) NOT NULL,
  `toDo` tinytext NOT NULL,
  `isTestimonial` varchar(10) NOT NULL,
  `testimonial` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `track_daily_visit`
--

CREATE TABLE IF NOT EXISTS `track_daily_visit` (
  `id` int(11) NOT NULL,
  `web_site_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `delivered` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_sites`
--

CREATE TABLE IF NOT EXISTS `web_sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientId` int(11) NOT NULL,
  `url` text NOT NULL,
  `visitsBought` int(11) NOT NULL DEFAULT '1000',
  `allocatedVisits` int(11) NOT NULL DEFAULT '1150',
  `remaining` int(11) NOT NULL DEFAULT '1150',
  `dateBought` date NOT NULL DEFAULT '0000-00-00',
  `isActive` int(11) NOT NULL DEFAULT '0',
  `isBonus` int(11) NOT NULL DEFAULT '0',
  `isJustEtc` int(11) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL DEFAULT '1',
  `country` varchar(100) NOT NULL DEFAULT 'global',
  `bonusReceived` int(10) NOT NULL,
  `clientActivated` tinyint(1) DEFAULT '0',
  `accessed` bigint(20) NOT NULL,
  `is_public` tinyint(4) NOT NULL DEFAULT '1',
  `daily_cap` int(11) NOT NULL,
  `delivered_today` int(11) NOT NULL,
  `is_freezed` tinyint(4) NOT NULL DEFAULT '0',
  `date_today` date NOT NULL,
  `IsGenuine` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1025 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
