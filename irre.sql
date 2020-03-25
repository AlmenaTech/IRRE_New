-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2020 at 09:25 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `irre`
--

-- --------------------------------------------------------

--
-- Table structure for table `irre_login_type_master`
--

CREATE TABLE `irre_login_type_master` (
  `login_type_id_pk` bigint(20) UNSIGNED NOT NULL,
  `login_type_name` varchar(30) DEFAULT NULL,
  `entry_time` datetime DEFAULT NULL,
  `entry_ip` varchar(15) DEFAULT NULL,
  `active_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `irre_login_type_master`
--

INSERT INTO `irre_login_type_master` (`login_type_id_pk`, `login_type_name`, `entry_time`, `entry_ip`, `active_status`) VALUES
(1, 'Portal Registration', '2020-03-13 13:56:00', '0.0.0.0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `irre_stake_holder_login`
--

CREATE TABLE `irre_stake_holder_login` (
  `stake_holder_login_pk` bigint(20) UNSIGNED NOT NULL,
  `stake_id_fk` smallint(6) DEFAULT NULL,
  `login_id` varchar(150) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_ip` varchar(15) DEFAULT NULL,
  `entry_time` datetime DEFAULT NULL,
  `entry_ip` varchar(15) NOT NULL,
  `login_type` smallint(6) NOT NULL,
  `active_status` smallint(6) NOT NULL,
  `stake_details_id_fk` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `irre_stake_holder_login`
--

INSERT INTO `irre_stake_holder_login` (`stake_holder_login_pk`, `stake_id_fk`, `login_id`, `password`, `update_time`, `update_ip`, `entry_time`, `entry_ip`, `login_type`, `active_status`, `stake_details_id_fk`) VALUES
(1, 1, 'test@gmail.com', '8622f0f69c91819119a8acf60a248d7b36fdb7ccf857ba8f85cf7f2767ff8265', '2020-03-21 19:50:23', '::1', '2020-03-21 19:50:23', '::1', 1, 1, 1),
(2, 1, 'test@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '2020-03-22 20:34:33', '::1', '2020-03-22 20:34:33', '::1', 1, 1, 2),
(3, 1, 'test123@gmail.com', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', '2020-03-22 20:38:28', '::1', '2020-03-22 20:38:28', '::1', 1, 1, 3),
(4, 1, 'test1234@gmail.com', '8622f0f69c91819119a8acf60a248d7b36fdb7ccf857ba8f85cf7f2767ff8265', '2020-03-22 20:38:52', '::1', '2020-03-22 20:38:52', '::1', 1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `irre_stake_holder_master`
--

CREATE TABLE `irre_stake_holder_master` (
  `irre_stake_id_pk` bigint(20) UNSIGNED NOT NULL,
  `stake_name` varchar(30) NOT NULL,
  `active_status` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `irre_stake_holder_master`
--

INSERT INTO `irre_stake_holder_master` (`irre_stake_id_pk`, `stake_name`, `active_status`) VALUES
(1, 'Parent', 1),
(2, 'Doctor', 1),
(3, 'Employee', 1),
(4, 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `irre_user_details`
--

CREATE TABLE `irre_user_details` (
  `user_id_pk` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `mname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `email_id` varchar(100) DEFAULT NULL,
  `mobile_no` int(10) DEFAULT NULL,
  `gender_id_fk` smallint(6) DEFAULT NULL,
  `entry_time` datetime NOT NULL,
  `entry_ip` varchar(15) NOT NULL,
  `update_ip` varchar(15) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `active_status` smallint(6) NOT NULL,
  `stake_id_fk` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `irre_user_details`
--

INSERT INTO `irre_user_details` (`user_id_pk`, `fname`, `mname`, `lname`, `email_id`, `mobile_no`, `gender_id_fk`, `entry_time`, `entry_ip`, `update_ip`, `update_time`, `active_status`, `stake_id_fk`) VALUES
(1, 'Test', '', 'Test', 'test@gmail.com', NULL, NULL, '2020-03-21 19:50:23', '::1', NULL, NULL, 1, 1),
(2, 'asdasd', '', 'asdasdasd', 'test@gmail.com', NULL, NULL, '2020-03-22 20:34:33', '::1', NULL, NULL, 1, 1),
(3, 'TEST', '', 'Test', 'test123@gmail.com', NULL, NULL, '2020-03-22 20:38:28', '::1', NULL, NULL, 1, 1),
(4, 'TEST', '', 'Test', 'test1234@gmail.com', NULL, NULL, '2020-03-22 20:38:52', '::1', NULL, NULL, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `irre_login_type_master`
--
ALTER TABLE `irre_login_type_master`
  ADD PRIMARY KEY (`login_type_id_pk`),
  ADD UNIQUE KEY `login_type_id_pk` (`login_type_id_pk`);

--
-- Indexes for table `irre_stake_holder_login`
--
ALTER TABLE `irre_stake_holder_login`
  ADD PRIMARY KEY (`stake_holder_login_pk`),
  ADD UNIQUE KEY `stake_holder_login_pk` (`stake_holder_login_pk`);

--
-- Indexes for table `irre_stake_holder_master`
--
ALTER TABLE `irre_stake_holder_master`
  ADD PRIMARY KEY (`irre_stake_id_pk`),
  ADD UNIQUE KEY `irre_stake_id_pk` (`irre_stake_id_pk`);

--
-- Indexes for table `irre_user_details`
--
ALTER TABLE `irre_user_details`
  ADD PRIMARY KEY (`user_id_pk`),
  ADD UNIQUE KEY `user_id_pk` (`user_id_pk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `irre_login_type_master`
--
ALTER TABLE `irre_login_type_master`
  MODIFY `login_type_id_pk` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `irre_stake_holder_login`
--
ALTER TABLE `irre_stake_holder_login`
  MODIFY `stake_holder_login_pk` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `irre_stake_holder_master`
--
ALTER TABLE `irre_stake_holder_master`
  MODIFY `irre_stake_id_pk` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `irre_user_details`
--
ALTER TABLE `irre_user_details`
  MODIFY `user_id_pk` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
