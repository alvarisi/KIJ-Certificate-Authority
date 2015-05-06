-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2015 at 03:02 AM
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
  `valid_at` datetime NOT NULL,
  `sign_stat` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`id`, `country_name`, `state_name`, `locality_name`, `organization_name`, `organizational_unit`, `common_name`, `email_address`, `user_id`, `status`, `created_at`, `valid_at`, `sign_stat`) VALUES
(1, 'Indonesia', 'Jawa Timur', 'Asia/Jakarta', 'ITS', 'TC', 'Fatahillah', 'alvarisi@live.com', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, 'Indonesia', 'Bali', 'Denpasar', 'ITS', 'TC', 'Andre Napitupulu', 'yosuaandre@gmail.com', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `level`) VALUES
(1, 'Andre Napitupulu', 'yosua.andre@gmail.com', 'andrejoshua', 2),
(2, 'administrator', 'admin@kij.com', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
 ADD PRIMARY KEY (`id`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
