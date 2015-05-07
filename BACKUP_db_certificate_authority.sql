-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2015 at 04:10 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_certificate_authority`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE IF NOT EXISTS `certificate` (
`id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `state_name` varchar(20) NOT NULL,
  `locality_name` varchar(150) NOT NULL,
  `organization_name` varchar(155) NOT NULL,
  `organizational_unit` varchar(155) NOT NULL,
  `common_name` varchar(64) NOT NULL,
  `email_address` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `valid_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`id`, `country_name`, `state_name`, `locality_name`, `organization_name`, `organizational_unit`, `common_name`, `email_address`, `user_id`, `status`, `created_at`, `valid_at`) VALUES
(2, 'CA', 'Jawa Timur', 'Surabaya', 'ITS', 'Tc', 'Fatahillah', 'alvarisi@live.com', 2, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `code` char(4) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`code`, `name`) VALUES
('CA', 'Canada'),
('ID', 'Indonesia'),
('JP', 'Japan'),
('US', 'United States of America');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `level`) VALUES
(1, 'admin@local.com', '12345', 1),
(2, 'a@a.com', '12345', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
 ADD PRIMARY KEY (`code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
